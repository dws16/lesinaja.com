<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'My Profile';
        if ($data['user']['role_id'] == 2) {
            $data['mentor'] = $this->db->get_where('mentor', ['id' => $this->session->userdata('id')])->row_array();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Edit Profile';
        if ($data['user']['role_id'] == 2) {
            $data['mentor'] = $this->db->get_where('mentor', ['id' => $this->session->userdata('id')])->row_array();
        }

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect(base_url('user'));
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your profile has been updated!
            </div>');
            redirect(base_url('user'));
        }
    }

    public function changePassword()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Change Password';

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[8]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[8]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong current password!
                </div>');
                redirect(base_url('user/changepassword'));
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    New password cannot be the same as current password!
                    </div>');
                    redirect(base_url('user/changepassword'));
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password changed!
                    </div>');
                    redirect(base_url('user/changepassword'));
                }
            }
        }
    }

    public function getmentoredit()
    {
        echo json_encode($this->db->get_where('mentor', ['id' => $this->input->post('id')])->row_array());
    }

    public function editmentor()
    {
        $data = [
            "id" => $this->session->userdata('id'),
            "jurusan" => $this->input->post('jurusan', true),
            "angkatan" => $this->input->post('angkatan', true),
            "matkul" => $this->input->post('pengajar', true),
            "grade" => $this->input->post('ipk', true),
            "phone" => $this->input->post('telp', true),
            "address" => $this->input->post('alamat', true)
        ];

        $cek = $this->db->get_where('mentor', ['id' => $this->session->userdata('id')])->row_array();

        if ($cek < 1) {
            $this->db->where('id', $this->session->userdata('id'));
            $this->db->insert('mentor', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Mentor data has been updated!
            </div>');
            redirect(base_url('user'));
        } else {
            $this->db->where('id', $this->session->userdata('id'));
            $this->db->update('mentor', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Mentor data has been updated!
            </div>');
            redirect(base_url('user'));
        }
    }
}

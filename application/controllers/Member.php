<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
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
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function cari_tutor()
    {
        $this->load->model('Member_model');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Cari Tutor';


        if ($this->input->post('mapel')) {
            $data['list'] = $this->Member_model->CariMentor();
        } else {
            $data['list'] = $this->Member_model->ShowMentor();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('member/cari_tutor', $data);
        $this->load->view('templates/footer');
    }

    public function confirm()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Konfirmasi Pembayaran';

        $this->form_validation->set_rules('order_id', 'Kode Order', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('member/confirm', $data);
            $this->load->view('templates/footer');
        } else {
            $order_id = $this->input->post('order_id');
            $email = $this->input->post('email');
            if (!$this->db->get_where('order', ['order_id' => $order_id])->row_array()) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Kode order tidak ditemukan!
                </div>');
                redirect(base_url('member/confirm'));
            } else {
                if (!$this->db->get_where('order', ['email' => $email])->row_array()) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Email tidak ditemukan!
                    </div>');
                    redirect(base_url('member/confirm'));
                } else {
                    if (!$this->db->get_where('order', ['email' => $email, 'order_id' => $order_id])->row_array()) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Data order tidak ditemukan!
                        </div>');
                        redirect(base_url('member/confirm'));
                    } else {
                        $upload_image = $_FILES['bukti']['name'];
                        if ($upload_image) {
                            $config['upload_path'] = './assets/img/order';
                            $config['allowed_types'] = 'gif|jpg|png|JPG';
                            $config['max_size']     = '2048';

                            $this->load->library('upload', $config);

                            if ($this->upload->do_upload('bukti')) {
                                $new_image = $this->upload->data('file_name');
                                $this->db->set('upload', $new_image);
                            } else {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                                redirect(base_url('member/confirm'));
                            }
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                            Upload bukti pembayaran anda!
                            </div>');
                            redirect(base_url('member/confirm'));
                        }

                        $this->db->where('email', $email);
                        $this->db->where('order_id', $order_id);
                        $this->db->update('order');

                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Bukti pembayaran sudah terupload. Cek email anda untuk menerima konfirmasi dari kami!
                        </div>');
                        redirect(base_url('user'));
                    }
                }
            }
        }
    }

    public function mentordetail($mentor_id)
    {
        $this->load->model('Member_model');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Detail Mentor';

        $data['detail'] = $this->Member_model->DetailMentor($mentor_id);
        $data['jadwal'] = $this->Member_model->JadwalMentor($mentor_id);
        $data['rating'] = $this->Member_model->RatingMentor($mentor_id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('member/mentordetail', $data);
        $this->load->view('templates/footer');
    }

    public function order($mentor_id = NULL)
    {
        $this->load->model('Member_model');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Pesan Mentor';

        $this->form_validation->set_rules('address', 'Address', 'required');

        if ($this->form_validation->run() == false) {
            $data['detail'] = $this->Member_model->DetailMentor($mentor_id);
            $data['jadwal'] = $this->Member_model->JadwalMentor($mentor_id);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('member/order', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->input->post('date') == "0") {
                echo "
                <script> 
                    alert('Pilih jadwal terlebih dahulu!');
                    document.location.href = 'cari_tutor';
			    </script>";
            } else {
                $order = [
                    'email' => $this->session->userdata('email'),
                    'mentor_id' => $this->input->post('mentor_id'),
                    'date' => $this->input->post('date'),
                    'address' => $this->input->post('address'),
                    'note' => $this->input->post('note'),
                    'bill' => 100000,
                    'timestamp' => $this->db->query("SELECT NOW();")->row_array()['NOW()']
                ];

                $this->db->insert('order', $order);
                $order['id'] = $this->db->insert_id();
                $order['name'] = $data['user']['name'];
                $order['mentor_name'] = $this->input->post('mentor_name');
                $order['matkul'] = $this->input->post('matkul');
                $this->_sendEmail($order);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Pesanan anda segera diproses. Silakan cek email anda untuk keterangan lebih lanjut!
                </div>');
                redirect(base_url('member/confirm'));
            }
        }
    }

    private function _sendEmail($order)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'lesinaja.its@gmail.com',
            'smtp_pass' => '12as!@AS',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('lesinaja.its@gmail.com', 'Lesinaja');
        $this->email->to($this->session->userdata('email'));


        $this->email->subject('Detail Pemesanan Tutor');
        $this->email->message(
            '<p>Halo<strong>' . $order['name'] . '</strong>, </p><br>
            <p>Terima kasih sudah order di website www.lesinaja.com</p>
            <p>Sebagai konfirmasi, berikut data order-nya : </p> <br>
            <h1>Kode Order Anda : <strong>' .   $order['id'] . '</strong></h1> <br> <br>
            <h4>Detail Pemesanan :</h4>
            <p>Nama Mentor : ' . $order['mentor_name'] . '</p>
            <p>Mata Kuliah : ' . $order['matkul'] . '</p>
            <p>Jadwal : ' . $order['date'] . '</p>
            <p>Alamat Pelaksanaan : ' . $order['address'] . '</p>
            <p>Catatan :' . $order['note'] . '</p> <br>
            -------------------------------------------------------------------------------------- <br>
            <p>Total order untuk tutor di atas adalah <strong>' . 'Rp. ' . $order['bill'] . '</strong></p>
            <p>Pembayaran bisa dilakukan melalui transfer ke rek : </p>
            <p> XXXXXX - XXXXX</p>
            <p>Setelah melakukan pembayaran, silakan konfirmasi melalui web kami.</p><br><br><br><br><br>
            <p>Terima kasih,</p>
            <p><strong>Lesinaja</strong></p>
            '
        );

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    #ROLE#
    public function role()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Role';

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New role added!
            </div>');
            redirect(base_url('admin/role'));
        }
    }

    public function editrole()
    {
        $data = [
            "role" => $this->input->post('role', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_role', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Role has been edited!
        </div>');
        redirect(base_url('admin/role'));
    }

    public function getubahrole()
    {
        echo json_encode($this->db->get_where('user_role', ['id' => $this->input->post('id')])->row_array());
    }

    public function deleterole($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Role has been deleted!
        </div>');
        redirect(base_url('admin/role'));
    }

    public function roleAccess($role_id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Role Access';

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role-access', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New role added!
            </div>');
            redirect(base_url('admin/role'));
        }
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access changed!
            </div>');
    }
    #ROLE END#

    #USER#
    public function user_list($id = '')
    {
        $this->load->model('User_model');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['list'] = $this->db->get('user')->result_array();
        $data['detail'] = $this->db->get_where('user', ['id' => $id])->row_array();
        if ($this->db->get_where('mentor', ['id' => $id])) {
            $data['mentor'] = $this->db->get_where('mentor', ['id' => $id])->row_array();
        }

        if ($this->input->post('keyword')) {
            $data['list'] = $this->User_model->CariUser();
        }
        $data['title'] = 'User List';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/user_list', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        User has been deleted!
        </div>');
        redirect(base_url('admin/user_list'));
    }

    public function getdetail()
    {
        echo json_encode($this->db->get_where('user', ['id' => $this->input->post('id')])->row_array());
    }

    public function getubah()
    {
        echo json_encode($this->db->get_where('user', ['id' => $this->input->post('id')])->row_array());
    }

    public function edit()
    {
        $data = [
            "name" => $this->input->post('name', true),
            "email" => $this->input->post('email', true),
            "role_id" => $this->input->post('role_id', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        User data has been edited!
        </div>');
        redirect(base_url('admin/user_list'));
    }
    #USER END#

    public function keuangan()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Keuangan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/keuangan', $data);
        $this->load->view('templates/footer');
    }

    public function order_log()
    {
        $this->load->model('Admin_model');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Log Pemesanan';

        $data['list'] = $this->Admin_model->getOrder();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/order_log', $data);
        $this->load->view('templates/footer');
    }

    public function orderDetail()
    {
        $this->load->model('Admin_model');
        echo json_encode($this->Admin_model->getOrderDetail($this->input->post('id')));
    }

    public function verif()
    {
        $this->db->select('email,name');
        $this->db->from('user');
        $this->db->where('id', $this->input->post('mentor_id'));
        $result = $this->db->get()->row_array();
        $emailMentor = $result['email'];
        $nameMentor = $result['name'];
        $mentor = [
            'name' => $nameMentor,
            'email' => $emailMentor,
            'date' => $this->input->post('date'),
            'hour' => $this->input->post('hour'),
            'minute' => $this->input->post('minute'),
            'address' => $this->input->post('address'),
            'member' => $this->input->post('member')
        ];

        $member = [
            'name' => $this->input->post('member'),
            'email' => $this->input->post('email'),
            'order_id' => $this->input->post('order_id')
        ];

        $data = [
            "is_verified" => 1
        ];
        $this->db->where('order_id', $this->input->post('order_id'));
        $this->db->update('order', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Order has been verified!
        </div>');
        redirect(base_url('admin/order_log'));
        $this->_sendEmailMember($member);
        $this->_sendEmailMentor($mentor);
    }

    private function _sendEmailMember($order)
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
        $this->email->to($order['email']);


        $this->email->subject('Verifikasi Pesanan');
        $this->email->message(
            '<p>Halo<strong>' . ' ' . $order['name'] . '</strong>, </p><br>
            <p>Pesanan anda dengan ORDER-ID: <strong>' . $order['order_id'] . '</strong> sudah terverifikasi.</p>
            <p>Terima kasih telah menggunakan dan percaya pada jasa kami.</p> <br>
            <br><br><br><br><br>
            <p>Salam,</p>
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

    private function _sendEmailMentor($order)
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
        $this->email->to($order['email']);


        $this->email->subject('Order Tutor Baru');
        $this->email->message(
            '<p>Halo<strong>' . ' ' . $order['name'] . '</strong>, </p><br>
            <p>Anda mendapatkan order tutor dengan data sebagai berikut :</p>
        
            <p>Nama Mentee : ' . $order['member'] . '</p>
            <p>Jadwal : ' . $order['date'] . ', Pukul ' . $order['hour'] . ':' . $order['minute'] . '</p>
            <p>Alamat Pelaksanaan : ' . $order['address'] . '</p>
            <p>Catatan :' . $order['note'] . '</p> <br>
            -------------------------------------------------------------------------------------- <br>
            <p>Selamat mengajar dan semangat dalam menjalani kegiatan pembelajaran!</p><br><br><br><br><br>
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

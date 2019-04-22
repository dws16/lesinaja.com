<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'LESINAJA: Portal Pencarian Jasa Tutor Privat Online';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/index', $data);
        $this->load->view('templates/auth_footer', $data);
    }

    public function login()
    {
        if ($this->session->userdata('email')) {
            redirect(base_url('user'));
        }

        #Rules form
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        #Cek jika isi form masih salah / kosong
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
            #Jika sudah benar, panggil fungsi login di bawah
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        #mengambil data yg diinput oleh user
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        #query data select * from user where 'email'='$email'
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        #jika data user ditemukan
        if ($user) {

            #jika user sudah diaktivasi
            if ($user['is_active'] == 1) {

                #mengecek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                        'id' => $user['id']
                    ];

                    #memasukkan data di atas ke session
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect(base_url('admin'));
                    } else {
                        redirect(base_url('user'));
                    }

                    #jika password salah
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong password!
                    </div>');
                    redirect(base_url('auth/login'));
                }

                #jika user belum diaktivasi
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                This email has not been activated!
                </div>');
                redirect(base_url('auth/login'));
            }

            #jika data user tidak ditemukan
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email is not registered!
            </div>');
            redirect(base_url('auth/login'));
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect(base_url('user'));
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'matches' => 'Password does not match!',
            'min_length' => 'Password must be at least 8 characters!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'image' => 'default.jpg',
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 3,
                'is_active' => 0,
                'date_created' => time()
            ];

            // token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $this->input->post('email', true),
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulations! Your account has been created. Please check your email to activate!
            </div>');
            redirect(base_url('auth/login'));
        }
    }

    private function _sendEmail($token, $type)
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
        $this->email->to($this->input->post('email', true));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->db->set('is_active', 1);
                $this->db->where('email', $email);
                $this->db->update('user');

                $this->db->delete('user_token', ['email' => $email]);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Account has been activated! Please login.
                </div>');
                redirect(base_url('auth/login'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Account activation failed! Token invalid.
                </div>');
                redirect(base_url('auth/login'));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Account activation failed! Wrong email.
            </div>');
            redirect(base_url('auth/login'));
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You have been logged out!
            </div>');
        redirect(base_url('auth'));
    }

    public function denied()
    {
        $data['title'] = 'Access Denied';
        $this->load->view('templates/header', $data);
        $this->load->view('auth/denied');
    }

    public function forgotPassword()
    {
        $data['title'] = 'Forgot Password';

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer', $data);
        } else {
            $email = $this->input->post('email', true);
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Please check your email to reset your password!
                </div>');
                redirect(base_url('auth/forgotpassword'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email is not registered or activated!
                </div>');
                redirect(base_url('auth/forgotpassword'));
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Reset password failed! Token invalid.
                </div>');
                redirect(base_url('auth/login'));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Reset password failed! Wrong email.
                </div>');
            redirect(base_url('auth/login'));
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect(base_url('auth'));
        }
        $data['title'] = 'Change Password';

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|min_length[8]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer', $data);
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Password has been changed! Please login.
                </div>');
            redirect(base_url('auth/login'));
        }
    }
}

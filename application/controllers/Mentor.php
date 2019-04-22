<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mentor extends CI_Controller
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
        $data['mentor'] = $this->db->get_where('mentor', ['id' => $this->session->userdata('id')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function wallet()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'My Wallet';
        $data['mentor'] = $this->db->get_where('mentor', ['id' => $this->session->userdata('id')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mentor/wallet', $data);
        $this->load->view('templates/footer');
    }

    public function jadwal()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Jadwal Mengajar';
        $data['mentor'] = $this->db->get_where('mentor', ['id' => $this->session->userdata('id')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mentor/jadwal', $data);
        $this->load->view('templates/footer');
    }
}

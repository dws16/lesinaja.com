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

    public function rating()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Rating';
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
        $data['title'] = 'My Schedule';
        $data['mentor'] = $this->db->get_where('mentor', ['id' => $this->session->userdata('id')])->row_array();
        $data['jadwal'] = $this->db->get_where('mentor_schedule', ['mentor_id' => $this->session->userdata('id')])->result_array();
        $data['schedule'] = $this->db->get_where('order', ['mentor_id' => $this->session->userdata('id'), 'is_verified' => 1],)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mentor/jadwal', $data);
        $this->load->view('templates/footer');
    }

    public function addschedule()
    {
        $data = [
            'mentor_id' => $this->input->post('mentor_id'),
            'date' => $this->input->post('date'),
            'hour' => $this->input->post('hour'),
            'minute' => $this->input->post('minute')
        ];

        $cek = $this->db->get_where('mentor_schedule', ['mentor_id' => $data['mentor_id'], 'date' => $data['date'], 'hour' => $data['hour']])->row_array();

        if ($cek < 1) {
            $this->db->insert('mentor_schedule', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Schedule added!
                </div>');
            redirect(base_url('mentor/jadwal'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Schedule already exist!
                </div>');
            redirect(base_url('mentor/jadwal'));
        }
    }

    public function deleteschedule($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mentor_schedule');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Schedule has been deleted!
        </div>');
        redirect(base_url('mentor/jadwal'));
    }
}

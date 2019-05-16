<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member_model extends CI_Model
{
    public function CariMentor()
    {
        $keyword = $this->input->post('mapel', true);

        $query = "SELECT `user`.`name`,`user`.`image`, `mentor`.* FROM `user`,`mentor` WHERE `mentor`.`id` = `user`.`id` AND `mentor`.`matkul` LIKE '%$keyword%'";

        return $this->db->query($query)->result_array();
    }

    public function ShowMentor()
    {
        $query = "SELECT `user`.`name`, `user`.`image`, `mentor`.*
        FROM `user`, `mentor`
        WHERE `mentor`.`id` = `user`.`id`";

        return $this->db->query($query)->result_array();
    }

    public function DetailMentor($mentor_id)
    {
        $query = "SELECT `user`.`name`, `user`.`image`, `mentor`.*
        FROM `user`, `mentor`
        WHERE `user`.`id`='$mentor_id' AND `mentor`.`id` = `user`.`id`";

        return $this->db->query($query)->row_array();
    }

    public function RatingMentor($mentor_id)
    {
        return $this->db->get_where('rating', ['mentor_id' => $mentor_id])->result_array();
    }

    public function JadwalMentor($mentor_id)
    {
        $query = "SELECT *
        FROM `mentor_schedule`
        WHERE `mentor_id` = '$mentor_id' AND `id` NOT IN (SELECT `date` FROM `order` WHERE `mentor_id`='$mentor_id' )";
        return $this->db->query($query)->result_array();
    }
}

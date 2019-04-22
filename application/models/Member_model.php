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
}

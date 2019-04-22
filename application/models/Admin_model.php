<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getOrder()
    {
        $query = "SELECT `order`.*, `user`.`name`
        FROM `order`,`user`
        WHERE `order`.`member_id` = `user`.`id` AND `order`.`mentor_id`=`user`.`id`";

        return $this->db->query($query)->result_array();
    }
}

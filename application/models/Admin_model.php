<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getOrder()
    {
        $query = "SELECT `order`.*, `user`.`name`
        FROM `order`,`user`
        WHERE `order`.`email` = `user`.`email`";

        return $this->db->query($query)->result_array();
    }

    public function getOrderDetail($id)
    {
        $query = "SELECT `order`.*, `user`.`name` AS `member`, `mentor_schedule`.`date`, `mentor_schedule`.`hour`,`mentor_schedule`.`minute`
        FROM `order`,`user`,`mentor_schedule`
        WHERE `order`.`email` = `user`.`email` AND `mentor_schedule`.`id`=`order`.`date` AND`order`.`order_id`='$id'";

        return $this->db->query($query)->row_array();
    }
}

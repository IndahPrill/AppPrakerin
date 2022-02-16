<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function GetUser($email)
    {
        $query = $this->db->query("SELECT * FROM user WHERE email = '$email'")->row_array();
        return $query;
    }
    public function getSubMenu()
    {
        $query = "SELECT a.*,b.`menu`, b.`id` as id_menu
                    FROM 
                    `user_sub_menu` a
                    JOIN `user_menu` b ON a. `menu_id` = b.`id`
        ";

        return $this->db->query($query)->result_array();
    }

    public function hapusrole($id_data)
    {
        // $this->db->where('id',$id_data);
        $hsl = $this->db->delete('user_role', array('id' => $id_data));
        if ($hsl) {
            return $hsl;
        } else {
            return false;
        }
    }

    public function insertData($nameRole)
    {
        $hk = $this->db->insert('user_role', array('role' => $nameRole));
        if ($hk) {
            return $hk;
        } else {
            return false;
        }
    }

    public function editData($id, $data)
    {
        $this->db->where('id', $id);
        $hk = $this->db->update('user_role', $data);
        if ($hk) {
            return $hk;
        } else {
            return false;
        }
    }
    public function hapusmenuu($id_data)
    {
        // $this->db->where('id',$id_data);
        $hsl = $this->db->delete('user_menu', array('id' => $id_data));
        if ($hsl) {
            return $hsl;
        } else {
            return false;
        }
    }

    public function editMenu($id, $data)
    {
        $this->db->where('id', $id);
        $hk = $this->db->update('user_menu', $data);
        if ($hk) {
            return $hk;
        } else {
            return false;
        }
    }

    public function hapusSubMenu($id_data)
    {
        // $this->db->where('id',$id_data);
        $hsl = $this->db->delete('user_sub_menu', array('id' => $id_data));
        if ($hsl) {
            return $hsl;
        } else {
            return false;
        }
    }

    public function editSubmenu($id_data)
    {
    }
}

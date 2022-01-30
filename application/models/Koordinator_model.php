<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Koordinator_model extends CI_Model
{
    public function getdataLksPkl()
    {
        return $this->db->query("SELECT * FROM m_lokasi")->result_array();
    }
}

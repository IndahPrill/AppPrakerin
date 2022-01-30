<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Koordinator_model extends CI_Model
{
    public function getdataLksPkl()
    {
        return $this->db->query("SELECT * FROM m_lokasi")->result_array();
    }

    public function addLksPkl($data)
    {
        return $this->db->insert('m_dosen', $data);
    }

    public function editLksPkl($id_dsn, $data)
    {
        $this->db->where('id_dsn', $id_dsn);
        $hsl = $this->db->update('m_dosen', $data);

        return $hsl;
    }

    public function deleteLksPkl($id_dsn)
    {
        $this->db->where('id_dsn', $id_dsn);
        $hsl = $this->db->delete('m_dosen');

        return $hsl;
    }
}

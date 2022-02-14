<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen_model extends CI_Model
{
    public function getDataDsn()
    {
        $role_id = $this->session->userdata('role_id');
        $whereStatus = ($role_id != 1) ? "WHERE status_dsn = '1'" : ""; // Menggunakan if one line
        $query = $this->db->query("SELECT * FROM m_dosen $whereStatus ORDER BY id_dsn DESC")->result_array();

        return $query;
    }

    public function addDsn($data)
    {
        return $this->db->insert('m_dosen', $data);
    }

    public function editDsn($id_dsn, $data)
    {
        $this->db->where('id_dsn', $id_dsn);
        $hsl = $this->db->update('m_dosen', $data);

        return $hsl;
    }

    public function deleteDsn($id_dsn)
    {
        $this->db->where('id_dsn', $id_dsn);
        $hsl = $this->db->delete('m_dosen');

        return $hsl;
    }

    public function uploadFileDsn($data, $id_nilai)
    {
        $this->db->where('id_nilai', $id_nilai);
        $query = $this->db->update('m_nilai', $data);

        return $query;
    }
}

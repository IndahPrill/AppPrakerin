<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{
    public function getDataMhs()
    {
        $role_id = $this->session->userdata('role_id');
        $whereStatus = ($role_id != 1) ? "WHERE status_mhs = '1'" : ""; // Menggunakan if one line
        $query = $this->db->query("SELECT * FROM m_mahasiswa $whereStatus ORDER BY id_mhs DESC")->result_array();

        return $query;
    }

    public function addMhs($data)
    {
        return $this->db->insert('m_mahasiswa', $data);
    }

    public function editMhs($id_mhs, $data)
    {
        $this->db->where('id_mhs', $id_mhs);
        $hsl = $this->db->update('m_mahasiswa', $data);

        return $hsl;
    }

    public function deleteMhs($id_mhs)
    {
        $this->db->where('id_mhs', $id_mhs);
        $hsl = $this->db->delete('m_mahasiswa');

        return $hsl;
    }

    public function getBimbinganKe($npm_mhs, $nik_dsn)
    {
        $query = $this->db->query("SELECT COUNT(bimbingan_ke) AS bim_ke FROM m_nilai WHERE nik_dsn=$nik_dsn AND npm_mhs=$npm_mhs")->row_array();

        if ($query['bim_ke'] > 0) {
            $bim_ke = $query['bim_ke'] + 1;
        } else {
            $bim_ke = 1;
        }

        return $bim_ke;
    }

    public function uploadFileMhs($data)
    {
        $query = $this->db->insert("m_nilai", $data);
        return $query;
    }
}

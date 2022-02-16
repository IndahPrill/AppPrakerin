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

    public function GetMhsBimbingan($nik_dsn)
    {
        $query = $this->db->query(
            "SELECT 
                a.npm_mhs,
                b.nama_mhs,
                b.prodi_mhs,
                b.kelas_mhs,
                (SELECT COUNT(mn.bimbingan_ke) FROM m_nilai mn WHERE mn.npm_mhs = a.npm_mhs) AS tot_bim
            FROM m_bimbingan a
                LEFT JOIN m_mahasiswa b ON a.npm_mhs = b.npm_mhs
                LEFT JOIN m_dosen c ON a.nik_dsn = c.nik_dsn
            WHERE 
                a.nik_dsn = '$nik_dsn'
                AND b.status_mhs = '1'
                AND c.status_dsn = '1'
            ORDER BY a.id_bim DESC"
        )->result_array();

        return $query;
    }

    public function getSubSidang($nik_dsn, $role_id)
    {
        if ($role_id == "2") {
            $whereNik = "AND a.nik_dsn = '$nik_dsn'";
        } else {
            $whereNik = "";
        }

        $query = $this->db->query(
            "SELECT 
                a.id_bim,
                a.npm_mhs,
                b.nama_mhs,
                b.prodi_mhs,
                b.kelas_mhs,
                (SELECT COUNT(mn.bimbingan_ke) FROM m_nilai mn WHERE mn.npm_mhs = a.npm_mhs) AS tot_bim,
                a.status_bimbingan,
                a.status_koor,
                a.catatan,
                a.catatan_koor
            FROM m_bimbingan a
                LEFT JOIN m_mahasiswa b ON a.npm_mhs = b.npm_mhs
                LEFT JOIN m_dosen c ON a.nik_dsn = c.nik_dsn
                LEFT JOIN m_nilai d ON a.nik_dsn = d.nik_dsn AND a.npm_mhs = d.npm_mhs
            WHERE 
                b.status_mhs = '1'
                AND c.status_dsn = '1'
                $whereNik
            GROUP BY a.npm_mhs
            ORDER BY a.id_bim DESC"
        )->result_array();

        return $query;
    }

    public function getFileLprnKoor()
    {
        $query = $this->db->query(
            "SELECT 
                a.npm_mhs,
                a.nik_dsn,
                a.bimbingan_ke,
                a.file_mhs,
                a.file_revisi,
                a.nilai_mhs,
                a.catatan
            FROM m_nilai a
                LEFT JOIN m_mahasiswa b ON a.npm_mhs = b.npm_mhs
            WHERE 
                b.status_mhs = '1'
            ORDER BY a.id_nilai DESC"
        )->result_array();

        return $query;
    }

    public function approveUpd($data, $id_bim)
    {
        $this->db->where('id_bim', $id_bim);
        $query = $this->db->update('m_bimbingan', $data);

        return $query;
    }
}

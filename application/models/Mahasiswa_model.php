<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{
    public function getDataMhs($role_id, $nik_dsn)
    {
        if ($nik_dsn == null) {
            $whereStatus = ($role_id != 1) ? "WHERE status_mhs = '1'" : ""; // Menggunakan if one line
            $query = $this->db->query("SELECT * FROM m_mahasiswa $whereStatus ORDER BY id_mhs DESC")->result_array();
        } else {
            $whereStatus = ($role_id != 1) ? "WHERE a.status_mhs = '1' AND b.nik_dsn = $nik_dsn" : ""; // Menggunakan if one line
            $query = $this->db->query(
                "SELECT
                    a.id_mhs,
                    a.npm_mhs,
                    a.nama_mhs,
                    a.prodi_mhs,
                    a.kelas_mhs,
                    a.status_mhs,
                    c.nama_perusahaan,
                    c.alamat_lks,
                    c.dsn_eksternal,
                    c.no_tlp_dsn_eksternal
                FROM 
                    m_mahasiswa a
                    LEFT JOIN m_bimbingan b ON b.npm_mhs = a.npm_mhs
                    LEFT JOIN m_lokasi c ON c.npm_mhs = a.npm_mhs
                $whereStatus 
                ORDER BY a.id_mhs DESC"
            )->result_array();
        }

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
        $query = $this->db->query(
            "SELECT 
                COUNT(a.bimbingan_ke) AS bim_ke 
            FROM m_nilai a
                LEFT JOIN m_mahasiswa b ON a.npm_mhs = b.npm_mhs
                LEFT JOIN m_dosen c ON a.nik_dsn = c.nik_dsn
            WHERE 
                b.status_mhs = '1'
                AND c.status_dsn = '1'
                AND a.nik_dsn=$nik_dsn 
                AND a.npm_mhs=$npm_mhs"
        )->row_array();

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

    public function getLaporanMhs($nik_dsn)
    {
        if ($nik_dsn == '0') {
            $whereNik = "";
        } else {
            $whereNik = "AND a.nik_dsn = $nik_dsn";
        }

        $query = $this->db->query(
            "SELECT 
                a.id_nilai,
                a.nik_dsn,
                a.npm_mhs,
                b.nama_mhs,
                a.bimbingan_ke,
                a.topik,
                a.nilai_mhs,
                b.kelas_mhs,
                a.file_mhs,
                a.catatan
            FROM m_nilai a
                LEFT JOIN m_mahasiswa b ON a.npm_mhs = b.npm_mhs
                LEFT JOIN m_dosen c ON a.nik_dsn = c.nik_dsn
            WHERE 
                b.status_mhs = '1'
                AND c.status_dsn = '1'
                $whereNik
            ORDER BY id_nilai DESC"
            )->result_array();

        return $query;
    }

    public function getDsnBim($npm_mhs)
    {
        $query = $this->db->query(
            "SELECT
                a.nik_dsn,
                a.nama_dsn,
                a.prodi_dsn,
                c.email,
                c.image
            FROM m_dosen a
                LEFT JOIN m_bimbingan b ON a.nik_dsn = b.nik_dsn
                LEFT JOIN user c ON a.nik_dsn = c.nik
            WHERE
                a.status_dsn = '1'
                AND b.npm_mhs = $npm_mhs
            ORDER BY id_dsn DESC"
        )->row_array();

        return $query;
    }
}

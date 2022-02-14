<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Koordinator_model extends CI_Model
{
    public function getdataLksPkl()
    {
        return $this->db->query("SELECT a.*, b.nama_mhs FROM m_lokasi a LEFT JOIN m_mahasiswa b ON a.npm_mhs = b.npm_mhs WHERE b.status_mhs = '1'")->result_array();
    }

    public function addLksPkl($data)
    {
        return $this->db->insert('m_lokasi', $data);
    }

    public function editLksPkl($id_lks, $data)
    {
        $this->db->where('id_lks', $id_lks);
        $hsl = $this->db->update('m_lokasi', $data);

        return $hsl;
    }

    public function deleteLksPkl($id_lks)
    {
        $this->db->where('id_lks', $id_lks);
        $hsl = $this->db->delete('m_lokasi');

        return $hsl;
    }

    public function getdataDsnPembimbing()
    {
        return $this->db->query(
            "SELECT 
                a.id_bim
                , a.status_bimbingan
                , b.nik_dsn
                , b.nama_dsn
                , c.npm_mhs
                , c.nama_mhs
            FROM 
                m_bimbingan a 
                LEFT JOIN m_dosen b ON a.nik_dsn = b.nik_dsn
                LEFT JOIN m_mahasiswa c ON a.npm_mhs = c.npm_mhs
            WHERE
                b.status_dsn = '1'
                AND c.status_mhs = '1'
            "
        )->result_array();
    }

    public function addDsnPembimbing($data)
    {
        return $this->db->insert('m_bimbingan', $data);
    }

    public function editDsnPembimbing($id_bim, $data)
    {
        $this->db->where('id_bim', $id_bim);
        $hsl = $this->db->update('m_bimbingan', $data);

        return $hsl;
    }

    public function deleteDsnPembimbing($id_bim)
    {
        $this->db->where('id_bim', $id_bim);
        $hsl = $this->db->delete('m_bimbingan');

        return $hsl;
    }

    public function getJurnalLaporan($npm_mhs)
    {
        if ($npm_mhs == '0') {
            $whereNpm = "AND a.npm_mhs = '$npm_mhs'";
        } else {
            $whereNpm = "";
        }

        $query = $this->db->query(
            "SELECT 
                a.id_nilai,
                b.nik_dsn,
                b.nama_dsn,
                a.bimbingan_ke,
                a.topik,
                a.file_mhs,
                a.file_revisi,
                a.catatan
            FROM
                m_nilai a
                LEFT JOIN m_dosen b ON a.nik_dsn = b.nik_dsn
                LEFT JOIN m_mahasiswa c ON a.npm_mhs = c.npm_mhs
            WHERE
                b.status_dsn = '1'
                AND c.status_mhs = '1'
                $whereNpm
            ORDER BY a.bimbingan_ke DESC"
        )->result_array();
        return  $query;
    }

    public function getDataDsn()
    {
        return $this->db->query(
            "SELECT 
                a.id_dsn
                , a.nik_dsn
                , a.nama_dsn
                , b.jmlh_dsn
            FROM 
                m_dosen a 
                LEFT JOIN (
                        SELECT 
                            mb.nik_dsn
                            , COUNT(mb.nik_dsn) jmlh_dsn 
                        FROM m_bimbingan mb 
                        GROUP BY mb.nik_dsn
                ) b ON a.nik_dsn = b.nik_dsn
            WHERE
                a.status_dsn = '1'"
        )->result_array();
    }

    public function getDataMhs()
    {
        return $this->db->query(
            "SELECT 
                a.id_mhs
                , a.npm_mhs
                , a.nama_mhs
                , b.jmlh_mhs
            FROM 
                m_mahasiswa a 
                LEFT JOIN (
                        SELECT 
                                mb.npm_mhs
                                , COUNT(mb.npm_mhs) jmlh_mhs 
                        FROM m_bimbingan mb 
                        GROUP BY mb.npm_mhs
                ) b ON a.npm_mhs = b.npm_mhs
            WHERE
                a.status_mhs = '1'"
        )->result_array();
    }

    public function getDataBimbingan($npm)
    {
        return $this->db->query(
            "SELECT 
                a.status_bimbingan
                , a.catatan
                , b.nik_dsn
                , b.nama_dsn
                , c.npm_mhs
                , c.nama_mhs
                , c.kelas_mhs
            FROM
                m_bimbingan a
                LEFT JOIN m_dosen b ON a.nik_dsn = b.nik_dsn
                LEFT JOIN m_mahasiswa c ON a.npm_mhs = c.npm_mhs
            WHERE
                b.status_dsn = '1'
                AND c.status_mhs = '1'
                AND c.npm_mhs = '$npm'"
        )->row_array();
    }
}

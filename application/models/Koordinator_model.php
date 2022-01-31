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

    public function getJurnalLaporan()
    {
        return $this->db->query("")->result_array();
    }
}

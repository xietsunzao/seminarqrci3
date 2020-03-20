<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function get_peserta()
    {
        $this->db->join('mahasiswa',  'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa', 'left');
        $this->db->join('presensi_seminar',  'presensi_seminar.id_mahasiswa = mahasiswa.id_mahasiswa', 'left');
        $this->db->join('status_kehadiran', 'status_kehadiran.id_stskhd = presensi_seminar.id_stskhd', 'left');
        return $this->db->get('pendaftaran_seminar')->result();
    }

    public function get_p()
    {
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa', 'right');
        return $this->db->get('pendaftaran_seminar')->result();
    }

    public function get_pst()
    {
        $this->db->join('mahasiswa',  'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa', 'left');
        $this->db->join('presensi_seminar',  'presensi_seminar.id_mahasiswa = mahasiswa.id_mahasiswa', 'left');
        $this->db->join('status_kehadiran', 'status_kehadiran.id_stskhd = presensi_seminar.id_stskhd', 'left');
        return $this->db->get('pendaftaran_seminar')->result();
    }

    public function get_khd()
    {
        $this->db->join('mahasiswa',  'mahasiswa.id_mahasiswa = presensi_seminar.id_mahasiswa', 'left');
        $this->db->join('pendaftaran_seminar',  'pendaftaran_seminar.id_mahasiswa = mahasiswa.id_mahasiswa', 'left');
        $this->db->join('status_kehadiran', 'status_kehadiran.id_stskhd = presensi_seminar.id_stskhd', 'left');
        return $this->db->get('presensi_seminar')->result();
    }

    public function get_presensi($peserta, $seminar)
    {
        return
            $this->db->where('presensi_seminar.id_seminar', $seminar)
            ->where('presensi_seminar.id_mahasiswa', $peserta)
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa = presensi_seminar.id_mahasiswa', 'left')
            ->get('presensi_seminar');
    }

    public function insert_data($data)
    {
        return $this->db->insert('presensi_seminar', $data);
    }

    
    function update_data($id, $data)
    {
        return $this->db->where('id_presensi', $id)->update('presensi_seminar', $data);
    }


    function delete_data($id)
    {
        return $this->db->where('id_presensi', $id)->delete('presensi_seminar');
    }

    function get_row($id)
    {
        $this->db->where('presensi_seminar.id_presensi', $id);
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = presensi_seminar.id_mahasiswa', 'left');
        $this->db->join('seminar', 'seminar.id_seminar = presensi_seminar.id_seminar', 'left');
        return $this->db->get('presensi_seminar');
    }

    function get_presensi_row($peserta)
    {
        $this->db->where('presensi_seminar.id_mahasiswa', $peserta);
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = presensi_seminar.id_mahasiswa', 'left');
        return $this->db->get('presensi_seminar');
    }
}

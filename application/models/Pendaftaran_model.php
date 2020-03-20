<?php

class Pendaftaran_model extends CI_Model
{
    function get_data($id_seminar)
    {
        $this->db->where('pendaftaran_seminar.id_seminar', $id_seminar);
        
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa', 'left');
        $this->db->join('seminar', 'seminar.id_seminar = pendaftaran_seminar.id_seminar', 'left');
        $this->db->join('status_pembayaran', 'status_pembayaran.id_stsbyr = pendaftaran_seminar.id_stsbyr', 'left');
        $this->db->join('metode_pembayaran', 'metode_pembayaran.id_metode = pendaftaran_seminar.id_metode', 'left');
        return $this->db->get('pendaftaran_seminar')->result();
    }

    function get_stsbyr()
    {
        return $this->db->get('status_pembayaran')->result();
    }

    function get_metode()
    {
        return $this->db->where_not_in('id_metode', '3')->get('metode_pembayaran')->result();
    }

    function insert_data($data)
    {
        return $this->db->insert('pendaftaran_seminar', $data);
    }

    function update_data($id, $data)
    {
        return $this->db->where('id_pendaftaran', $id)->update('pendaftaran_seminar', $data);
    }

    function get_pst()
    {
        $this->db->join('seminar', 'seminar.id_seminar = pendaftaran_seminar.id_seminar', 'right');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa  = pendaftaran_seminar.id_mahasiswa', 'right');
        return $this->db->get('pendaftaran_seminar')->result();
    }


    function cek_peserta($id,$seminar)
    {
        $this->db->where('mahasiswa.nim', $id);
        $this->db->where('pendaftaran_seminar.id_seminar', $seminar);
        $this->db->join('seminar', 'seminar.id_seminar = pendaftaran_seminar.id_seminar', 'right');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa  = pendaftaran_seminar.id_mahasiswa', 'right');
        return $this->db->get('pendaftaran_seminar');
    }

    function get_peserta($peserta, $seminar)
    {
        return
            $this->db->where('pendaftaran_seminar.id_seminar', $seminar)
            ->where('pendaftaran_seminar.id_mahasiswa', $peserta)
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa', 'left')
            ->get('pendaftaran_seminar');
    }

    function get_peserta_row($id, $peserta)
    {
        $this->db->where('pendaftaran_seminar.id_pendaftaran', $id);
        $this->db->where('pendaftaran_seminar.id_mahasiswa', $peserta);
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa', 'left');
        return $this->db->get('pendaftaran_seminar');
    }

    function get_row($id)
    {
        $this->db->where('pendaftaran_seminar.id_pendaftaran', $id);
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa', 'left');
        $this->db->join('seminar', 'seminar.id_seminar = pendaftaran_seminar.id_seminar', 'left');
        $this->db->join('status_pembayaran', 'status_pembayaran.id_stsbyr = pendaftaran_seminar.id_stsbyr', 'left');
        $this->db->join('metode_pembayaran', 'metode_pembayaran.id_metode = pendaftaran_seminar.id_metode', 'left');
        return $this->db->get('pendaftaran_seminar');
    }

    function delete_data($id)
    {
        return $this->db->where('id_pendaftaran', $id)->delete('pendaftaran_seminar');
    }
}

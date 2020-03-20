<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Scan_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Jefri Maruli <jefrimaruli@gmail.com>
 * @link      https://github.com/xietsunzao/
 * @param     ...
 * @return    ...
 *
 */

class Scan_model extends CI_Model
{
    public function cek_id($id)
    {
        $query =  $this->db->where('nim', $id)
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa', 'left')
            ->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi', 'left')
            ->join('konsentrasi', 'konsentrasi.id_konsentrasi = mahasiswa.id_konsentrasi', 'left')
            ->join('jenjang', 'jenjang.id_jenjang = mahasiswa.id_jenjang', 'left')
            ->get('pendaftaran_seminar');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }


    public function cek_khd($id,$seminar)
    {
        $query = $this->db
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa = presensi_seminar.id_mahasiswa', 'left')
            ->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi', 'left')
            ->join('konsentrasi', 'konsentrasi.id_konsentrasi = mahasiswa.id_konsentrasi', 'left')
            ->join('jenjang', 'jenjang.id_jenjang = mahasiswa.id_jenjang', 'left')
            ->get_where('presensi_seminar', ['presensi_seminar.nomor_induk' => $id, 'presensi_seminar.id_seminar' => $seminar]);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function insert_data($data)
    {
        return $this->db->insert('presensi_seminar', $data);
    }
}

/* End of file Scan_model.php */
/* Location: ./application/models/Scan_model.php */

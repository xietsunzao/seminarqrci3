<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Genqr_model
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
class Genqr_model extends CI_Model
{
    public function find_data($term)
    {
        $this->db->like('nama_mhs', $term, 'both');
        $this->db->order_by('nama_mhs', 'ASC');
        $this->db->limit(10);
        return $this->db->get('mahasiswa');
    }

    public function generate_qr($id)
    {
        $this->db->where('mahasiswa.nama_mhs', $id);
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi', 'left');
        $this->db->join('konsentrasi', 'konsentrasi.id_konsentrasi = mahasiswa.id_konsentrasi', 'left');
        $this->db->join('jenjang', 'jenjang.id_jenjang = mahasiswa.id_jenjang', 'left');
        return   $this->db->get('mahasiswa');
    }
}

/* End of file Genqr_model.php */
/* Location: ./application/models/Genqr_model.php */

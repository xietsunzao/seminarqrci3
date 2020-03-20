<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Prodi_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Jeff Maruli <jefrimaruli@gmail.com>
 * @link      https://github.com/xietsunzao/
 * @param     ...
 * @return    ...
 *
 */

class Prodi_model extends CI_Model
{

    /**
     * get_data.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Sunday, November 24th, 2019.
     * @access	public
     * @return	mixed
     */
    public function get_data()
    {
        return $this->db->get('prodi')->result();
    }

    /**
     * get_row.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Sunday, November 24th, 2019.
     * @access	public
     * @param	mixed	$id	
     * @return	mixed
     */
    public function get_row($id)
    {
        $this->db->where('mahasiswa.id_prodi', $id);
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi', 'left');
        $this->db->join('konsentrasi', 'konsentrasi.id_konsentrasi = mahasiswa.id_konsentrasi', 'left');
        $this->db->join('jenjang', 'jenjang.id_jenjang = mahasiswa.id_jenjang', 'left');
        return   $this->db->get('mahasiswa');
    }
    // ------------------------------------------------------------------------

}

/* End of file Prodi_model.php */
/* Location: ./application/models/Prodi_model.php */

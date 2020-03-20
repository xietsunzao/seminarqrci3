<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Seminar_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Jeff Maruli <jefrimarli@gmail.com>
 * @link      https://github.com/xietsunzao/
 * @param     ...
 * @return    ...
 *
 */

class Seminar_model extends CI_Model
{
    /**
     * get_data.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Thursday, November 21st, 2019.
     * @access	public
     * @return	void
     */
    public function get_data()
    {

        $this->db->join('tiket', 'tiket.id_seminar = seminar.id_seminar', 'left');
        return $this->db->get('seminar')->result();
    }

    /**
     * insert_data.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Saturday, November 23rd, 2019.
     * @access	public
     * @param	mixed	$data	
     * @return	mixed
     */
    public function insert_data($data)
    {
        return $this->db->insert('seminar', $data);
    }

    /**
     * get_row.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Saturday, November 23rd, 2019.
     * @access	public
     * @param	mixed	$id	
     * @return	mixed
     */
    public function get_row($id)
    {
        $this->db->join('tiket', 'tiket.id_seminar = seminar.id_seminar', 'left');
        $this->db->join('pembicara', 'pembicara.id_seminar = seminar.id_seminar', 'left');
        $this->db->join('sponsor', 'sponsor.id_seminar = seminar.id_seminar', 'left');
        $this->db->where('seminar.id_seminar', $id);
        return $this->db->get('seminar');
    }

    public function get_sm_row($id)
    {
        $this->db->where('seminar.id_seminar', $id);
        return $this->db->get('seminar');
    }
    /**
     * update_data.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Sunday, November 24th, 2019.
     * @param	mixed	$id  	
     * @param	mixed	$data	
     * @return	mixed
     */
    function update_data($id, $data)
    {
        $this->db->where('id_seminar', $id);
        return $this->db->update('seminar', $data);
    }

    /**
     * delete_data.
     *
     * @author	Jeff Maruli <jefrimaruli@gmail.com>
     * @since	v0.0.1
     * @version	v1.0.0	Sunday, November 24th, 2019.
     * @access	public
     * @param	mixed	$id	
     * @return	mixed
     */
    public function delete_data($id)
    {
        $this->db->where('id_seminar', $id);
        return $this->db->delete('seminar');
    }

    public function get_pembicara($id)
    {
        $this->db->where('id_seminar', $id);
        return $this->db->get('pembicara')->result();
    }

    function total_tiket($id)
    {
        return $this->db->where('id_seminar', $id)->get('tiket');
    }

    public function tiket_terjual($id)
    {
        return $this->db->where('id_seminar', $id)->get('pendaftaran_seminar')->num_rows();
    }

    public function get_sponsor($id)
    {
        $this->db->where('id_seminar', $id);
        return $this->db->get('sponsor')->result();
    }
}

/* End of file Seminar_model.php */
/* Location: ./application/models/Seminar_model.php */

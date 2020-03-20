<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Tiket_model
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

class Tiket_model extends CI_Model
{

    public function get_data()
    {
        $this->db->join('seminar', 'seminar.id_seminar = tiket.id_seminar', 'left');
        return $this->db->get('tiket')->result();
    }
    function get_seminar()
    {
        return $this->db->get('seminar')->result();
    }

    function cek_seminar($seminar){
        $this->db->join('seminar', 'seminar.id_seminar = tiket.id_seminar', 'left');
        return $this->db->where('tiket.id_seminar',$seminar)->get('tiket');
    }

    function cek_seminar_edit($seminar){
        $this->db->join('seminar', 'seminar.id_seminar = tiket.id_seminar', 'left');
        return $this->db->where_not_in('tiket.id_seminar',$seminar)->get('tiket');
    }
    
    function insert_data($data)
    {
        return $this->db->insert('tiket', $data);
    }

    function get_row($id)
    {
        return $this->db->where('id_tiket', $id)->get('tiket');
    }

    function update_data($id, $data)
    {
        return $this->db->where('id_tiket', $id)->update('tiket', $data);
    }

    function delete_data($id)
    {
        return $this->db->where('id_tiket', $id)->delete('tiket');
    }
}

/* End of file Tiket_model.php */
/* Location: ./application/models/Tiket_model.php */

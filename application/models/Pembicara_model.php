<?php

class Pembicara_model extends CI_Model
{
    function get_data()
    {
        return $this->db->join('seminar', 'seminar.id_seminar = pembicara.id_seminar', 'left')
            ->get('pembicara')->result();
    }

    function get_seminar()
    {
        return $this->db->get('seminar')->result();
    }

    function insert_data($data)
    {
        return $this->db->insert('pembicara', $data);
    }

    function get_row($id)
    {
        return $this->db->where('id_pembicara', $id)->get('pembicara');
    }

    function update_data($id, $data)
    {
        return $this->db->where('id_pembicara', $id)->update('pembicara', $data);
    }

    function delete_data($id)
    {
        return $this->db->where('id_pembicara', $id)->delete('pembicara');
    }
}

<?php

class Sponsor_model extends CI_Model
{
    function get_data()
    {
        return $this->db->join('seminar', 'seminar.id_seminar = sponsor.id_seminar', 'left')
            ->get('sponsor')->result();
    }

    function get_seminar()
    {
        return $this->db->get('seminar')->result();
    }

    function insert_data($data)
    {
        return $this->db->insert('sponsor', $data);
    }

    function get_row($id)
    {
        return $this->db->where('id_sponsor', $id)->get('sponsor');
    }

    function update_data($id, $data)
    {
        return $this->db->where('id_sponsor', $id)->update('sponsor', $data);
    }

    function delete_data($id)
    {
        return $this->db->where('id_sponsor', $id)->delete('sponsor');
    }
}

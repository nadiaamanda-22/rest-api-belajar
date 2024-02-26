<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{
    public function getData($id = null)
    {
        if ($id == null) {
            return $this->db->get('mahasiswa')->result_array();
        } else {
            return $this->db->get_where('mahasiswa', ['id' => $id])->result_array();
        }
    }

    public function delData($id)
    {
        $this->db->delete('Mahasiswa', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function addData($data)
    {
        $this->db->insert('Mahasiswa', $data);
        return $this->db->affected_rows();
    }

    public function updateData($id, $data)
    {
        $this->db->update('Mahasiswa', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}

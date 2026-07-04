<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penghuni_model extends CI_Model {

    public function get_all() {
        $this->db->select('p.*, k.nomor_kamar, k.tipe, k.harga');
        $this->db->from('penghuni p');
        $this->db->join('kamar k', 'k.id_kamar = p.id_kamar', 'left');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('p.*, k.nomor_kamar, k.tipe, k.harga');
        $this->db->from('penghuni p');
        $this->db->join('kamar k', 'k.id_kamar = p.id_kamar', 'left');
        $this->db->where('p.id_penghuni', $id);
        return $this->db->get()->row();
    }

    public function tambah($data) {
        $data['password'] = md5($data['password']);
        return $this->db->insert('penghuni', $data);
    }

    public function update($id, $data) {
        if (!empty($data['password'])) {
            $data['password'] = md5($data['password']);
        } else {
            unset($data['password']);
        }
        $this->db->where('id_penghuni', $id);
        return $this->db->update('penghuni', $data);
    }

    public function hapus($id) {
        return $this->db->delete('penghuni', ['id_penghuni' => $id]);
    }

    public function count_all() {
        return $this->db->count_all('penghuni');
    }
}

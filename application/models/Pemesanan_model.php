<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan_model extends CI_Model {

    public function get_all() {
        $this->db->select('pm.*, p.nama as nama_penghuni, k.nomor_kamar, k.tipe, k.harga');
        $this->db->from('pemesanan pm');
        $this->db->join('penghuni p', 'p.id_penghuni = pm.id_penghuni');
        $this->db->join('kamar k', 'k.id_kamar = pm.id_kamar');
        $this->db->order_by('pm.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_penghuni($id_penghuni) {
        $this->db->select('pm.*, k.nomor_kamar, k.tipe, k.harga');
        $this->db->from('pemesanan pm');
        $this->db->join('kamar k', 'k.id_kamar = pm.id_kamar');
        $this->db->where('pm.id_penghuni', $id_penghuni);
        $this->db->order_by('pm.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function tambah($data) {
        return $this->db->insert('pemesanan', $data);
    }

    public function update_status($id, $status) {
        $this->db->where('id_pemesanan', $id);
        return $this->db->update('pemesanan', ['status' => $status]);
    }

    public function get_by_id($id) {
        return $this->db->get_where('pemesanan', ['id_pemesanan' => $id])->row();
    }

    public function count_pending() {
        return $this->db->get_where('pemesanan', ['status' => 'Pending'])->num_rows();
    }
}

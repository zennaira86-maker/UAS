<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_model extends CI_Model {

    public function get_all() {
        $this->db->select('pb.*, p.nama as nama_penghuni, k.nomor_kamar, k.tipe');
        $this->db->from('pembayaran pb');
        $this->db->join('penghuni p', 'p.id_penghuni = pb.id_penghuni');
        $this->db->join('kamar k', 'k.id_kamar = pb.id_kamar');
        $this->db->order_by('pb.tanggal_bayar', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_penghuni($id_penghuni) {
        $this->db->select('pb.*, k.nomor_kamar, k.tipe');
        $this->db->from('pembayaran pb');
        $this->db->join('kamar k', 'k.id_kamar = pb.id_kamar');
        $this->db->where('pb.id_penghuni', $id_penghuni);
        $this->db->order_by('pb.tanggal_bayar', 'DESC');
        return $this->db->get()->result();
    }

    public function tambah($data) {
        return $this->db->insert('pembayaran', $data);
    }

    public function verifikasi($id) {
        $this->db->where('id_pembayaran', $id);
        return $this->db->update('pembayaran', ['status' => 'Lunas']);
    }

    public function total_pendapatan() {
        $this->db->select_sum('jumlah_bayar', 'total');
        $this->db->where('status', 'Lunas');
        return $this->db->get('pembayaran')->row()->total;
    }

    public function rekap_per_bulan() {
        $this->db->select('bulan_bayar, SUM(jumlah_bayar) as total, COUNT(*) as jumlah_transaksi');
        $this->db->where('status', 'Lunas');
        $this->db->group_by('bulan_bayar');
        $this->db->order_by('tanggal_bayar', 'DESC');
        return $this->db->get('pembayaran')->result();
    }

    public function count_pending() {
        return $this->db->get_where('pembayaran', ['status' => 'Pending'])->num_rows();
    }
}

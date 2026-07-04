<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_cek_login();
        $this->load->model(['Kamar_model', 'Penghuni_model', 'Pemesanan_model', 'Pembayaran_model']);
    }

    private function _cek_login() {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'admin') {
            redirect('login');
        }
    }


    public function dashboard() {
        $data['title']           = 'Dashboard';
        $data['total_kamar']     = count($this->Kamar_model->get_all());
        $data['kamar_kosong']    = $this->Kamar_model->count_by_status('Kosong');
        $data['kamar_terisi']    = $this->Kamar_model->count_by_status('Terisi');
        $data['total_penghuni']  = $this->Penghuni_model->count_all();
        $data['total_pendapatan']= $this->Pembayaran_model->total_pendapatan();
        $data['pending_bayar']   = $this->Pembayaran_model->count_pending();
        $data['pending_pesan']   = $this->Pemesanan_model->count_pending();
        $data['penghuni']        = $this->Penghuni_model->get_all();
        $data['pembayaran_terbaru'] = $this->Pembayaran_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }


    public function kamar() {
        $data['title']  = 'Data Kamar';
        $data['kamar']  = $this->Kamar_model->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/kamar', $data);
        $this->load->view('templates/footer');
    }

    public function kamar_tambah() {
        $data['title'] = 'Tambah Kamar';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/kamar_form', $data);
        $this->load->view('templates/footer');
    }

    public function kamar_simpan() {
        $data = [
            'nomor_kamar' => $this->input->post('nomor_kamar'),
            'tipe'        => $this->input->post('tipe'),
            'harga'       => $this->input->post('harga'),
            'fasilitas'   => $this->input->post('fasilitas'),
            'status'      => $this->input->post('status'),
        ];
        $this->Kamar_model->tambah($data);
        $this->session->set_flashdata('success', 'Kamar berhasil ditambahkan!');
        redirect('admin/kamar');
    }

    public function kamar_edit($id) {
        $data['title'] = 'Edit Kamar';
        $data['kamar'] = $this->Kamar_model->get_by_id($id);
        $this->load->view('templates/header', $data);
        $this->load->view('admin/kamar_form', $data);
        $this->load->view('templates/footer');
    }

    public function kamar_update($id) {
        $data = [
            'nomor_kamar' => $this->input->post('nomor_kamar'),
            'tipe'        => $this->input->post('tipe'),
            'harga'       => $this->input->post('harga'),
            'fasilitas'   => $this->input->post('fasilitas'),
            'status'      => $this->input->post('status'),
        ];
        $this->Kamar_model->update($id, $data);
        $this->session->set_flashdata('success', 'Kamar berhasil diperbarui!');
        redirect('admin/kamar');
    }

    public function kamar_hapus($id) {
        $this->Kamar_model->hapus($id);
        $this->session->set_flashdata('success', 'Kamar berhasil dihapus!');
        redirect('admin/kamar');
    }

    
    public function penghuni() {
        $data['title']    = 'Data Penghuni';
        $data['penghuni'] = $this->Penghuni_model->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/penghuni', $data);
        $this->load->view('templates/footer');
    }

    public function penghuni_tambah() {
        $data['title'] = 'Tambah Penghuni';
        $data['kamar'] = $this->Kamar_model->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/penghuni_form', $data);
        $this->load->view('templates/footer');
    }

    public function penghuni_simpan() {
        $data = [
            'nama'     => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'alamat'   => $this->input->post('alamat'),
            'no_hp'    => $this->input->post('no_hp'),
            'id_kamar' => $this->input->post('id_kamar'),
            'status_sewa' => 'Aktif',
        ];
        $this->Penghuni_model->tambah($data);
        // Update status kamar
        if (!empty($data['id_kamar'])) {
            $this->Kamar_model->update_status($data['id_kamar'], 'Terisi');
        }
        $this->session->set_flashdata('success', 'Penghuni berhasil ditambahkan!');
        redirect('admin/penghuni');
    }

    public function penghuni_edit($id) {
        $data['title']    = 'Edit Penghuni';
        $data['penghuni'] = $this->Penghuni_model->get_by_id($id);
        $data['kamar']    = $this->Kamar_model->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/penghuni_form', $data);
        $this->load->view('templates/footer');
    }

    public function penghuni_update($id) {
        $data = [
            'nama'        => $this->input->post('nama'),
            'username'    => $this->input->post('username'),
            'password'    => $this->input->post('password'),
            'alamat'      => $this->input->post('alamat'),
            'no_hp'       => $this->input->post('no_hp'),
            'id_kamar'    => $this->input->post('id_kamar'),
            'status_sewa' => $this->input->post('status_sewa'),
        ];
        $this->Penghuni_model->update($id, $data);
        $this->session->set_flashdata('success', 'Penghuni berhasil diperbarui!');
        redirect('admin/penghuni');
    }

    public function penghuni_hapus($id) {
        $this->Penghuni_model->hapus($id);
        $this->session->set_flashdata('success', 'Penghuni berhasil dihapus!');
        redirect('admin/penghuni');
    }


    public function pemesanan() {
        $data['title']     = 'Data Pemesanan';
        $data['pemesanan'] = $this->Pemesanan_model->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/pemesanan', $data);
        $this->load->view('templates/footer');
    }

    public function pemesanan_setujui($id) {
        $pm = $this->Pemesanan_model->get_by_id($id);
        $this->Pemesanan_model->update_status($id, 'Disetujui');
        $this->Kamar_model->update_status($pm->id_kamar, 'Terisi');
        // Update penghuni kamar
        $this->db->where('id_penghuni', $pm->id_penghuni);
        $this->db->update('penghuni', ['id_kamar' => $pm->id_kamar, 'status_sewa' => 'Aktif']);
        $this->session->set_flashdata('success', 'Pemesanan disetujui!');
        redirect('admin/pemesanan');
    }

    public function pemesanan_tolak($id) {
        $this->Pemesanan_model->update_status($id, 'Ditolak');
        $this->session->set_flashdata('success', 'Pemesanan ditolak.');
        redirect('admin/pemesanan');
    }


    public function pembayaran() {
        $data['title']      = 'Pembayaran Sewa';
        $data['pembayaran'] = $this->Pembayaran_model->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/pembayaran', $data);
        $this->load->view('templates/footer');
    }

    public function pembayaran_tambah() {
        $data['title']    = 'Input Pembayaran';
        $data['penghuni'] = $this->Penghuni_model->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/pembayaran_form', $data);
        $this->load->view('templates/footer');
    }

    public function pembayaran_simpan() {
        $id_penghuni = $this->input->post('id_penghuni');
        $penghuni    = $this->Penghuni_model->get_by_id($id_penghuni);
        $data = [
            'id_penghuni'  => $id_penghuni,
            'id_kamar'     => $penghuni->id_kamar,
            'tanggal_bayar'=> $this->input->post('tanggal_bayar'),
            'bulan_bayar'  => $this->input->post('bulan_bayar'),
            'jumlah_bayar' => $this->input->post('jumlah_bayar'),
            'metode_bayar' => $this->input->post('metode_bayar'),
            'status'       => 'Lunas',
            'keterangan'   => $this->input->post('keterangan'),
        ];
        $this->Pembayaran_model->tambah($data);
        $this->session->set_flashdata('success', 'Pembayaran berhasil dicatat!');
        redirect('admin/pembayaran');
    }

    public function pembayaran_verifikasi($id) {
        $this->Pembayaran_model->verifikasi($id);
        $this->session->set_flashdata('success', 'Pembayaran diverifikasi sebagai Lunas!');
        redirect('admin/pembayaran');
    }


    public function laporan() {
        $data['title']          = 'Laporan Pembayaran';
        $data['rekap']          = $this->Pembayaran_model->rekap_per_bulan();
        $data['detail']         = $this->Pembayaran_model->get_all();
        $data['total']          = $this->Pembayaran_model->total_pendapatan();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function laporan_cetak() {
        $data['title']  = 'Laporan Pembayaran - Cetak';
        $data['rekap']  = $this->Pembayaran_model->rekap_per_bulan();
        $data['detail'] = $this->Pembayaran_model->get_all();
        $data['total']  = $this->Pembayaran_model->total_pendapatan();
        $this->load->view('admin/laporan_cetak', $data);
    }
}

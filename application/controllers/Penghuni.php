<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penghuni extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_cek_login();
        $this->load->model(['Kamar_model', 'Penghuni_model', 'Pemesanan_model', 'Pembayaran_model']);
    }

    private function _cek_login() {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'penghuni') {
            redirect('login');
        }
    }

    public function dashboard() {
        $id = $this->session->userdata('id');
        $data['title']     = 'Dashboard Penghuni';
        $data['penghuni']  = $this->Penghuni_model->get_by_id($id);
        $data['pemesanan'] = $this->Pemesanan_model->get_by_penghuni($id);
        $data['pembayaran']= $this->Pembayaran_model->get_by_penghuni($id);
        $this->load->view('templates/header', $data);
        $this->load->view('penghuni/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function kamar() {
        $data['title'] = 'Daftar Kamar';
        $data['kamar'] = $this->Kamar_model->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('penghuni/kamar', $data);
        $this->load->view('templates/footer');
    }

    public function pesan($id_kamar) {
        $kamar  = $this->Kamar_model->get_by_id($id_kamar);
        $id_ph  = $this->session->userdata('id');
        if ($kamar && $kamar->status === 'Kosong') {
            $data = [
                'id_penghuni'   => $id_ph,
                'id_kamar'      => $id_kamar,
                'tanggal_pesan' => date('Y-m-d'),
                'status'        => 'Pending',
            ];
            $this->Pemesanan_model->tambah($data);
            $this->session->set_flashdata('success', 'Pemesanan berhasil dikirim! Tunggu konfirmasi admin.');
        } else {
            $this->session->set_flashdata('error', 'Kamar tidak tersedia.');
        }
        redirect('penghuni/pemesanan');
    }

    public function pemesanan() {
        $data['title']     = 'Pemesanan Saya';
        $data['pemesanan'] = $this->Pemesanan_model->get_by_penghuni($this->session->userdata('id'));
        $this->load->view('templates/header', $data);
        $this->load->view('penghuni/pemesanan', $data);
        $this->load->view('templates/footer');
    }

    public function pembayaran() {
        $data['title']      = 'Riwayat Pembayaran';
        $data['pembayaran'] = $this->Pembayaran_model->get_by_penghuni($this->session->userdata('id'));
        $data['total']      = array_sum(array_column(
            array_filter((array)$data['pembayaran'], fn($p) => $p->status === 'Lunas'),
            'jumlah_bayar'
        ));
        $this->load->view('templates/header', $data);
        $this->load->view('penghuni/pembayaran', $data);
        $this->load->view('templates/footer');
    }
}

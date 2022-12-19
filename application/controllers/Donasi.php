<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    //manajemen Donasi
    public function index()
    {
        $data['judul'] = 'Data Donasi';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['donasi'] = $this->ModelDonasi->getDonasi()->result_array();
        $data['kategori'] = $this->ModelDonasi->getKategori()->result_array();

        $this->form_validation->set_rules('nm_projek', 'Nama Projek', 'required|min_length[3]', [
            'required' => 'Nama Projek harus diisi',
            'min_length' => 'Nama Projek terlalu pendek'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Kategori harus diisi',
        ]);
        $this->form_validation->set_rules('tempat', 'Nama Tempat', 'required|min_length[3]', [
            'required' => 'Nama Tempat harus diisi',
            'min_length' => 'Nama Tempat terlalu pendek'
        ]);

        $this->form_validation->set_rules('waktu', 'Waktu', 'required|min_length[3]|max_length[4]|numeric', [
            'required' => 'Waktu harus diisi',
            'min_length' => 'Waktu terlalu pendek',
            'max_length' => 'Waktu terlalu panjang',
            'numeric' => 'Hanya boleh diisi angka'
        ]);


        $this->form_validation->set_rules('jml_dana', 'Jumlah Dana', 'required|numeric', [
            'required' => 'Jumlah Dana harus diisi',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('donasi/index', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $gambar = '';
            }

            $data = [
                'nm_projek' => $this->input->post('nm_projek', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'tempat' => $this->input->post('tempat', true),

                'waktu' => $this->input->post('waktu', true),

                'jml_dana' => $this->input->post('jml_dana', true),

                'image' => $gambar
            ];

            $this->ModelDonasi->simpanDonasi($data);
            redirect('donasi');
        }
    }

    public function hapusDonasi()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelDonasi->hapusDonasi($where);
        redirect('donasi');
    }

    public function ubahDonasi()
    {
        $data['judul'] = 'Ubah Data Projek';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['donasi'] = $this->ModelDonasi->donasiWhere(['id' => $this->uri->segment(3)])->result_array();
        $kategori = $this->ModelDonasi->joinKategoriDonasi(['donasi.id' => $this->uri->segment(3)])->result_array();
        foreach ($kategori as $k) {
            $data['id'] = $k['id_kategori'];
            $data['k'] = $k['kategori'];
        }
        $data['kategori'] = $this->ModelDonasi->getKategori()->result_array();

        $this->form_validation->set_rules('nm_projek', 'Nama Projek', 'required|min_length[3]', [
            'required' => 'Nama Projek harus diisi',
            'min_length' => 'Nama Projek terlalu pendek'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Nama Projek harus diisi',
        ]);
        $this->form_validation->set_rules('tempat', 'Nama Tempat', 'required|min_length[3]', [
            'required' => 'Nama Tempat harus diisi',
            'min_length' => 'Nama Tempat terlalu pendek'
        ]);

        $this->form_validation->set_rules('waktu', 'Waktu', 'required|min_length[3]|max_length[4]|numeric', [
            'required' => 'Waktu donasi harus diisi',
            'min_length' => 'Waktu donasi terlalu pendek',
            'max_length' => 'Waktu donasi terlalu panjang',
            'numeric' => 'Hanya boleh diisi angka'
        ]);

        $this->form_validation->set_rules('jml_dana', 'Jumlah Dana', 'required|numeric', [
            'required' => 'Stok harus diisi',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();

        //memuat atau memanggil library upload
        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('donasi/ubah_donasi', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
                $gambar = $image['file_name'];
            } else {
                $gambar = $this->input->post('old_pict', TRUE);
            }

            $data = [
                'nm_projek' => $this->input->post('nm_projek', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'tempat' => $this->input->post('tempat', true),

                'waktu' => $this->input->post('waktu', true),

                'jml_dana' => $this->input->post('jml_dana', true),
                'image' => $gambar
            ];

            $this->ModelDonasi->updateDonasi($data, ['id' => $this->input->post('id')]);
            redirect('donasi');
        }
    }

    //manajemen kategori
    public function kategori()
    {
        $data['judul'] = 'Kategori Donasi';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelDonasi->getKategori()->result_array();

        $this->form_validation->set_rules('kategori', 'Kategori', 'required', [
            'required' => 'Nama Projek harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('donasi/kategori', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kategori' => $this->input->post('kategori', TRUE)
            ];

            $this->ModelDonasi->simpanKategori($data);
            redirect('donasi/kategori');
        }
    }

    public function ubahKategori()
    {
        $data['judul'] = 'Ubah Data Kategori';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelDonasi->kategoriWhere(['id' => $this->uri->segment(3)])->result_array();


        $this->form_validation->set_rules('kategori', 'Nama Kategori', 'required|min_length[3]', [
            'required' => 'Nama Kategori harus diisi',
            'min_length' => 'Nama Kategori terlalu pendek'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('donasi/ubah_kategori', $data);
            $this->load->view('templates/footer');
        } else {

            $data = [
                'kategori' => $this->input->post('kategori', true)
            ];

            $this->ModelDonasi->updateKategori(['id' => $this->input->post('id')], $data);
            redirect('donasi/kategori');
        }
    }

    public function hapusKategori()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelDonasi->hapusKategori($where);
        redirect('donasi/kategori');
    }
}

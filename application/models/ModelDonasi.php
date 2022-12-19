<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ModelDonasi extends CI_Model
{
    //manajemen donasi
    public function getDonasi()
    {
        return $this->db->get('donasi');
    }
    public function donasiWhere($where)
    {
        return $this->db->get_where('donasi', $where);
    }
    public function simpanDonasi($data = null)
    {
        $this->db->insert('donasi', $data);
    }
    public function updateDonasi($data = null, $where = null)
    {
        $this->db->update('donasi', $data, $where);
    }
    public function hapusDonasi($where = null)
    {
        $this->db->delete('donasi', $where);
    }
    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if (!empty($where) && count($where) > 0) {
            $this->db->where($where);
        }
        $this->db->from('donasi');
        return $this->db->get()->row($field);
    }

    //manajemen kategori
    public function getKategori()
    {
        return $this->db->get('kategori');
    }
    public function kategoriWhere($where)
    {
        return $this->db->get_where('kategori', $where);
    }
    public function simpanKategori($data = null)
    {
        $this->db->insert('kategori', $data);
    }
    public function hapusKategori($where = null)
    {
        $this->db->delete('kategori', $where);
    }
    public function updateKategori($where = null, $data = null)
    {
        $this->db->update('kategori', $data, $where);
    }
    //join
    public function joinKategoriDonasi($where)
    {
        $this->db->select('donasi.id_kategori,kategori.kategori');
        $this->db->from('donasi');
        $this->db->join('kategori', 'kategori.id = donasi.id_kategori');
        $this->db->where($where);
        return $this->db->get();
    }
}
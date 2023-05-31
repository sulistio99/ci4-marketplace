<?php

namespace App\Controllers;

use App\Models\ModelKategori;

class Kategori extends BaseController
{

  public function __construct()
  {
    helper('form');
    $this->ModelKategori = new ModelKategori();
  }
  public function index()
  {
    $data = [
      'title' => 'Kategori',
      'menu' => 'kelolabarang',
      'submenu' => 'kategori',
      'page' => 'v_kategori',
      'kategori' => $this->ModelKategori->AllData()
    ];
    return view('v_template_admin', $data);
  }

  public function Add()
  {
    $data = [
      'nama_kategori' => $this->request->getPost('nama_kategori')
    ];
    session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
    $this->ModelKategori->AddData($data);
    return redirect()->to(base_url('Kategori'));
  }

  public function EditData($id_kategori)
  {
    $data = [
      'id_kategori' => $id_kategori,
      'nama_kategori' => $this->request->getPost('nama_kategori')
    ];
    session()->setFlashdata('pesan', 'Data Berhasil Diubah');
    $this->ModelKategori->EditData($data);
    return redirect()->to(base_url('Kategori'));
  }

  public function DeleteData($id_kategori)
  {
    $data = [
      'id_kategori' => $id_kategori
    ];
    session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
    $this->ModelKategori->DeleteData($data);
    return redirect()->to(base_url('Kategori'));
  }
}

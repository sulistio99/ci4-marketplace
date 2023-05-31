<?php

namespace App\Controllers;

use App\Models\ModelBarang;
use App\Models\ModelKategori;
use App\Models\ModelUser;


class Barang extends BaseController
{

  public function __construct()
  {
    helper('form');
    $this->ModelBarang = new ModelBarang();
    $this->ModelKategori = new ModelKategori();
    $this->ModelUser = new ModelUser();
  }
  public function index()
  {
    $data = [
      'title' => 'Daftar Barang',
      'menu' => 'kelolabarang',
      'submenu' => 'daftarbarang',
      'page' => 'barang/v_index_barang',
      'barang' => $this->ModelBarang->AllData()
    ];
    return view('v_template_admin', $data);
  }

  public function TambahBarang()
  {
    $data = [
      'title' => 'Tambah Data Barang',
      'menu' => 'kelolabarang',
      'submenu' => 'daftarbarang',
      'page' => 'barang/v_tambah_barang',
      'user' => $this->ModelUser->AllData(),
      'kategori' => $this->ModelKategori->AllData()
    ];
    return view('v_template_admin', $data);
  }

  public function SimpanDataBarang()
  {
    if ($this->validate([
      'id_user' => [
        'label' => 'Nama User',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'id_kategori' => [
        'label' => 'Nama Kategori',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!',
        ]
      ],
      'nama_barang' => [
        'label' => 'Nama Barang',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'harga_barang' => [
        'label' => 'Harga Barang',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'tanggal' => [
        'label' => 'Tanggal Masuk',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'status' => [
        'label' => 'Status',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'deskripsi' => [
        'label' => 'Deskripsi',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'foto1' => [
        'label' => 'Foto',
        // tidak wajib ganti foto 
        'rules' => 'uploaded[foto1]|max_size[foto1,2048]|mime_in[foto1,image/png,image/jpg,image/gif,image/jpeg]',
        'errors' => [
          'uploaded' => '{field} Wajib Diisi!.',
          'max_size' => '{field} Max 2Mb.',
          'mime_in' => 'Format {field} Harus JPG, JPEG, PNG,GIF',
        ]
      ],
    ])) {
      // ambil dlu getfile dari form
      $foto = $this->request->getFile('foto1');
      // getrandomname untuk penamaan file
      $nama_file = $foto->getRandomName();
      // ambil variabel dari form users
      $data = [
        'id_user' => $this->request->getPost('id_user'),
        'id_kategori' => $this->request->getPost('id_kategori'),
        'nama_barang' => $this->request->getPost('nama_barang'),
        'harga_barang' => $this->request->getPost('harga_barang'),
        'tanggal' => $this->request->getPost('tanggal'),
        'status' => $this->request->getPost('status'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'foto1' => $nama_file,
      ];
      $foto->move('foto/FotoBarang', $nama_file);
      $this->ModelBarang->AddData($data);
      session()->setFlashdata('pesan', 'Data Barang Berhasil Ditambahkan!');
      return redirect()->to(base_url('Barang'));
      // jika entri tidak valid
    } else {
      session()->setFlashdata('errors', \config\Services::validation()->getErrors());
      return redirect()->to(base_url('Barang/TambahBarang'))->withInput('validation', \Config\Services::validation());
    }
  }

  public function UbahBarang($id_barang)
  {
    $data = [
      'title' => 'Ubah Data Barang',
      'menu' => 'kelolabarang',
      'submenu' => 'daftarbarang',
      'page' => 'barang/v_ubah_barang',
      'user' => $this->ModelUser->AllData(),
      'barang' => $this->ModelBarang->DetailBarang($id_barang),
      'kategori' => $this->ModelKategori->AllData()
    ];
    return view('v_template_admin', $data);
  }

  public function UbahDataBarang($id_barang)
  {
    if ($this->validate([
      'id_user' => [
        'label' => 'Nama User',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'id_kategori' => [
        'label' => 'Nama Kategori',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!',
        ]
      ],
      'nama_barang' => [
        'label' => 'Nama Barang',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'harga_barang' => [
        'label' => 'Harga Barang',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'tanggal' => [
        'label' => 'Tanggal Masuk',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'status' => [
        'label' => 'Status',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'deskripsi' => [
        'label' => 'Deskripsi',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'foto1' => [
        'label' => 'Foto',
        // tidak wajib ganti foto 
        'rules' => 'max_size[foto1,2048]|mime_in[foto1,image/png,image/jpg,image/gif,image/jpeg]',
        'errors' => [
          'max_size' => '{field} Max 2Mb.',
          'mime_in' => 'Format {field} Harus JPG, JPEG, PNG,GIF',
        ]
      ],
    ])) {
      // ambil dlu getfile dari form
      $foto = $this->request->getFile('foto1');

      if ($foto->getError() == 4) {
        // ambil variabel dari form users
        $data = [
          'id_barang' => $id_barang,
          'id_user' => $this->request->getPost('id_user'),
          'id_kategori' => $this->request->getPost('id_kategori'),
          'nama_barang' => $this->request->getPost('nama_barang'),
          'harga_barang' => $this->request->getPost('harga_barang'),
          'tanggal' => $this->request->getPost('tanggal'),
          'status' => $this->request->getPost('status'),
          'deskripsi' => $this->request->getPost('deskripsi')
        ];
        $this->ModelBarang->EditData($data);
      } else {
        // jika ganti gambar
        // hapus foto lama
        $barang = $this->ModelBarang->DetailBarang($id_barang);
        if ($barang['foto1'] <> '' or $barang['foto1'] <> null) {
          // unlink untuk hapus foto lama gantiyang baru
          unlink('Foto/FotoBarang/' . $barang['foto1']);
        }
        // getrandomname untuk penamaan file
        $nama_file = $foto->getRandomName();
        $data = [
          'id_barang' => $id_barang,
          'id_user' => $this->request->getPost('id_user'),
          'id_kategori' => $this->request->getPost('id_kategori'),
          'nama_barang' => $this->request->getPost('nama_barang'),
          'harga_barang' => $this->request->getPost('harga_barang'),
          'tanggal' => $this->request->getPost('tanggal'),
          'status' => $this->request->getPost('status'),
          'deskripsi' => $this->request->getPost('deskripsi'),
          'foto1' => $nama_file
        ];
        $foto->move('foto/FotoBarang', $nama_file);
        $this->ModelBarang->EditData($data);
      }
      session()->setFlashdata('pesan', 'Data Barang Berhasil Diubah!');
      return redirect()->to(base_url('Barang'));
      // jika entri tidak valid
    } else {
      session()->setFlashdata('errors', \config\Services::validation()->getErrors());
      return redirect()->to(base_url('Barang/TambahBarang'))->withInput('validation', \Config\Services::validation());
    }
  }

  public function DeleteData($id_barang)
  {
    // hapus foto lama
    $barang = $this->ModelBarang->DetailBarang($id_barang);
    if ($barang['foto1'] <> '' or $barang['foto1'] <> null) {
      // unlink untuk hapus foto lama gantiyang baru
      unlink('foto/FotoBarang/' . $barang['foto1']);
    }

    $data = [
      'id_barang' => $id_barang
    ];
    $this->ModelBarang->DeleteData($data);
    session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
    return redirect()->to(base_url('Barang'));
  }
}

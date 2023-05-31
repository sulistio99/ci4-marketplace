<?php

namespace App\Controllers;

use App\Models\ModelUser;
use App\Models\ModelAdmin;
use App\Models\ModelBarang;
use App\Models\ModelKategori;
use App\Models\ModelGambar;

class User extends BaseController
{

  public function __construct()
  {
    helper('form');
    helper('number');
    $this->ModelUser = new ModelUser();
    $this->ModelBarang = new ModelBarang();
    $this->ModelKategori = new ModelKategori();
    $this->ModelAdmin = new ModelAdmin();
    $this->ModelGambar = new ModelGambar();
  }

  public function index()
  {
    $id_user = session('id_user');
    $data = [
      'menu' => '',
      'submenu' => '',
      'page' => 'v_home',
      // 'barang' => $this->ModelBarang->AllData(),
      // 'kategori' => $this->ModelKategori->AllData(),
      // 'cart' => $this->ModelBarang->AllCart($id_user),
      // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
      // 'notifikasi' => $this->ModelBarang->AllNotifikasi($id_user),
      // 'totalnotifikasi' => $this->ModelBarang->TotalNotifikasi($id_user),
      // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  public function Notifikasi()
  {
    $id_user = session('id_user');
    $id_pembeli = session('id_user');
    $id_penjual = session('id_barang');
    $data = [
      'title' => 'Notifikasi',
      'menu' => '',
      'submenu' => '',
      'page' => 'user/v_notifikasi',
      'namapenjual' => $this->ModelBarang->NamaPenjual($id_penjual),
      'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user),
      'notifikasi' => $this->ModelBarang->AllNotifikasi($id_user),
      // 'cart' => $this->ModelBarang->AllCart($id_pembeli),
      // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
    ];

    return view('v_template_user', $data);
  }

  public function DashboardUser()
  {
    $id_user = session('id_user');
    $data = [
      'title' => 'Dashboard',
      'menu' => 'dashboarduser',
      'submenu' => '',
      'page' => 'user/v_dashboard_user',
      'user' => $this->ModelUser->Profileuser($id_user),
      'totalbarang' => $this->ModelBarang->TotalBarangUser($id_user),
      'totalriwayattransaksi' => $this->ModelBarang->TotalRiwayatTransaksi($id_user),
      'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user),
      // 'kategori' => $this->ModelKategori->AllData(),
      // 'cart' => $this->ModelBarang->AllCart($id_user),
      // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
    ];
    return view('v_template_user', $data);
  }

  public function EditProfil()
  {
    $id_user = session('id_user');
    $data = [
      'menu' => 'edituser',
      'submenu' => '',
      'page' => 'user/v_edituser',
      'kategori' => $this->ModelKategori->AllData(),
      'user' => $this->ModelUser->Profileuser($id_user),
      // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user),
      // 'cart' => $this->ModelBarang->AllCart($id_user),
      // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
    ];
    return view('v_template_user', $data);
  }

  public function RincianPembelian($id_transaksi)
  {
    $id_user = session('id_user');
    $data = [
      'title' => 'Rincian Pembelian',
      'menu' => 'transaksi',
      'submenu' => 'buktitransaksipembelian',
      'page' => 'user/v_rincian_pembelian',
      'user' => $this->ModelUser->Profileuser($id_user),
      'totalcart' => $this->ModelBarang->TotalCart($id_user),
      'detailtransaksi' => $this->ModelBarang->DetailTransaksi($id_transaksi),
      // 'kategori' => $this->ModelKategori->AllData(),
      // 'cart' => $this->ModelBarang->AllCart($id_user),
      // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  public function RincianPenjualan($id_transaksi)
  {
    $id_user = session('id_user');
    $data = [
      'title' => 'Rincian Pembelian',
      'menu' => 'transaksi',
      'submenu' => 'buktitransaksipenjualan',
      'page' => 'user/v_rincian_penjualan',
      'kategori' => $this->ModelKategori->AllData(),
      'user' => $this->ModelUser->Profileuser($id_user),
      'cart' => $this->ModelBarang->AllCart($id_user),
      'totalcart' => $this->ModelBarang->TotalCart($id_user),
      'detailtransaksi' => $this->ModelBarang->DetailTransaksi($id_transaksi),
      // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  public function TambahBarang()
  {
    $id_user = session('id_user');
    $data = [
      'menu' => 'kelolabarang',
      'submenu' => 'tambahbarang',
      'page' => 'user/v_tambahbarang',
      'kategori' => $this->ModelKategori->AllData(),
      // 'cart' => $this->ModelBarang->AllCart($id_user),
      // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
      // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  public function SimpanTambahBarang()
  {
    $id_user = session('id_user');
    // 1.validasi data dulu
    if ($this->validate([
      'nama_barang' => [
        'label'   => 'Nama Barang',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong!'
        ]
      ],
      'harga_barang' => [
        'label'   => 'Harga Barang',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong!',
        ]
      ],
      'id_kategori' => [
        'label'   => 'Kategori',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong!',
        ]
      ],
      'status' => [
        'label'   => 'Status',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong!',
        ]
      ],
      'deskripsi' => [
        'label'   => 'Deskripsi',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong!',
        ]
      ],
      'foto1' => [
        'label' => 'Foto Barang',
        // tidak wajib ganti foto 
        'rules' => 'uploaded[foto1]|max_size[foto1,2048]|mime_in[foto1,image/png,image/jpg,image/gif,image/jpeg]',
        'errors' => [
          'required' => '{field} Wajib diisi tidak boleh kosong!',
          'max_size' => '{field} Max 2Mb.',
          'mime_in' => 'Format {field} Harus JPG, JPEG, PNG,GIF',
        ]
      ]
    ])) {
      // 2. jika valid
      // set/ambil data dari form masuk ke array $data
      $foto = $this->request->getFile('foto1');
      $nama_file = $foto->getRandomName();
      $data = array(
        'id_user' => $id_user,
        'id_kategori' => $this->request->getPost('id_kategori'),
        'nama_barang' => $this->request->getPost('nama_barang'),
        'harga_barang' => $this->request->getPost('harga_barang'),
        'tanggal' => date('Y-m-d'),
        'status' => $this->request->getPost('status'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'foto1' => $nama_file
      );
      // kirim lewat model
      $foto->move('foto/FotoBarang/', $nama_file);
      $this->ModelBarang->AddData($data);
      session()->setFlashdata('pesan', 'Barang berhasil ditambahkan.');
      return redirect()->to(base_url('User/TambahBarang/' . $id_user));
    } else {
      // 3. Jika tidak valid
      session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
      return redirect()->to(base_url('User/TambahBarang/' . $id_user))->withInput('validation', \Config\Services::validation());
    }
  }

  public function UbahBarang($id_barang)
  {
    $id_user = session('id_user');
    $data = [
      'title' => 'Ubah Data Barang',
      'menu' => 'kelolabarang',
      'submenu' => 'lihatbarang',
      'page' => 'user/v_ubah_barang',
      'user' => $this->ModelUser->AllData(),
      'barang' => $this->ModelBarang->DetailBarang($id_barang),
      'kategori' => $this->ModelKategori->AllData(),
      // 'cart' => $this->ModelBarang->AllCart($id_user),
      // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
      // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  public function UbahDataBarang($id_barang)
  {
    $id_user = session('id_user');
    if ($this->validate([
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
          'id_user' => $id_user,
          'id_kategori' => $this->request->getPost('id_kategori'),
          'nama_barang' => $this->request->getPost('nama_barang'),
          'harga_barang' => $this->request->getPost('harga_barang'),
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
          'id_user' => $id_user,
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
      return redirect()->to(base_url('User/LihatBarang/' . $id_user));
      // jika entri tidak valid
    } else {
      session()->setFlashdata('errors', \config\Services::validation()->getErrors());
      return redirect()->to(base_url('User/UbahBarang/' . $id_barang))->withInput('validation', \Config\Services::validation());
    }
  }

  public function DeleteDataBarang($id_barang)
  {
    $id_user = session('id_user');
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
    return redirect()->to(base_url('User/LihatBarang/' . $id_user));
  }

  public function UpdateData($id_user)
  {
    // 2kondisi jika mau ganti gambar / tidak
    // validasi data
    if ($this->validate([
      'nama_user' => [
        'label' => 'Nama Lengkap',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'email' => [
        'label' => 'E-Mail',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!',
        ]
      ],
      'password' => [
        'label' => 'Password',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'tanggal_lahir' => [
        'label' => 'Tangal Lahir',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'jenis_kelamin' => [
        'label' => 'Jenis Kelamin',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'no_hp' => [
        'label' => 'No Handphone',
        'rules' => 'required',
        'errors' => [
          'required' => '{field} Wajib Diisi, tidak boleh kosong!'
        ]
      ],
      'alamat' => [
        'label' => 'Alamat',
        'rules' => 'permit_empty',

      ],
      'foto' => [
        'label' => 'Foto',
        // tidak wajib ganti foto 
        'rules' => 'max_size[foto,2048]|mime_in[foto,image/png,image/jpg,image/gif,image/jpeg]',
        'errors' => [
          'max_size' => '{field} Max 2Mb.',
          'mime_in' => 'Format {field} Harus JPG, JPEG, PNG,GIF',
        ]
      ],
    ])) {
      // jika lolos validasi
      // ambil dlu getfile dari form
      $foto = $this->request->getFile('foto');

      // jika tidak ganti gambar
      if ($foto->getError() == 4) {
        $data = [
          'id_user' => $id_user,
          'nama_user' => $this->request->getPost('nama_user'),
          'email' => $this->request->getPost('email'),
          'password' => $this->request->getPost('password'),
          'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
          'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
          'no_hp' => $this->request->getPost('no_hp'),
          'alamat' => $this->request->getPost('alamat'),
        ];
        $this->ModelUser->UpdateData($data);
      } else {
        // jika ganti gambar
        // hapus foto lama
        $user = $this->ModelUser->DetailData($id_user);
        if ($user['foto_user'] <> '' or $user['foto_user'] <> null) {
          // unlink untuk hapus foto lama gantiyang baru
          unlink('Foto/FotoUser/' . $user['foto_user']);
        }
        // getrandomname untuk penamaan file
        $nama_file = $foto->getRandomName();
        $data = [
          'id_user' => $id_user,
          'nama_user' => $this->request->getPost('nama_user'),
          'email' => $this->request->getPost('email'),
          'password' => $this->request->getPost('password'),
          'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
          'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
          'no_hp' => $this->request->getPost('no_hp'),
          'alamat' => $this->request->getPost('alamat'),
          'foto_user' => $nama_file,
        ];
        // memindahkan file foto kedalam folder foto
        // move'foto'= nama folder
        $foto->move('Foto/FotoUser', $nama_file);
        $this->ModelUser->UpdateData($data);
      }
      session()->setFlashdata('pesan', 'Data berhasil diubah.');
      return redirect()->to(base_url('User/EditProfil/' . $id_user));
    } else {
      // jika tidak lolos validasi
      session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
      // withinput untuk old inputan
      return redirect()->to(base_url('User/EditProfil/' . $id_user));
    }
  }

  public function LihatBarang()
  {
    $id_user = session('id_user');
    $data = [
      'title' => 'Daftar Barang',
      'menu' => 'kelolabarang',
      'submenu' => 'lihatbarang',
      'page' => 'user/v_lihatbarang',
      'barang' => $this->ModelBarang->BarangUser($id_user),
      // 'cart' => $this->ModelBarang->AllCart($id_user),
      // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
      // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  public function FotoBarang()
  {
    $id_user = session('id_user');
    $data = [
      'title' => 'Data Foto Barang',
      'menu' => 'kelolabarang',
      'submenu' => 'fotobarang',
      'page' => 'user/v_foto_barang',
      'barang' => $this->ModelBarang->BarangUser($id_user),
      // 'cart' => $this->ModelBarang->AllCart($id_user),
      // // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
      // // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  public function AddFotoBarang($id_barang)
  {
    $id_user = session('id_user');
    $data = [
      'title' => 'Tambah Foto Barang',
      'menu' => 'kelolabarang',
      'submenu' => 'fotobarang',
      'page' => 'user/v_add_foto_barang',
      'gambar' => $this->ModelGambar->DetailData($id_barang),
      'barang' => $this->ModelBarang->DetailBarang($id_barang),
      // 'cart' => $this->ModelBarang->AllCart($id_user),
      // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
      // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  public function SimpanAlbumBarang($id_barang)
  {
    $id_user = session('id_user');
    // 1.validasi data dulu
    if ($this->validate([
      'id_barang' => [
        'label'   => 'Nama Barang',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong!'
        ]
      ],
      'ket' => [
        'label'   => 'Keterangan',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong!',
        ]
      ],
      'gambar' => [
        'label' => 'Foto Barang',
        // tidak wajib ganti foto 
        'rules' => 'uploaded[gambar]|max_size[gambar,2048]|mime_in[gambar,image/png,image/jpg,image/gif,image/jpeg]',
        'errors' => [
          'required' => '{field} Wajib diisi tidak boleh kosong!',
          'max_size' => '{field} Max 2Mb.',
          'mime_in' => 'Format {field} Harus JPG, JPEG, PNG,GIF',
        ]
      ]
    ])) {
      // 2. jika valid
      // set/ambil data dari form masuk ke array $data
      $foto = $this->request->getFile('gambar');
      $nama_file = $foto->getRandomName();
      $data = array(
        'id_barang' => $this->request->getPost('id_barang'),
        'ket' => $this->request->getPost('ket'),
        'gambar' => $nama_file
      );
      // kirim lewat model
      $foto->move('foto/AlbumBarang/', $nama_file);
      $this->ModelGambar->AddData($data);
      session()->setFlashdata('pesan', 'Foto Barang berhasil ditambahkan.');
      return redirect()->to(base_url('User/AddFotoBarang/' . $id_barang));
    } else {
      // 3. Jika tidak valid
      session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
      return redirect()->to(base_url('User/AddFotoBarang/' . $id_barang))->withInput('validation', \Config\Services::validation());
    }
  }

  public function DeleteAlbumBarang($id_gambar)
  {
    // hapus foto lama
    $gambar = $this->ModelGambar->DetailDataGambar($id_gambar);
    if ($gambar['gambar'] <> '' or $gambar['gambar'] <> null) {
      // unlink untuk hapus foto lama gantiyang baru
      unlink('foto/AlbumBarang/' . $gambar['gambar']);
    }
    $data = [
      'id_gambar' => $id_gambar
    ];
    $this->ModelGambar->DeleteData($data);
    session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
    return redirect()->to(base_url('User/AddFotoBarang/' . $gambar['id_barang']));
  }

  public function TambahCart()
  {
    $id_user = session('id_user');
    $data = [
      'id_penjual' => $this->request->getPost('id_penjual'),
      'tanggal' => date('Y-m-d'),
      'id_pembeli' => $id_user,
      'harga' => $this->request->getPost('harga'),
      'id_barang' => $this->request->getPost('id_barang'),
    ];
    $this->ModelBarang->AddCart($data);
    session()->setFlashdata('pesan', 'Barang Berhasil Ditambahkan Keranjang');
    return redirect()->to(base_url(''));
  }

  public function Cart()
  {
    $id_user = session('id_user');
    $id_pembeli = session('id_user');
    $id_penjual = session('id_barang');
    $data = [
      'title' => 'Keranjang Belanja',
      'menu' => '',
      'submenu' => '',
      'page' => 'user/v_cart',
      'notifikasi' => $this->ModelBarang->AllNotifikasi($id_user),
      'totalnotifikasi' => $this->ModelBarang->TotalNotifikasi($id_user),
      'namapenjual' => $this->ModelBarang->NamaPenjual($id_penjual),
      'cart' => $this->ModelBarang->AllCart($id_pembeli),
      // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
      // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  public function DeleteDataCart($id_cart)
  {
    $id_user = session('id_user');
    $data = [
      'id_cart' => $id_cart
    ];
    $this->ModelBarang->DeleteCart($data);
    session()->setFlashdata('pesan', 'Barang Berhasil Dihapus Dari Keranjang Belanja.');
    return redirect()->to(base_url('User/Cart/' . $id_user));
  }

  public function Penjualan()
  {
    $id_user = session('id_user');
    $id_penjual = session('id_user');
    $data = [
      'title' => 'Penawaran Penjualan',
      'menu' => 'penawaran',
      'submenu' => 'penjualan',
      'page' => 'user/v_penjualan',
      'penjualan' => $this->ModelBarang->DetailPenjualan($id_penjual),
      // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
      // 'cart' => $this->ModelBarang->AllCart($id_user),
      // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  public function Pembelian()
  {
    $id_user = session('id_user');
    $id_pembeli = session('id_user');
    $data = [
      'title' => 'Penawaran Pembelian',
      'menu' => 'penawaran',
      'submenu' => 'pembelian',
      'page' => 'user/v_pembelian',
      'pembelian' => $this->ModelBarang->DetailPembelian($id_pembeli),
      // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
      // 'cart' => $this->ModelBarang->AllCart($id_user),
      // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  public function TransaksiPenjualan()
  {
    $id_user = session('id_user');
    $data = [
      'title' => 'Transaksi Penjualan',
      'menu' => 'transaksi',
      'submenu' => 'buktitransaksipenjualan',
      'page' => 'user/v_transaksi_penjualan',
      'transaksi' => $this->ModelAdmin->DetailTransaksiPenjualan($id_user),
      'buktitransaksi' => $this->ModelAdmin->DetailBuktiTransaksi($id_user),
      // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
      // 'cart' => $this->ModelBarang->AllCart($id_user),
      // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  public function TransaksiPembelian()
  {
    $id_user = session('id_user');
    $data = [
      'title' => 'Transaksi Pembelian',
      'menu' => 'transaksi',
      'submenu' => 'buktitransaksipembelian',
      'page' => 'user/v_transaksi_pembelian',
      'transaksi' => $this->ModelAdmin->DetailTransaksiPembelian($id_user),
      // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
      // 'cart' => $this->ModelBarang->AllCart($id_user),
      // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  public function Pengajuan()
  {
    $id_user = session('id_user');
    $id_pembeli = session('id_user');
    $id_penjual = session('id_barang');
    $data = [
      'id_pembeli' => $id_user,
      'id_penjual' => $this->request->getPost('id_penjual'),
      'id_barang' => $this->request->getPost('id_barang'),
      'id_cart' => $this->request->getPost('id_cart'),
      'tanggal' => date('Y-m-d'),
      'status' => 'proses negosiasi',
      'harga_tawar_pembeli' => $this->request->getPost('harga_tawar_pembeli'),
    ];

    $datacart = [
      'id_cart' => $this->request->getPost('id_cart'),
      'status' => 'terkunci'
    ];
    $this->ModelBarang->EditCart($datacart);

    $databarang = [
      'id_barang' => $this->request->getPost('id_barang'),
      'status' => 'terkunci'
    ];
    $this->ModelBarang->EditData($databarang);

    $datanotifikasi = [
      'tanggal' => date('Y-m-d H:i:s'),
      'id_user' => $this->request->getPost('id_user'),
      'dari' => $this->request->getPost('nama_pembeli'),
      'kepada' => $this->request->getPost('nama_penjual'),
      'aksi' => $this->request->getPost('nama_pembeli') . ' Menawar Harga Barang ' . $this->request->getPost('nama_bp'),

    ];
    $this->ModelBarang->AddNotifikasi($datanotifikasi);

    $this->ModelBarang->AddPengajuan($data);
    session()->setFlashdata('pesan', 'Harga Tawaran Anda Berhasil dikirim! Lanjutkan Kemenu Penawaran Pembelian');
    return redirect()->to(base_url('user/cart/' . session('id_user')));
  }

  public function DeletePengajuanPembelian($id_pengajuan)
  {
    $id_user = session('id_user');
    $data = [
      'id_pengajuan' => $id_pengajuan
    ];
    $this->ModelBarang->DeletePengajuan($data);

    $datacart = [
      'id_cart' => $this->request->getPost('id_cart'),
    ];
    $this->ModelBarang->DeleteCart($datacart);

    $databarang = [
      'id_barang' => $this->request->getPost('id_barang'),
      'status' => 'belum terjual'
    ];
    $this->ModelBarang->EditData($databarang);

    session()->setFlashdata('pesan', 'Pengajuan Barang Berhasil Dibatalkan');
    return redirect()->to(base_url('User/Pembelian/' . $id_user));
  }

  public function DeletePengajuanPenjualan($id_pengajuan)
  {
    $id_user = session('id_user');
    $data = [
      'id_pengajuan' => $id_pengajuan
    ];
    $this->ModelBarang->DeletePengajuan($data);

    $datacart = [
      'id_cart' => $this->request->getPost('id_cart'),
    ];
    $this->ModelBarang->DeleteCart($datacart);

    $databarang = [
      'id_barang' => $this->request->getPost('id_barang'),
      'status' => 'belum terjual'
    ];
    $this->ModelBarang->EditData($databarang);

    session()->setFlashdata('pesan', 'Pengajuan Barang Berhasil Dibatalkan');
    return redirect()->to(base_url('User/Penjualan/' . $id_user));
  }

  public function NegoPembeli($id_pengajuan)
  {
    $id_user = session('id_user');
    $id_pembeli = session('id_user');
    $data = [
      'title' => 'Negosiasi Barang',
      'menu' => 'penawaran',
      'submenu' => 'pembelian',
      'page' => 'user/v_negopembeli',
      'pembelian' => $this->ModelBarang->DetailPembelian($id_pembeli),
      'negopembeli' => $this->ModelBarang->DetailNegoPembelian($id_pengajuan),
      // 'cart' => $this->ModelBarang->AllCart($id_pembeli),
      // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
      // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  public function NegoPenjual($id_pengajuan)
  {
    $id_user = session('id_user');
    $id_pembeli = session('id_user');
    $data = [
      'title' => 'Negosiasi Barang',
      'menu' => 'penawaran',
      'submenu' => 'penjualan',
      'page' => 'user/v_negopenjual',
      'pembelian' => $this->ModelBarang->DetailPembelian($id_pembeli),
      'negopenjual' => $this->ModelBarang->DetailNegoPembelian($id_pengajuan),
      // 'cart' => $this->ModelBarang->AllCart($id_pembeli),
      // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
      // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  public function EditPengajuanPenjual($id_pengajuan)
  {
    $id_user = session('id_user');
    $data = [
      'id_pengajuan' => $id_pengajuan,
      'harga_tawar_penjual' => $this->request->getPost('harga_tawar_penjual')
    ];
    $this->ModelBarang->EditPengajuan($data);

    $datanotifikasi = [
      'tanggal' => date('Y-m-d H:i:s'),
      'id_user' => $this->request->getPost('id_user'),
      'dari' => $this->request->getPost('dari'),
      'kepada' => $this->request->getPost('kepada'),
      'aksi' => $this->request->getPost('dari') . ' Memperbarui Harga Penawaran ' . $this->request->getPost('nama_bp'),
    ];
    $this->ModelBarang->AddNotifikasi($datanotifikasi);

    session()->setFlashdata('pesan', 'Harga Penawaran Berhasil DiPerbarui.');
    return redirect()->to(base_url('User/Penjualan/' . $id_user));
  }

  public function EditPengajuanPembeli($id_pengajuan)
  {
    $id_user = session('id_user');
    $data = [
      'id_pengajuan' => $id_pengajuan,
      'harga_tawar_pembeli' => $this->request->getPost('harga_tawar_pembeli')
    ];
    $this->ModelBarang->EditPengajuan($data);

    $datanotifikasi = [
      'tanggal' => date('Y-m-d H:i:s'),
      'id_user' => $this->request->getPost('id_user'),
      'dari' => $this->request->getPost('dari'),
      'kepada' => $this->request->getPost('kepada'),
      'aksi' => $this->request->getPost('dari') . ' Memperbarui Harga Penawaran ' . $this->request->getPost('nama_bp'),
    ];
    $this->ModelBarang->AddNotifikasi($datanotifikasi);

    session()->setFlashdata('pesan', 'Harga Penawaran Berhasil DiPerbarui.');
    return redirect()->to(base_url('User/Pembelian/' . $id_user));
  }

  public function AddKonfirmPenjual()
  {
    $id_user = session('id_user');
    $id_pembeli = session('id_user');
    $data = [
      'id_pengajuan' => $this->request->getPost('id_pengajuan'),
      'status' => 'Belum Dibayar',
      'harga' => $this->request->getPost('harga'),
    ];
    $this->ModelBarang->AddKonfirmTransaksi($data);

    $datapengajuan = [
      'id_pengajuan' => $this->request->getPost('id_pengajuan'),
      'status' => 'Menunggu Konfirmasi Admin',
    ];
    $this->ModelBarang->EditPengajuan($datapengajuan);

    $datanotifikasi = [
      'tanggal' => date('Y-m-d H:i:s'),
      'id_user' => $this->request->getPost('id_user'),
      'dari' => $this->request->getPost('dari'),
      'kepada' => $this->request->getPost('kepada'),
      'aksi' => $this->request->getPost('dari') . ' Menyetujui Harga Penawaran ' . $this->request->getPost('nama_bp'),
    ];
    $this->ModelBarang->AddNotifikasi($datanotifikasi);

    session()->setFlashdata('pesan', 'Harga Tawaran Akhir Disetujui.');
    return redirect()->to(base_url('User/Penjualan/' .  $id_user));
  }

  public function AddKonfirmPembeli()
  {
    $id_user = session('id_user');
    $id_pembeli = session('id_user');
    $data = [
      'id_pengajuan' => $this->request->getPost('id_pengajuan'),
      'status' => 'Belum Dibayar',
      'harga' => $this->request->getPost('harga'),
    ];
    $this->ModelBarang->AddKonfirmTransaksi($data);

    $datapengajuan = [
      'id_pengajuan' => $this->request->getPost('id_pengajuan'),
      'status' => 'Menunggu Konfirmasi Admin',
    ];
    $this->ModelBarang->EditPengajuan($datapengajuan);

    $datanotifikasi = [
      'tanggal' => date('Y-m-d H:i:s'),
      'id_user' => $this->request->getPost('id_user'),
      'dari' => $this->request->getPost('dari'),
      'kepada' => $this->request->getPost('kepada'),
      'aksi' => $this->request->getPost('dari') . ' Menyetujui Harga Penawaran ' . $this->request->getPost('nama_bp'),
    ];
    $this->ModelBarang->AddNotifikasi($datanotifikasi);

    session()->setFlashdata('pesan', 'Harga Tawaran Akhir Disetujui.');
    return redirect()->to(base_url('User/Pembelian/' .  $id_user));
  }

  public function DeleteTransaksiPembelian($id_transaksi)
  {
    $id_user = session('id_user');
    $data = [
      'id_transaksi' => $id_transaksi
    ];
    $this->ModelAdmin->DeleteTransaksi($data);

    $datapengajuan = [
      'id_pengajuan' => $this->request->getPost('id_pengajuan')
    ];
    $this->ModelBarang->DeletePengajuan($datapengajuan);

    $datacart = [
      'id_cart' => $this->request->getPost('id_cart'),
    ];
    $this->ModelBarang->DeleteCart($datacart);

    $databarang = [
      'id_barang' => $this->request->getPost('id_barang'),
      'status' => 'belum terjual'
    ];
    $this->ModelBarang->EditData($databarang);

    session()->setFlashdata('pesan', 'Pengajuan Barang Berhasil Dibatalkan');
    return redirect()->to(base_url('User/TransaksiPembelian/' . $id_user));
  }

  public function UploadBuktiTransaksi()
  {
    $id_user = session('id_user');
    // 1.validasi data dulu
    if ($this->validate([
      'keterangan' => [
        'label'   => 'Keterangan',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong!'
        ]
      ],
      'foto' => [
        'label' => 'Foto',
        // tidak wajib ganti foto 
        'rules' => 'uploaded[foto]|max_size[foto,2048]|mime_in[foto,image/png,image/jpg,image/gif,image/jpeg]',
        'errors' => [
          'required' => '{field} Wajib diisi tidak boleh kosong!',
          'max_size' => '{field} Max 2Mb.',
          'mime_in' => 'Format {field} Harus JPG, JPEG, PNG,GIF',
        ]
      ]
    ])) {
      // 2. jika valid
      // set/ambil data dari form masuk ke array $data
      $foto = $this->request->getFile('foto');
      $nama_file = $foto->getRandomName();
      $data = array(
        'id_pengajuan' => $this->request->getPost('id_pengajuan'),
        'tanggal' => date('Y-m-d'),
        'keterangan' => $this->request->getPost('keterangan'),
        'validasi' => 'belum',
        'foto' => $nama_file
      );
      // kirim lewat model
      $foto->move('foto/BuktiTransaksi/', $nama_file);
      $this->ModelAdmin->AddBuktiTransaksi($data);

      $datapengajuan = [
        'id_pengajuan' => $this->request->getPost('id_pengajuan'),
        'status' => 'Menunggu Konfirmasi Transaksi Dari Admin'
      ];
      $this->ModelBarang->EditPengajuan($datapengajuan);

      session()->setFlashdata('pesan', 'Bukti Transaksi Berhasil dikirim.');
      return redirect()->to(base_url('User/TransaksiPembelian/' . $id_user));
    } else {
      // 3. Jika tidak valid
      session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
      return redirect()->to(base_url('User/TransaksiPembelian/' . $id_user))->withInput('validation', \Config\Services::validation());
    }
  }

  public function UploadBuktiPengiriman()
  {
    $id_user = session('id_user');
    // 1.validasi data dulu
    if ($this->validate([
      'keterangan' => [
        'label'   => 'Keterangan',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong!'
        ]
      ],
      'foto' => [
        'label' => 'Foto',
        // tidak wajib ganti foto 
        'rules' => 'uploaded[foto]|max_size[foto,2048]|mime_in[foto,image/png,image/jpg,image/gif,image/jpeg]',
        'errors' => [
          'required' => '{field} Wajib diisi tidak boleh kosong!',
          'max_size' => '{field} Max 2Mb.',
          'mime_in' => 'Format {field} Harus JPG, JPEG, PNG,GIF',
        ]
      ]
    ])) {
      // 2. jika valid
      // set/ambil data dari form masuk ke array $data
      $foto = $this->request->getFile('foto');
      $nama_file = $foto->getRandomName();
      $data = array(
        'id_transaksi' => $this->request->getPost('id_transaksi'),
        'id_pengajuan' => $this->request->getPost('id_pengajuan'),
        'tanggal' => date('Y-m-d'),
        'keterangan' => $this->request->getPost('keterangan'),
        'validasi' => 'belum',
        'foto' => $nama_file
      );
      // kirim lewat model
      $foto->move('foto/BuktiPengiriman/', $nama_file);
      $this->ModelAdmin->AddBuktiPengiriman($data);

      $datapengajuan = [
        'id_pengajuan' => $this->request->getPost('id_pengajuan'),
        'status' => 'Menunggu Konfirmasi Pengiriman Dari Admin'
      ];
      $this->ModelBarang->EditPengajuan($datapengajuan);

      session()->setFlashdata('pesan', 'Bukti Pengiriman Berhasil dikirim.');
      return redirect()->to(base_url('User/TransaksiPenjualan/' . $id_user));
    } else {
      // 3. Jika tidak valid
      session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
      return redirect()->to(base_url('User/TransaksiPenjualan/' . $id_user))->withInput('validation', \Config\Services::validation());
    }
  }

  public function BarangDiterima()
  {
    $id_user = session('id_user');

    $datapengajuan = [
      'id_pengajuan' => $this->request->getPost('id_pengajuan'),
      'status' => 'Barang Diterima'
    ];
    $this->ModelBarang->EditPengajuan($datapengajuan);

    $datacart = [
      'id_cart' => $this->request->getPost('id_cart'),
      'status' => 'terjual'
    ];
    $this->ModelBarang->EditCart($datacart);

    $databarang = [
      'id_barang' => $this->request->getPost('id_barang'),
      'status' => 'terjual'
    ];
    $this->ModelBarang->EditData($databarang);

    session()->setFlashdata('pesan', 'Barang Telah Diterima');
    return redirect()->to(base_url('User/TransaksiPembelian/' . $id_user));
  }

  public function RiwayatTransaksi()
  {
    $id_user = session('id_user');
    $data = [
      'title' => 'Riwayat Transaksi',
      'menu' => 'riwayattransaksi',
      'submenu' => '',
      'page' => 'user/v_riwayat_transaksi',
      'riwayattransaksiuser' => $this->ModelBarang->RiwayatTransaksiUser($id_user),
      'transaksi' => $this->ModelAdmin->DetailTransaksiPenjualan($id_user),
      'buktitransaksi' => $this->ModelAdmin->DetailBuktiTransaksi($id_user),
      'totalcart' => $this->ModelBarang->TotalCart($id_user),
      'cart' => $this->ModelBarang->AllCart($id_user),
      'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
      'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
      'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
      'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
    ];
    return view('v_template_user', $data);
  }

  // -----------------Kerangjang Belanja-------------------//

  // insert sc
  // public function TambahKeranjang()
  // {
  //   $cart = \Config\Services::cart();
  //   $cart->insert(array(
  //     'id'            => $this->request->getPost('id'),
  //     'qty'           => 1,
  //     'price'         => $this->request->getPost('price'),
  //     'name'          => $this->request->getPost('name'),
  //     'options'        => array(
  //       'foto1'    => $this->request->getPost('foto1'),
  //     )
  //   ));
  //   session()->setFlashdata('pesan', 'Barang berhasil masuk keranjang.');
  //   return redirect()->to(base_url('home'));
  // }

  // public function Keranjang()
  // {
  //   $data = [
  //     'title' => 'Keranjang Belanja',
  //     'menu' => '',
  //     'submenu' => '',
  //     'cart' => $cart = \Config\Services::cart(),
  //     'page' => 'v_keranjang',
  //   ];
  //   return view('v_template_user', $data);
  // }

  // public function UpdateKerangjang()
  // {
  //   $cart = \Config\Services::cart();
  //   $i = 1;
  //   foreach ($cart->contents() as $key => $value) {
  //     $cart->update(array(
  //       'rowid' => $value['rowid'],
  //       'qty'   => $this->request->getPost('qty' . $i++),
  //     ));
  //   }
  //   session()->setFlashdata('update', 'Data keranjang berhasil diubah');
  //   return redirect()->to(base_url('Home/Keranjang'));
  // }
  // public function DeleteKerangjang($rowid)
  // {
  //   $cart = \Config\Services::cart();
  //   $cart->remove($rowid);
  //   session()->setFlashdata('update', 'Data keranjang berhasil diubah');
  //   return redirect()->to(base_url('Home/Keranjang'));
  // }
}

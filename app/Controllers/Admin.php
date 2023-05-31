<?php

namespace App\Controllers;

use App\Models\ModelUser;
use App\Models\ModelAdmin;
use App\Models\ModelBarang;

class Admin extends BaseController
{

    public function __construct()
    {
        helper('form');
        helper('number');
        $this->ModelUser = new ModelUser();
        $this->ModelAdmin = new ModelAdmin();
        $this->ModelBarang = new ModelBarang();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'menu' => 'dashboardadmin',
            'submenu' => '',
            'page' => 'admin/v_dashboard_admin',
            'totaluser' => $this->ModelAdmin->TotalUser(),
            'totalbarang' => $this->ModelAdmin->TotalBarang(),
            'totalbuktipembayaran' => $this->ModelAdmin->TotalBuktiPembayaran(),
            'totalbuktipengiriman' => $this->ModelAdmin->TotalBuktiPengiriman(),
            'totalkonfirmasitransaksi' => $this->ModelAdmin->TotalKonfirmasiTransaksi()
        ];
        return view('v_template_admin', $data);
    }

    public function KelolaUser()
    {
        $data = [
            'title' => 'Data User',
            'menu' => 'kelolauser',
            'submenu' => '',
            'page' => 'admin/v_kelola_user',
            'user' => $this->ModelUser->AllData(),
            'totalkonfirmasitransaksi' => $this->ModelAdmin->TotalKonfirmasiTransaksi()
        ];
        return view('v_template_admin', $data);
    }

    public function TambahUser()
    {
        $data = [
            'title' => 'Tambah Data User',
            'menu' => 'kelolauser',
            'submenu' => '',
            'page' => 'admin/v_tambah_user',
            'user' => $this->ModelUser->AllData(),
            'totalkonfirmasitransaksi' => $this->ModelAdmin->TotalKonfirmasiTransaksi()
        ];
        return view('v_template_admin', $data);
    }

    public function SimpanDataUser()
    {
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
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi, tidak boleh kosong!'
                ]
            ],
            'rekening' => [
                'label' => 'Nomor Rekening',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi, tidak boleh kosong!'
                ]
            ],
            'foto_user' => [
                'label' => 'Foto',
                // tidak wajib ganti foto 
                'rules' => 'max_size[foto_user,2048]|mime_in[foto_user,image/png,image/jpg,image/gif,image/jpeg]',
                'errors' => [
                    'max_size' => '{field} Max 2Mb.',
                    'mime_in' => 'Format {field} Harus JPG, JPEG, PNG,GIF',
                ]
            ],
        ])) {
            // ambil dlu getfile dari form
            $foto = $this->request->getFile('foto_user');
            // getrandomname untuk penamaan file
            $nama_file = $foto->getRandomName();
            // ambil variabel dari form users
            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'no_hp' => $this->request->getPost('no_hp'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'alamat' => $this->request->getPost('alamat'),
                'rekening' => $this->request->getPost('rekening'),
                'foto_user' => $nama_file,
            ];
            $foto->move('foto/FotoUser', $nama_file);
            $this->ModelAdmin->AddData($data);
            session()->setFlashdata('pesan', 'Data User Berhasil Ditambahkan!');
            return redirect()->to(base_url('Admin/KelolaUser'));
            // jika entri tidak valid
        } else {
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('Admin/TambahUser'))->withInput('validation', \Config\Services::validation());
        }
    }

    public function UbahUser($id_user)
    {
        $data = [
            'title' => 'Ubah Data User',
            'menu' => 'kelolauser',
            'submenu' => '',
            'page' => 'admin/v_ubah_user',
            'user' => $this->ModelUser->DetailData($id_user),
            'totalkonfirmasitransaksi' => $this->ModelAdmin->TotalKonfirmasiTransaksi()
        ];
        return view('v_template_admin', $data);
    }

    public function UbahDataUser($id_user)
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
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi, tidak boleh kosong!'
                ]
            ],
            'rekening' => [
                'label' => 'Nomor Rekening',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi, tidak boleh kosong!'
                ]
            ],
            'foto_user' => [
                'label' => 'Foto',
                // tidak wajib ganti foto 
                'rules' => 'max_size[foto_user,2048]|mime_in[foto_user,image/png,image/jpg,image/gif,image/jpeg]',
                'errors' => [
                    'max_size' => '{field} Max 2Mb.',
                    'mime_in' => 'Format {field} Harus JPG, JPEG, PNG,GIF',
                ]
            ],
        ])) {
            // jika lolos validasi
            // ambil dlu getfile dari form
            $foto = $this->request->getFile('foto_user');

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
                    'rekening' => $this->request->getPost('rekening'),
                ];
                $this->ModelAdmin->UpdateData($data);
            } else {
                // jika ganti gambar
                // hapus foto lama
                $user = $this->ModelAdmin->DetailData($id_user);
                if ($user['foto_user'] == '' or $user['foto_user'] == null) {
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
                $foto->move('Foto/FotoUser/', $nama_file);
                $this->ModelAdmin->UpdateData($data);
            }
            session()->setFlashdata('pesan', 'Data User berhasil diubah.');
            return redirect()->to(base_url('Admin/KelolaUser'));
        } else {
            // jika tidak lolos validasi
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            // withinput untuk old inputan
            return redirect()->to(base_url('Admin/UbahUser/' . $id_user));
        }
    }

    public function DeleteData($id_user)
    {
        // hapus foto lama
        $user = $this->ModelUser->DetailData($id_user);
        if ($user['foto_user'] <> '' or $user['foto_user'] <> null) {
            // unlink untuk hapus foto lama gantiyang baru
            unlink('foto/FotoUser/' . $user['foto_user']);
        }

        $data = [
            'id_user' => $id_user
        ];
        $this->ModelAdmin->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
        return redirect()->to(base_url('Admin/KelolaUser'));
    }

    public function KonfirmasiTransaksi()
    {
        $data = [
            'title' => 'Konfirmasi Transaksi User',
            'menu' => 'kelolatransaksi',
            'submenu' => 'konfirmasitransaksi',
            'page' => 'admin/v_konfirmasi_transaksi',
            'user' => $this->ModelUser->AllData(),
            'konfirmtransaksi' => $this->ModelAdmin->AllKonfirmTransaksi()
        ];
        return view('v_template_admin', $data);
    }

    public function BuktiPembayaran()
    {
        $data = [
            'title' => 'Bukti Transaksi Pembayaran',
            'menu' => 'kelolatransaksi',
            'submenu' => 'buktipembayaran',
            'page' => 'admin/v_bukti_pembayaran',
            'user' => $this->ModelUser->AllData(),
            'buktitransaksi' => $this->ModelAdmin->AllBuktiTransaksi(),
            'totalkonfirmasitransaksi' => $this->ModelAdmin->TotalKonfirmasiTransaksi()
        ];
        return view('v_template_admin', $data);
    }

    public function BuktiPengiriman()
    {
        $data = [
            'title' => 'Bukti Transaksi Pengiriman',
            'menu' => 'kelolatransaksi',
            'submenu' => 'buktipengiriman',
            'page' => 'admin/v_bukti_pengiriman',
            'user' => $this->ModelUser->AllData(),
            'buktipengiriman' => $this->ModelAdmin->AllBuktiPengiriman(),
            'totalkonfirmasitransaksi' => $this->ModelAdmin->TotalKonfirmasiTransaksi()
        ];
        return view('v_template_admin', $data);
    }

    public function AddKonfirmTransaksi($id_konfirm_transaksi)
    {
        $data = [
            'id_pengajuan' => $this->request->getPost('id_pengajuan'),
            'tanggal' => date('Y-m-d'),
            'harga_akhir' => $this->request->getPost('harga_akhir'),
        ];
        $this->ModelAdmin->AddTransaksi($data);

        $datakonfirmtransaksi = [
            'id_konfirm_transaksi' => $id_konfirm_transaksi,
            'status' => 'Menunggu Bukti Pembayaran',
        ];
        $this->ModelBarang->EditKonfirmTransaksi($datakonfirmtransaksi);

        $datapengajuan = [
            'id_pengajuan' => $this->request->getPost('id_pengajuan'),
            'status' => 'Transaksi Disetujui (lanjutkan ke menu transaksi)'
        ];
        $this->ModelBarang->EditPengajuan($datapengajuan);

        session()->setFlashdata('pesan', 'Konfirmasi Transaksi Disetujui.');
        return redirect()->to(base_url('Admin/KonfirmasiTransaksi'));
    }

    public function TerimaBuktiTransaksi($id_bukti_transaksi)
    {
        $data = [
            'id_bukti_transaksi' => $id_bukti_transaksi,
            'validasi' => 'valid'
        ];
        $this->ModelAdmin->EditBuktiTransaksi($data);

        $datapengajuan = [
            'id_pengajuan' =>  $this->request->getPost('id_pengajuan'),
            'status' => 'Bukti Pembayaran Diterima (Menunggu Barang Dikirim Oleh Penjual)'
        ];
        $this->ModelBarang->EditPengajuan($datapengajuan);

        session()->setFlashdata('pesan', 'Bukti Transaksi Diterima');
        return redirect()->to(base_url('Admin/BuktiPembayaran'));
    }

    public function TolakBuktiTransaksi($id_bukti_transaksi)
    {
        // hapus foto lama
        $buktitransaksi = $this->ModelAdmin->DetailBuktiTransaksi($id_bukti_transaksi);
        if ($buktitransaksi['foto'] <> '' or $buktitransaksi['foto'] <> null) {
            // unlink untuk hapus foto lama gantiyang baru
            unlink('foto/BuktiTransaksi/' . $buktitransaksi['foto']);
        }

        $data = [
            'id_bukti_transaksi' => $id_bukti_transaksi
        ];
        $this->ModelAdmin->DeleteBuktiTransaksi($data);

        $datapengajuan = [
            'id_pengajuan' =>  $this->request->getPost('id_pengajuan'),
            'status' => 'Bukti Pembayaran Ditolak (Pastikan Bukti Pembayaran Asli)'
        ];
        $this->ModelBarang->EditPengajuan($datapengajuan);

        session()->setFlashdata('pesan', 'Bukti Transaksi Ditolak');
        return redirect()->to(base_url('Admin/BuktiPembayaran'));
    }

    public function TerimaBuktiPengiriman($id_bukti_pengiriman)
    {
        $data = [
            'id_bukti_pengiriman' => $id_bukti_pengiriman,
            'validasi' => 'valid'
        ];
        $this->ModelAdmin->EditBuktiPengiriman($data);

        $datapengajuan = [
            'id_pengajuan' =>  $this->request->getPost('id_pengajuan'),
            'status' => 'Bukti Pengiriman Diterima (Barang Dikirim Kelokasi Pembeli)'
        ];
        $this->ModelBarang->EditPengajuan($datapengajuan);

        $datariwayattransaksi = [
            'tanggal' => date('Y-m-d'),
            'id_transaksi' => $this->request->getPost('id_transaksi'),
            'id_bukti_transaksi' => $this->request->getPost('id_bukti_transaksi'),
            'id_bukti_pengiriman' => $this->request->getPost('id_bukti_pengiriman'),
            'id_pengajuan' => $this->request->getPost('id_pengajuan'),
            'id_pembeli' => $this->request->getPost('id_pembeli'),
            'id_penjual' => $this->request->getPost('id_penjual'),
            'harga_akhir' => $this->request->getPost('harga_akhir'),
        ];
        $this->ModelAdmin->AddRiwayatTransaksi($datariwayattransaksi);

        session()->setFlashdata('pesan', 'Bukti Transaksi Diterima');
        return redirect()->to(base_url('Admin/BuktiPengiriman'));
    }

    public function TolakBuktiPengiriman($id_bukti_pengiriman)
    {
        // hapus foto lama
        $buktipengiriman = $this->ModelAdmin->DetailBuktiPengiriman($id_bukti_pengiriman);
        if ($buktipengiriman['foto'] <> '' or $buktipengiriman['foto'] <> null) {
            // unlink untuk hapus foto lama gantiyang baru
            unlink('foto/BuktiPengiriman/' . $buktipengiriman['foto']);
        }

        $data = [
            'id_bukti_pengiriman' => $id_bukti_pengiriman
        ];
        $this->ModelAdmin->DeleteBuktiPengiriman($data);

        $datapengajuan = [
            'id_pengajuan' =>  $this->request->getPost('id_pengajuan'),
            'status' => 'Bukti Pengiriman Ditolak (Pastikan Bukti Pengiriman Asli)'
        ];
        $this->ModelBarang->EditPengajuan($datapengajuan);

        session()->setFlashdata('pesan', 'Bukti Pengiriman Ditolak');
        return redirect()->to(base_url('Admin/BuktiPengiriman'));
    }

    public function RiwayatTransaksi()
    {
        $data = [
            'title' => 'Riwayat Transaksi User',
            'menu' => 'riwayattransaksi',
            'submenu' => '',
            'page' => 'admin/v_riwayat_transaksi',
            'totaluser' => $this->ModelAdmin->TotalUser(),
            'riwayattransaksi' => $this->ModelAdmin->AllRiwayatTransaksi(),
            'totalbarang' => $this->ModelAdmin->TotalBarang(),
            'totalbuktipembayaran' => $this->ModelAdmin->TotalBuktiPembayaran(),
            'totalbuktipengiriman' => $this->ModelAdmin->TotalBuktiPengiriman(),
            'totalkonfirmasitransaksi' => $this->ModelAdmin->TotalKonfirmasiTransaksi()
        ];
        return view('v_template_admin', $data);
    }
}

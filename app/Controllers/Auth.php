<?php

namespace App\Controllers;

use App\Models\ModelAuth;

class Auth extends BaseController
{

  public function __construct()
  {
    helper('form');
    $this->ModelAuth = new ModelAuth();
  }

  public function index()
  {
    $data = [
      'page' => 'v_login'
    ];
    return view('v_login', $data);
  }

  public function LoginAdmin()
  {
    $data = [
      'title' => 'Admin',
      'page' => 'v_login_admin',
    ];
    return view('v_login_admin', $data);
  }

  public function Registrasi()
  {
    $data = [
      'page' => 'v_registrasi'
    ];
    return view('v_registrasi', $data);
  }

  public function CekLogin()
  {
    if ($this->validate([
      'email' => [
        'label'   => 'Email',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong.'
        ]
      ],
      'password' => [
        'label'   => 'Password',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong.'
        ]
      ],
    ])) {
      // jika valid
      $email = $this->request->getPost('email');
      $password = $this->request->getPost('password');
      $cek = $this->ModelAuth->Login($email, $password);
      if ($cek) {
        // jika data cocoks
        session()->set('log', true);
        session()->set('level', 'user');
        session()->set('id_user', $cek['id_user']);
        session()->set('nama_user', $cek['nama_user']);
        session()->set('foto_user', $cek['foto_user']);
        session()->set('email', $cek['email']);
        // login
        return redirect()->to(base_url('Home'));
      } else {
        // jika data tidak cocok
        session()->setFlashdata('pesan', 'Username atau password salah.');
        return redirect()->to(base_url('Auth/index'))->withInput('validation', \Config\Services::validation());
      }
    } else {
      // jika tidak valid
      session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
      return redirect()->to(base_url('Auth/index'))->withInput('validation', \Config\Services::validation());
    }
  }

  public function LogOut()
  {
    session()->remove('id_user');
    session()->remove('email');
    session()->remove('nama_user');
    session()->remove('foto_user');
    session()->remove('level');
    return redirect()->to(base_url('Auth'));
  }

  public function CekLoginAdmin()
  {
    if ($this->validate([
      'email' => [
        'label'   => 'Email',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong.'
        ]
      ],
      'password' => [
        'label'   => 'Password',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong.'
        ]
      ],
    ])) {
      // jika valid
      $email = $this->request->getPost('email');
      $password = $this->request->getPost('password');
      $cek = $this->ModelAuth->LoginAdmin($email, $password);
      if ($cek) {
        // jika data cocoks
        session()->set('log', true);
        session()->set('level', 'admin');
        session()->set('id_admin', $cek['id_admin']);
        session()->set('nama_admin', $cek['nama_admin']);
        session()->set('foto', $cek['foto']);
        session()->set('email', $cek['email']);
        // login
        return redirect()->to(base_url('Admin'));
      } else {
        // jika data tidak cocok
        session()->setFlashdata('pesan', 'Username atau password salah.');
        return redirect()->to(base_url('Auth/LoginAdmin'))->withInput('validation', \Config\Services::validation());
      }
    } else {
      // jika tidak valid
      session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
      return redirect()->to(base_url('Auth/LoginAdmin'))->withInput('validation', \Config\Services::validation());
    }
  }

  public function LogOutAdmin()
  {
    session()->remove('id_admin');
    session()->remove('email');
    session()->remove('nama_admin');
    session()->remove('foto');
    session()->remove('level');
    return redirect()->to(base_url('Auth/LoginAdmin'));
  }

  public function SimpanRegistrasi()
  {
    // 1.validasi data dulu
    if ($this->validate([
      'nama_user' => [
        'label'   => 'Nama Lengkap',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong.'
        ]
      ],
      'email' => [
        'label'   => 'E-Mail',
        'rules'   => 'required|is_unique[tb_user.email]',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong.',
          'is_unique' => '{field} Sudah Terdaftar',
        ]
      ],
      'password' => [
        'label'   => 'Password',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong.'
        ]
      ],
      'ulangipassword' => [
        'label'   => 'Ulangi Password',
        'rules'   => 'required|matches[password]',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong.',
          'matches' => '{field} Password tidak sama.'
        ]
      ],
      'tanggal_lahir' => [
        'label'   => 'Tanggal Lahir',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong.',
        ]
      ],
      'jenis_kelamin' => [
        'label'   => 'Jenis Kelamin',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong.',
        ]
      ],
      'no_hp' => [
        'label'   => 'No Handphone',
        'rules'   => 'required',
        'errors'  => [
          'required' => '{field} Wajib diisi tidak boleh kosong.',
        ]
      ],
    ])) {
      // 2. jika valid
      // set/ambil data dari form masuk ke array $data
      $data = array(
        'nama_user' => $this->request->getPost('nama_user'),
        'email' => $this->request->getPost('email'),
        'password' => $this->request->getPost('password'),
        'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
        'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        'no_hp' => $this->request->getPost('no_hp'),
      );
      // kirim lewat model
      $this->ModelAuth->Registrasi($data);
      session()->setFlashdata('pesan', 'Registrasi berhasil');
      return redirect()->to(base_url('auth/registrasi'));
    } else {
      // 3. Jika tidak valid
      session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
      return redirect()->to(base_url('auth/registrasi'))->withInput('validation', \Config\Services::validation());
    }
  }
}

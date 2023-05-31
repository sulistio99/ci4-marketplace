<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterAdmin implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // Do something here
    if (session()->get('level') == "") {
      session()->setFlashdata('pesan', 'Anda belum login, Login dulu lah.');
      return redirect()->to(base_url('Auth'));
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
    if (session()->get('level') == "admin") {
      return redirect()->to(base_url('Admin'));
    }
  }
}

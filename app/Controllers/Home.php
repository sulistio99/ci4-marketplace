<?php

namespace App\Controllers;

use CodeIgniter\Database\RawSql;
use Config\Pager;
use App\Models\Modeluser;
use App\Models\ModelBarang;
use App\Models\ModelKategori;

class Home extends BaseController
{

    public function __construct()
    {
        helper('number');
        helper('form');
        $this->ModelUser = new Modeluser();
        $this->ModelBarang = new ModelBarang();
        $this->ModelKategori = new ModelKategori();
        $pager =  \Config\Services::Pager();
    }

    public function index()
    {
        $id_user = session('id_user');

        $keywoard = $this->request->getPost('keywoard');
        if ($keywoard) {
            $b =  $this->ModelBarang->get_keywoard($keywoard);
            if (!$b) {
                $data2 = [
                    'menu' => '',
                    'submenu' => '',
                    'page' => 'v_kosong',
                    'barang' => $this->ModelBarang->AllData(),
                    'b' => $this->ModelBarang->paginate(12, 'b'),
                    'pager' => $this->ModelBarang->pager,
                    // 'barangp' => $this->ModelBarang->paginate(12, 'barangp'),
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
                return view('v_template', $data2);
            }
        } else {
            $b =  $this->ModelBarang->AllData();
            $data1 = [
                'menu' => '',
                'submenu' => '',
                'page' => 'v_home',
                'barang' => $this->ModelBarang->AllData(),
                'b' => $this->ModelBarang->paginate(12, 'b'),
                // 'barangp' => $this->ModelBarang->paginate(12, 'barangp'),
                'pager' => $this->ModelBarang->pager,
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
            return view('v_template', $data1);
        }

        $data = [
            'menu' => '',
            'submenu' => '',
            'page' => 'v_home',
            'barang' => $this->ModelBarang->AllData(),
            'b' => $b,
            'barangp' => $this->ModelBarang->paginate(12, 'barangp'),
            'pager' => $this->ModelBarang->pager,
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
        return view('v_template', $data);
    }

    public function Kategori($id_kategori)
    {
        $keywoard = $this->request->getPost('keywoard');
        if ($keywoard) {
            $b =  $this->ModelBarang->get_keywoard3($keywoard, $id_kategori);
            if (!$b) {
                $data2 = [
                    'title' => 'KATEGORI',
                    'menu' => '',
                    'submenu' => '',
                    'page' => 'v_halaman_kategori',
                    'kategori' => $this->ModelKategori->AllData(),
                    'judulkategori' => $this->ModelKategori->JudulKategori($id_kategori),
                    'barang' => $this->ModelKategori->HalamanKategori($id_kategori),
                    'b' => $b,
                    'barangp' => $this->ModelBarang->paginate(12, 'barangp'),
                    'pager' => $this->ModelBarang->pager,
                ];
                return view('v_template', $data2);
            }
        } else {
            $b =  $this->ModelKategori->HalamanKategori($id_kategori);
            $data1 = [
                'title' => 'KATEGORI',
                'menu' => '',
                'submenu' => '',
                'page' => 'v_halaman_kategori',
                'kategori' => $this->ModelKategori->AllData(),
                'judulkategori' => $this->ModelKategori->JudulKategori($id_kategori),
                'barang' => $this->ModelKategori->HalamanKategori($id_kategori),
                'b' => $b,
                'barangp' => $this->ModelBarang->paginate(12, 'barangp'),
                'pager' => $this->ModelBarang->pager,
            ];
            return view('v_template', $data1);
        }
        $data = [
            'title' => 'KATEGORI',
            'menu' => '',
            'submenu' => '',
            'page' => 'v_halaman_kategori',
            'kategori' => $this->ModelKategori->AllData(),
            'judulkategori' => $this->ModelKategori->JudulKategori($id_kategori),
            'barang' => $this->ModelKategori->HalamanKategori($id_kategori),
            'b' => $b,
            'barangp' => $this->ModelBarang->paginate(12, 'barangp'),
            'pager' => $this->ModelBarang->pager,
            // 'cart' => $this->ModelBarang->AllCart($id_user),
            // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
            // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
            // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
            // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
            // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
        ];
        return view('v_template', $data);
    }

    public function Bantuan()
    {
        $id_user = session('id_user');
        $data = [
            'title' => 'KATEGORI',
            'menu' => '',
            'submenu' => '',
            'page' => 'v_bantuan',
            // 'cart' => $this->ModelBarang->AllCart($id_user),
            // 'totalcart' => $this->ModelBarang->TotalCart($id_user),
            // 'totaltransaksipembelian' => $this->ModelBarang->TotalTransaksiPembelian($id_user),
            // 'totaltransaksipenjualan' => $this->ModelBarang->TotalTransaksiPenjualan($id_user),
            // 'totalpenawaranpembelian' => $this->ModelBarang->TotalPengajuanPembeli($id_user),
            // 'totalpenawaranpenjualan' => $this->ModelBarang->TotalPengajuanPenjual($id_user)
        ];
        return view('v_template_user', $data);
    }

    public function DetailToko($id_user)
    {
        $keywoard = $this->request->getPost('keywoard');
        // $detailidtoko = $this->request->getPost('id_user');
        if ($keywoard) {
            $b =  $this->ModelBarang->get_keywoard2($keywoard, $id_user);
            if (!$b) {
                $data2 = [
                    'menu' => '',
                    'submenu' => '',
                    'page' => 'toko/v_index',
                    'user' => $this->ModelUser->Profileuser($id_user),
                    'barang' => $this->ModelBarang->BarangUser($id_user),
                    'totalbarang' => $this->ModelBarang->TotalBarangUser($id_user),
                    'b' => $b,
                    'barangp' => $this->ModelBarang->paginate(12, 'barangp'),
                    'pager' => $this->ModelBarang->pager,
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
                return view('v_template_user', $data2);
            }
        } else {
            $b =  $this->ModelBarang->BarangUser($id_user);
            $data1 = [
                'menu' => '',
                'submenu' => '',
                'page' => 'toko/v_index',
                'user' => $this->ModelUser->Profileuser($id_user),
                'barang' => $this->ModelBarang->BarangUser($id_user),
                'totalbarang' => $this->ModelBarang->TotalBarangUser($id_user),
                'b' => $b,
                'barangp' => $this->ModelBarang->paginate(12, 'barangp'),
                'pager' => $this->ModelBarang->pager,
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
            return view('v_template_user', $data1);
        }

        $data = [
            'title' => 'Detail Store',
            'menu' => '',
            'submenu' => '',
            'page' => 'toko/v_index',
            'totalbarang' => $this->ModelBarang->TotalBarangUser($id_user),
            'user' => $this->ModelUser->Profileuser($id_user),
            'barang' => $this->ModelBarang->BarangUser($id_user),
            'b' => $b,
            'barangp' => $this->ModelBarang->paginate(12, 'barangp'),
            'pager' => $this->ModelBarang->pager,
        ];
        return view('v_template_user', $data);
    }
}

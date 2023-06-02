<?php

namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;
use PhpParser\Node\Expr\FuncCall;

class ModelBarang extends Model
{
  protected $table = 'tb_barang';
  public function AllData()
  {
    return $this->db->table('tb_barang')
      ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
      ->join('tb_kategori', 'tb_kategori.id_kategori=tb_barang.id_kategori')
      ->orderBy('id_barang', 'DESC')
      ->get()->getResultArray();
  }

  public function DetailBarang($id_barang)
  {
    return $this->db->table('tb_barang')
      ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
      ->join('tb_kategori', 'tb_kategori.id_kategori=tb_barang.id_kategori')
      ->where('id_barang', $id_barang)
      ->get()->getRowArray();
  }

  public function AddData($data)
  {
    $this->db->table('tb_barang')->insert($data);
  }

  public function EditData($data)
  {
    $this->db->table('tb_barang')
      ->where('id_barang', $data['id_barang'])
      ->update($data);
  }

  public function DeleteData($data)
  {
    $this->db->table('tb_barang')
      ->where('id_barang', $data['id_barang'])
      ->delete($data);
  }

  public function BarangUser($id_user)
  {
    return $this->db->table('tb_barang')
      ->join('tb_kategori', 'tb_kategori.id_kategori=tb_barang.id_kategori')
      ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
      ->where('tb_barang.id_user', $id_user)
      ->orderBy('id_barang', 'desc')
      ->get()->getResultArray();
  }

  public function AddNotifikasi($data)
  {
    $this->db->table('tb_notifikasi')
      ->insert($data);
  }

  public function AllCart($id_pembeli)
  {
    return $this->db->table('tb_cart')
      ->join('tb_barang', 'tb_barang.id_barang=tb_cart.id_barang')
      ->where('id_pembeli', $id_pembeli)
      ->where('tb_cart.status', 'belum terjual')
      ->get()->getResultArray();
  }

  public function AllNotifikasi($id_user)
  {
    return $this->db->table('tb_notifikasi')
      ->where('id_user', $id_user)
      ->orderBy('id_notifikasi', 'desc')
      ->get()->getResultArray();
  }

  public function NamaPenjual($id_penjual)
  {
    return $this->db->table('tb_cart')
      ->join('tb_user', 'tb_user.id_user=tb_cart.id_pembeli')
      ->where('id_barang', $id_penjual)
      ->get()->getRowArray();
  }

  public function TotalCart($id_user)
  {
    return $this->db->table('tb_cart')
      ->where('id_pembeli', $id_user)
      ->where('status', 'belum terjual')
      ->countAllResults();
  }

  public function TotalNotifikasi($id_user)
  {
    $this->db->table('tb_notifikasi')
      ->where('id_user', $id_user)
      ->countAllResults();
  }

  public function TotalBarangUser($id_user)
  {
    return $this->db->table('tb_barang')
      ->where('tb_barang.id_user', $id_user)
      ->countAllResults();
  }

  public function TotalTransaksiPembelian($id_user)
  {
    return $this->db->table('tb_transaksi')
      ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=tb_transaksi.id_pengajuan')
      ->where('tb_pengajuan.id_pembeli', $id_user)
      ->countAllResults();
  }

  public function TotalTransaksiPenjualan($id_user)
  {
    return $this->db->table('tb_transaksi')
      ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=tb_transaksi.id_pengajuan')
      ->where('tb_pengajuan.id_penjual', $id_user)
      ->countAllResults();
  }

  public function TotalPengajuanPembeli($id_user)
  {
    return $this->db->table('tb_pengajuan')
      ->where('tb_pengajuan.id_pembeli', $id_user)
      ->countAllResults();
  }

  public function TotalPengajuanPenjual($id_user)
  {
    return $this->db->table('tb_pengajuan')
      ->where('tb_pengajuan.id_penjual', $id_user)
      ->countAllResults();
  }

  public function TotalRiwayatTransaksi($id_user)
  {
    return $this->db->table('tb_riwayat_transaksi')
      ->where('tb_riwayat_transaksi.id_penjual', $id_user)
      ->orWhere('tb_riwayat_transaksi.id_pembeli', $id_user)
      ->countAllResults();
  }

  public function AddCart($data)
  {
    $this->db->table('tb_cart')
      ->insert($data);
  }

  public function DeleteCart($data)
  {
    $this->db->table('tb_cart')
      ->where('id_cart', $data['id_cart'])
      ->delete($data);
  }

  public function EditCart($data)
  {
    $this->db->table('tb_cart')
      ->where('id_cart', $data['id_cart'])
      ->update($data);
  }

  public function AddPengajuan($data)
  {
    $this->db->table('tb_pengajuan')
      ->insert($data);
  }

  public function DetailPembelian($id_pembeli)
  {
    return $this->db->table('tb_pengajuan')
      ->join('tb_user', 'tb_user.id_user=tb_pengajuan.id_pembeli')
      ->join('tb_barang', 'tb_barang.id_barang=tb_pengajuan.id_barang')
      ->where('id_pembeli', $id_pembeli)
      ->get()->getResultArray();
  }

  public function DetailTransaksi($id_transaksi)
  {
    return $this->db->table('tb_transaksi')
      ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=tb_transaksi.id_pengajuan')
      ->join('tb_barang', 'tb_barang.id_barang=tb_pengajuan.id_barang')
      ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
      ->join('tb_kategori', 'tb_kategori.id_kategori=tb_barang.id_kategori')
      ->where('id_transaksi', $id_transaksi)
      ->get()->getRowArray();
  }

  public function DeletePengajuan($data)
  {
    $this->db->table('tb_pengajuan')
      ->where('id_pengajuan', $data)
      ->delete($data);
  }

  public function EditPengajuan($data)
  {
    $this->db->table('tb_pengajuan')
      ->where('id_pengajuan', $data['id_pengajuan'])
      ->update($data);
  }

  public function DetailPenjualan($id_penjual)
  {
    return $this->db->table('tb_pengajuan')
      ->join('tb_barang', 'tb_barang.id_barang=tb_pengajuan.id_barang')
      ->where('id_penjual', $id_penjual)
      ->get()->getResultArray();
  }

  public function DetailNegoPembelian($id_pengajuan)
  {
    return $this->db->table('tb_pengajuan')
      ->join('tb_barang', 'tb_barang.id_barang=tb_pengajuan.id_barang')
      ->where('id_pengajuan', $id_pengajuan)
      ->get()->getRowArray();
  }

  public function AddKonfirmTransaksi($data)
  {
    $this->db->table('tb_konfirm_transaksi')
      ->insert($data);
  }

  public function EditKonfirmTransaksi($data)
  {
    $this->db->table('tb_konfirm_transaksi')
      ->where('id_konfirm_transaksi', $data['id_konfirm_transaksi'])
      ->update($data);
  }

  public function RiwayatTransaksiUser($id_user)
  {
    return $this->db->table('tb_riwayat_transaksi')
      ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=tb_riwayat_transaksi.id_pengajuan')
      // ->join('tb_riwayat_transaksi', 'tb_riwayat_transaksi.id_pengajuan=tb_pengajuan.id_pengajuan')
      ->join('tb_transaksi', 'tb_transaksi.id_transaksi=tb_riwayat_transaksi.id_transaksi')
      ->join('tb_bukti_transaksi', 'tb_bukti_transaksi.id_bukti_transaksi=tb_riwayat_transaksi.id_bukti_transaksi')
      ->join('tb_bukti_pengiriman', 'tb_bukti_pengiriman.id_bukti_pengiriman=tb_riwayat_transaksi.id_bukti_pengiriman')
      ->join('tb_barang', 'tb_barang.id_barang=tb_pengajuan.id_barang')
      ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
      ->where('tb_pengajuan.id_pembeli',  $id_user)
      ->orWhere('tb_pengajuan.id_penjual',  $id_user)
      ->get()->getResultArray();
  }

  public function get_keywoard($keywoard)
  {
    return $this->db->table('tb_barang')
      ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
      ->join('tb_kategori', 'tb_kategori.id_kategori=tb_barang.id_kategori')
      ->like('nama_barang', $keywoard)
      ->orlike('tb_user.nama_user', $keywoard)
      ->orLike('harga_barang', $keywoard)
      ->orLike('tanggal', $keywoard)
      ->orLike('status', $keywoard)
      ->orLike('deskripsi', $keywoard)
      ->get()->getResultArray();
  }

  public function get_keywoard2($keywoard, $id_user)
  {
    // $subQuery = $this->db->table('tb_barang')->select('nama_barang')->where('id_user', $detailidtoko);
    return $this->db->table('tb_barang')
      ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
      ->join('tb_kategori', 'tb_kategori.id_kategori=tb_barang.id_kategori')
      ->like('nama_barang', $keywoard)
      ->where('tb_barang.id_user', $id_user)
      ->orLike('harga_barang', $keywoard)
      ->where('tb_barang.id_user', $id_user)
      ->get()->getResultArray();
  }

  public function get_keywoard3($keywoard, $id_kategori)
  {
    // $subQuery = $this->db->table('tb_barang')->select('nama_barang')->where('id_user', $detailidtoko);
    return $this->db->table('tb_barang')
      ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
      ->join('tb_kategori', 'tb_kategori.id_kategori=tb_barang.id_kategori')
      ->like('nama_barang', $keywoard)
      ->where('tb_kategori.id_kategori', $id_kategori)
      ->orLike('harga_barang', $keywoard)
      ->where('tb_kategori.id_kategori', $id_kategori)
      ->get()->getResultArray();
  }
}

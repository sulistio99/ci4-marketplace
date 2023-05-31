<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Node\Expr\FuncCall;

class ModelAdmin extends Model
{
  public function DetailData($id_user)
  {
    return $this->db->table('tb_user')
      ->where('id_user', $id_user)
      ->get()->getRowArray();
  }

  public function AddData($data)
  {
    $this->db->table('tb_user')
      ->insert($data);
  }

  public function UpdateData($data)
  {
    $this->db->table('tb_user')
      ->where('id_user', $data['id_user'])
      ->update($data);
  }

  public function DeleteData($data)
  {
    $this->db->table('tb_user')
      ->where('id_user', $data['id_user'])
      ->delete($data);
  }

  public function TotalUser()
  {
    return $this->db->table('tb_user')
      ->countAll();
  }

  public function TotalBarang()
  {
    return $this->db->table('tb_barang')
      ->countAll();
  }

  public function TotalBuktiPembayaran()
  {
    return $this->db->table('tb_bukti_transaksi')
      ->countAll();
  }

  public function TotalBuktiPengiriman()
  {
    return $this->db->table('tb_bukti_pengiriman')
      ->countAll();
  }

  public function TotalKonfirmasiTransaksi()
  {
    return $this->db->table('tb_konfirm_transaksi')
      ->countAll();
  }

  public function AllKonfirmTransaksi()
  {
    return $this->db->table('tb_konfirm_transaksi')
      ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=tb_konfirm_transaksi.id_pengajuan')
      ->join('tb_barang', 'tb_barang.id_barang=tb_pengajuan.id_barang')
      ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
      ->get()->getResultArray();
  }

  public function AllBuktiTransaksi()
  {
    return $this->db->table('tb_bukti_transaksi')
      ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=tb_bukti_transaksi.id_pengajuan')
      ->join('tb_barang', 'tb_barang.id_barang=tb_pengajuan.id_barang')
      ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
      ->get()->getResultArray();
  }

  public function AllBuktiPengiriman()
  {
    return $this->db->table('tb_bukti_pengiriman')
      ->join('tb_transaksi', 'tb_transaksi.id_transaksi=tb_bukti_pengiriman.id_transaksi')
      ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=tb_bukti_pengiriman.id_pengajuan')
      ->join('tb_barang', 'tb_barang.id_barang=tb_pengajuan.id_barang')
      ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
      ->get()->getResultArray();
  }

  public function DeleteKonfirmTransaksi($data)
  {
    $this->db->table('tb_konfirm_transaksi')
      ->where('id_konfirm_transaksi', $data['id_konfirm_transaksi'])
      ->delete($data);
  }

  public function DeleteTransaksi($data)
  {
    $this->db->table('tb_transaksi')
      ->where('id_transaksi', $data['id_transaksi'])
      ->delete($data);
  }

  public function DetailTransaksiPembelian($id_user)
  {
    return $this->db->table('tb_transaksi')
      ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=.tb_transaksi.id_pengajuan')
      ->join('tb_cart', 'tb_cart.id_cart=tb_pengajuan.id_cart')
      ->join('tb_barang', 'tb_barang.id_barang=tb_pengajuan.id_barang')
      ->where('tb_pengajuan.id_pembeli', $id_user)
      ->get()->getResultArray();
  }

  public function DetailTransaksiPenjualan($id_user)
  {
    return $this->db->table('tb_transaksi')
      ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=.tb_transaksi.id_pengajuan')
      ->join('tb_cart', 'tb_cart.id_cart=tb_pengajuan.id_cart')
      ->join('tb_barang', 'tb_barang.id_barang=tb_pengajuan.id_barang')
      ->where('tb_pengajuan.id_penjual', $id_user)
      ->get()->getResultArray();
  }

  public function AddTransaksi($data)
  {
    $this->db->table('tb_transaksi')
      ->insert($data);
  }

  public function AddBuktiTransaksi($data)
  {
    $this->db->table('tb_bukti_transaksi')
      ->insert($data);
  }

  public function DeleteBuktiTransaksi($id_bukti_transaksi)
  {
    $this->db->table('tb_bukti_transaksi')
      ->where('id_bukti_transaksi', $id_bukti_transaksi)
      ->delete($id_bukti_transaksi);
  }

  public function AddBuktiPengiriman($data)
  {
    $this->db->table('tb_bukti_pengiriman')
      ->insert($data);
  }

  public function DetailBuktiPengiriman($id_bukti_pengiriman)
  {
    return $this->db->table('tb_bukti_pengiriman')
      ->where('id_bukti_pengiriman', $id_bukti_pengiriman)
      ->get()->getRowArray();
  }

  public function DeleteBuktiPengiriman($id_bukti_pengiriman)
  {
    $this->db->table('tb_bukti_pengiriman')
      ->where('id_bukti_pengiriman', $id_bukti_pengiriman)
      ->delete($id_bukti_pengiriman);
  }

  public function EditBuktiTransaksi($data)
  {
    $this->db->table('tb_bukti_transaksi')
      ->where('id_bukti_transaksi', $data['id_bukti_transaksi'])
      ->update($data);
  }

  public function EditBuktiPengiriman($data)
  {
    $this->db->table('tb_bukti_pengiriman')
      ->where('id_bukti_pengiriman', $data['id_bukti_pengiriman'])
      ->update($data);
  }

  public function DetailBuktiTransaksi($id_bukti_transaksi)
  {
    return $this->db->table('tb_bukti_transaksi')
      ->where('id_bukti_transaksi', $id_bukti_transaksi)
      ->get()->getRowArray();
  }

  public function AddRiwayatTransaksi($data)
  {
    $this->db->table('tb_riwayat_transaksi')
      ->insert($data);
  }

  public function AllRiwayatTransaksi()
  {
    return $this->db->table('tb_riwayat_transaksi')
      ->join('tb_transaksi', 'tb_transaksi.id_transaksi=tb_riwayat_transaksi.id_transaksi')
      ->join('tb_bukti_transaksi', 'tb_bukti_transaksi.id_bukti_transaksi=tb_riwayat_transaksi.id_bukti_transaksi')
      ->join('tb_bukti_pengiriman', 'tb_bukti_pengiriman.id_bukti_pengiriman=tb_riwayat_transaksi.id_bukti_pengiriman')
      ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=tb_riwayat_transaksi.id_pengajuan')
      ->join('tb_barang', 'tb_barang.id_barang=tb_pengajuan.id_barang')
      ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
      ->get()->getResultArray();
  }
}

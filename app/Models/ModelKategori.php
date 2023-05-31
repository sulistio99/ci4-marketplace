<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Node\Expr\FuncCall;

class ModelKategori extends Model
{
  public function AllData()
  {
    return $this->db->table('tb_kategori')
      ->get()->getResultArray();
  }

  public function AddData($data)
  {
    $this->db->table('tb_kategori')->insert($data);
  }

  public function DetailData($id_kategori)
  {
    return $this->db->table('tb_kategori')
      ->where('id_kategori', $id_kategori)
      ->get()->getRowArray();
  }

  public function EditData($data)
  {
    $this->db->table('tb_kategori')
      ->where('id_kategori', $data['id_kategori'])
      ->update($data);
  }

  public function DeleteData($data)
  {
    $this->db->table('tb_kategori')
      ->where('id_kategori', $data['id_kategori'])
      ->delete($data);
  }

  public function HalamanKategori($id_kategori)
  {
    return $this->db->table('tb_barang')
      ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
      ->where('id_kategori', $id_kategori)
      ->get()->getResultArray();
  }

  public function JudulKategori($id_kategori)
  {
    return $this->db->table('tb_kategori')
      ->where('id_kategori', $id_kategori)
      ->get()->getRowArray();
  }
}

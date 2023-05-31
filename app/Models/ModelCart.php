<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Node\Expr\FuncCall;

class ModelCart extends Model
{
  public function AllData()
  {
    return $this->db->table('tb_cart')
      ->get()->getResultArray();
  }

  public function AddData($data)
  {
    $this->db->table('tb_cart')->insert($data);
  }

  public function DetailData($id_cart)
  {
    return $this->db->table('tb_cart')
      ->where('id_cart', $id_cart)
      ->get()->getRowArray();
  }

  public function EditData($data)
  {
    $this->db->table('tb_cart')
      ->where('id_cart', $data['id_cart'])
      ->update($data);
  }

  public function DeleteData($data)
  {
    $this->db->table('tb_cart')
      ->where('id_cart', $data['id_cart'])
      ->delete($data);
  }

  public function Halamancart($id_cart)
  {
    return $this->db->table('tb_barang')
      ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
      ->where('id_cart', $id_cart)
      ->get()->getResultArray();
  }

  public function Judulcart($id_cart)
  {
    return $this->db->table('tb_cart')
      ->where('id_cart', $id_cart)
      ->get()->getRowArray();
  }
}

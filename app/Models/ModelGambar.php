<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Node\Expr\FuncCall;

class ModelGambar extends Model
{
  public function DetailData($id_barang)
  {
    return $this->db->table('tb_gambar')
      ->where('id_barang', $id_barang)
      ->get()->getResultArray();
  }

  public function DetailDataGambar($id_gambar)
  {
    return $this->db->table('tb_gambar')
      ->where('id_gambar', $id_gambar)
      ->get()->getRowArray();
  }

  public function AddData($data)
  {
    $this->db->table('tb_gambar')
      ->insert($data);
  }

  public function DeleteData($data)
  {
    $this->db->table('tb_gambar')
      ->where('id_gambar', $data['id_gambar'])
      ->delete($data);
  }
}

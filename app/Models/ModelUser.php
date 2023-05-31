<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Node\Expr\FuncCall;

class ModelUser extends Model
{

  public function AllData()
  {
    return $this->db->table('tb_user')
      ->orderBy('id_user', 'DESC')
      ->get()->getResultArray();
  }

  public function DetailData($id_anggota)
  {
    return $this->db->table('tb_user')
      ->where('id_user', $id_anggota)
      ->get()->getRowArray();
  }

  public function Profileuser($id_user)
  {
    return $this->db->table('tb_user')
      ->where('id_user', $id_user)
      ->get()->getRowArray();
  }

  public function UpdateData($data)
  {
    $this->db->table('tb_user')
      ->where('id_user', $data['id_user'])
      ->update($data);
  }
}

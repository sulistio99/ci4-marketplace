<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title"><b><?= $title; ?></b></h5>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <!-- notifikasi-->
      <?php
      if (session()->getFlashdata('pesan')) {
        echo '<div class="alert alert-success alert-dismissible">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo '<h5><i class="icon fas fa-check"></i> ';
        echo session()->getFlashdata('pesan');
        echo '</h5> </div>';
      }
      ?>
      <table id="example2" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Cover</th>
            <th>Jumlah Foto</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($barang as $key => $value) { ?>
            <?php
            $db = \Config\Database::connect();
            $totalfotobarang = $db->table('tb_gambar')
              ->where('id_barang', $value['id_barang'])
              ->countAllResults();

            ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['nama_barang']; ?></td>
              <td><img src="<?= base_url('foto/FotoBarang/' . $value['foto1']); ?>" width="100px"></td>
              <td><?= $totalfotobarang; ?></td>
              <td class="text-center"><a href="<?= base_url('User/AddFotoBarang/' . $value['id_barang']); ?>" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Foto</a></td>
            </tr>
          <?php  } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
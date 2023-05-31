<div class="col-md-12">
  <div class="card">
    <div class="card-header p-2 text-center">
      <h1><i class="fas fa-shopping-cart"></i> <?= $title; ?>.</h1>
    </div><!-- /.card-header -->
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
      <?php
      $no = 1;
      foreach ($cart as $key => $value) { ?>
        <div class="row">
          <div class="col-12 table-responsive">
            <?php echo form_open('User/Pengajuan/' . session('id_user')) ?>
            <table id="" class="table table-bordered">
              <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>Foto Barang</th>
                  <th>Nama Barang</th>
                  <th>Nama Penjual</th>
                  <th>Harga</th>
                  <th width="180px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $db = \Config\Database::connect();
                $nama_penjual = $db->table('tb_barang')
                  ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
                  ->where('id_barang', $value['id_barang'])
                  ->get()->getRowArray();

                $nama_pembeli = $db->table('tb_user')
                  ->where('id_user', session('id_user'))
                  ->get()->getRowArray();
                ?>
                <tr>
                  <input type="hidden" name="id_user" value="<?= $value['id_user']; ?>">
                  <input type="hidden" name="nama_penjual" value="<?= $nama_penjual['nama_user']; ?>">
                  <input type="hidden" name="nama_pembeli" value="<?= $nama_pembeli['nama_user']; ?>">
                  <input type="hidden" name="id_penjual" value="<?= $value['id_user']; ?>">
                  <input type="hidden" name="id_barang" value="<?= $value['id_barang']; ?>">
                  <input type="hidden" name="nama_bp" value="<?= $value['nama_barang']; ?>">
                  <input type="hidden" name="total" value="<?= $value['harga_barang']; ?>">
                  <input type="hidden" name="id_cart" value="<?= $value['id_cart']; ?>">

                  <td><?= $no++; ?></td>
                  <td class="text-center"><img src="<?= base_url('foto/FotoBarang/' . $value['foto1']); ?>" width="150px"></td>
                  <td><?= $value['nama_barang']; ?></td>
                  <td><?= $nama_penjual['nama_user']; ?></td>
                  <td><?= number_to_currency($value['harga_barang'], 'Rp.') ?></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete<?= $value['id_cart'] ?>">
                      <i class="fas fa-trash"></i> Hapus
                    </button>
                  </td>
                </tr>
                <tr>
                  <td colspan="6">
                    <div class="form-group row">
                      <div class="col-2">
                        <label for="" class="form-control">Penawaran : Rp.</label>
                      </div>
                      <div class="col-10">
                        <input type="text" class="form-control" placeholder="Masukkan Harga Penawaran Anda" name="harga_tawar_pembeli" required>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="6">
                    <button type="submit" class="btn btn-success btn-sm" style="width: 100%;">Mulai Penawaran</button>
                  </td>
                </tr>
              </tbody>
            </table>
            <?php echo form_close() ?>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

<!-- modal Hapus -->
<?php foreach ($cart as $key => $value) { ?>
  <div class="modal fade" id="modal-delete<?= $value['id_cart'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Data Keranjang Belanja</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open_multipart(base_url('User/DeleteDataCart/' . $value['id_cart'])) ?>
          <div class="form-group">
            Yakin Mau Hapus <b><?= $value['nama_barang']; ?></b> Dari Keranjang Belanja?
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary btn-flat">Hapus</button>
        </div>
        <?php echo form_close() ?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>
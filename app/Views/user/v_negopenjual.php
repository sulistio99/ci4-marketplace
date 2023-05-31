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
      <div class="row">
        <div class="col-12 table-responsive">
          <?php echo form_open('User/Pengajuan/' . session('id_user')) ?>
          <table id="" class="table table-bordered">
            <thead>
              <tr class="text-center">
                <th>ID Barang</th>
                <th>Foto Barang</th>
                <th>Nama Barang</th>
                <th>Status</th>
                <th>Harga</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $db = \Config\Database::connect();
              $status = $db->table('tb_pengajuan')
                ->where('id_pengajuan', $negopenjual['id_pengajuan'])
                ->get()->getRowArray();
              ?>
              <tr class="text-center">
                <td><?= $negopenjual['id_barang']; ?></td>
                <td class="text-center"><img src="<?= base_url('foto/FotoBarang/' . $negopenjual['foto1']); ?>" width="150px"></td>
                <td><?= $negopenjual['nama_barang']; ?></td>
                <td><?= $status['status']; ?></td>
                <td><?= number_to_currency($negopenjual['harga_barang'], 'Rp.') ?></td>
              </tr>
              <tr class="bg-secondary">
                <td colspan="4">Total</td>
                <td><?= number_to_currency($negopenjual['harga_barang'], 'Rp.') ?></td>
              </tr>
              <tr class="bg-secondary">
                <td colspan="4">Harga Tawaran Pembeli</td>
                <td><?= number_to_currency($negopenjual['harga_tawar_pembeli'], 'Rp.') ?></td>
              </tr>
              <tr class="bg-secondary">
                <td colspan="4">Harga Tawaran Anda Sebelumnya</td>
                <td><?= number_to_currency($negopenjual['harga_tawar_penjual'], 'Rp.') ?></td>
              </tr>
              <tr class="bg-secondary">
                <td colspan="5" style="font-size:12px ;">
                  Catatan: <br>
                  Klik NEGO Untuk Memasukkan Harga Negosiasi! <br>
                  Klik DEAL Untuk Menyetujui Harga Akhir Penawaran!
                </td>
              </tr>
              <tr>
                <td colspan="5">
                  <button type="button" class="btn btn-primary btn-block btn-xs" data-toggle="modal" data-target="#modal-negopenjual<?= $negopenjual['id_pengajuan'] ?>" <?php if ($status['status'] != 'proses negosiasi') { ?> disabled <?php  } ?>>
                    NEGO
                  </button>
                </td>
              </tr>
              <tr>
                <td colspan="5">
                  <button type="button" class="btn btn-primary btn-block btn-xs" data-toggle="modal" data-target="#modal-dealpenjual<?= $negopenjual['id_pengajuan'] ?>" <?php if ($status['status'] != 'proses negosiasi') { ?> disabled <?php  } ?>>
                    DEAL
                  </button>
                </td>
              </tr>
              <tr>
                <td colspan="5"><a href="<?= base_url('User/Penjualan/' . session('id_user')); ?>" class="btn btn-warning btn-xs btn-block">KEMBALI</a></td>
              </tr>
            </tbody>
          </table>
          <?php echo form_close() ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal nego penjual -->
<div class="modal fade" id="modal-negopenjual<?= $negopenjual['id_pengajuan'] ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Konfirmasi Proses Negosisasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart(base_url('User/EditPengajuanPenjual/' . $negopenjual['id_pengajuan'])) ?>
        <?php
        $db = \Config\Database::connect();
        $nama_penjual = $db->table('tb_user')
          ->where('id_user', session('id_user'))
          ->get()->getRowArray();

        $nama_pembeli = $db->table('tb_user')
          ->where('id_user', $negopenjual['id_pembeli'])
          ->get()->getRowArray();

        $namabarang = $db->table('tb_barang')
          ->where('id_barang', $negopenjual['id_barang'])
          ->get()->getRowArray();
        ?>
        <div class="form-group">
          <input type="hidden" value="<?= $nama_penjual['nama_user']; ?>" name="dari">
          <input type="hidden" value="<?= $nama_pembeli['nama_user']; ?>" name="kepada">
          <input type="hidden" value="<?= $negopenjual['id_pembeli']; ?>" name="id_user">
          <input type="hidden" value="<?= $namabarang['nama_barang']; ?>" name="nama_bp">
          Harga Penawaran Terbaru :
          <input type="text" placeholder="Masukkan Harga Penawaran Terbaru Anda" class="form-control" name="harga_tawar_penjual" required>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary btn-flat">Nego</button>
      </div>
      <?php echo form_close() ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal DEAL penjual -->
<div class="modal fade" id="modal-dealpenjual<?= $negopenjual['id_pengajuan'] ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Konfirmasi Harga Akhir Penawaran</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart(base_url('User/AddKonfirmPenjual/' . $negopenjual['id_pengajuan'])) ?>
        <input type="hidden" value="<?= $nama_penjual['nama_user']; ?>" name="dari">
        <input type="hidden" value="<?= $nama_pembeli['nama_user']; ?>" name="kepada">
        <input type="hidden" value="<?= $negopenjual['id_pembeli']; ?>" name="id_user">
        <input type="hidden" value="<?= $namabarang['nama_barang']; ?>" name="nama_bp">
        <input type="hidden" value="<?= $negopenjual['harga_tawar_pembeli']; ?>" name="harga">
        <input type="hidden" value="<?= $negopenjual['id_pengajuan']; ?>" name="id_pengajuan">
        <div class="form-group">
          Harga Penawaran Akhir : <b><?= number_to_currency($negopenjual['harga_tawar_pembeli'], 'Rp.') ?></b>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary btn-flat">Deal</button>
      </div>
      <?php echo form_close() ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
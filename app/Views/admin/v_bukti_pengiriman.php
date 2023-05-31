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
          <tr class="text-center">
            <th>ID Bukti Pengiriman</th>
            <th>Tanggal</th>
            <th>Foto</th>
            <th>ID Pengajuan</th>
            <th colspan="2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($buktipengiriman as $key => $value) { ?>
            <tr tr class="text-center">
              <td><?= $value['id_bukti_pengiriman']; ?></td>
              <td><?= $value['tanggal']; ?></td>
              <td>
                <img src="<?= base_url('foto/BuktiPengiriman/' . $value['foto']); ?>" width="120" height="120">
              </td>
              <td><?= $value['id_pengajuan']; ?></td>
              <td>
                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-diterima<?= $value['id_bukti_pengiriman'] ?>" <?php if ($value['validasi'] == 'valid') { ?> disabled <?php  } ?>>
                  <?php if ($value['validasi'] == 'valid') { ?>
                    <i class="fas fa-check"></i>
                  <?php } ?>
                  Diterima
                </button>
                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-ditolak<?= $value['id_bukti_pengiriman'] ?>">
                  Ditolak
                </button>
              </td>
              <td>
                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-rincian<?= $value['id_bukti_pengiriman'] ?>">
                  Rincian
                </button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- modal diterima -->
<?php foreach ($buktipengiriman as $key => $value) { ?>
  <div class="modal fade" id="modal-diterima<?= $value['id_bukti_pengiriman'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Konfirmasi Bukti Pembayaran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <?php echo form_open(base_url('Admin/TerimaBuktiPengiriman/' . $value['id_bukti_pengiriman'])) ?>

          <?php
          $db = \Config\Database::connect();
          // $id_transaksi = $db->table('tb_transaksi')
          //   ->join('tb_bukti_pengiriman', 'tb_bukti_pengiriman.id_transaksi=tb_transaksi.id_transaksi')
          //   ->where('tb_transaksi.id_transaksi', $value['id_transaksi'])
          //   ->get()->getRowArray();

          $id_bukti_pembayaran = $db->table('tb_bukti_transaksi')
            ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=tb_bukti_transaksi.id_pengajuan')
            ->where('tb_bukti_transaksi.id_pengajuan', $value['id_pengajuan'])
            ->get()->getRowArray();

          $id_penjual = $db->table('tb_user')
            ->join('tb_pengajuan', 'tb_pengajuan.id_penjual=tb_user.id_user')
            ->join('tb_bukti_pengiriman', 'tb_bukti_pengiriman.id_pengajuan=tb_pengajuan.id_pengajuan')
            ->where('tb_pengajuan.id_pengajuan', $value['id_pengajuan'])
            ->get()->getRowArray();

          $id_pembeli = $db->table('tb_user')
            ->join('tb_pengajuan', 'tb_pengajuan.id_pembeli=tb_user.id_user')
            ->join('tb_bukti_pengiriman', 'tb_bukti_pengiriman.id_pengajuan=tb_pengajuan.id_pengajuan')
            ->where('tb_pengajuan.id_pengajuan', $value['id_pengajuan'])
            ->get()->getRowArray();
          ?>
          <input type="hidden" value="<?= $value['harga_akhir']; ?>" name="harga_akhir">
          <input type="hidden" value="<?= $id_pembeli['id_pembeli']; ?>" name="id_pembeli">
          <input type="hidden" value="<?= $id_penjual['id_penjual']; ?>" name="id_penjual">
          <input type="hidden" value="<?= $id_bukti_pembayaran['id_bukti_transaksi']; ?>" name="id_bukti_transaksi">
          <input type="hidden" value="<?= $value['id_bukti_pengiriman']; ?>" name="id_bukti_pengiriman">
          <input type="hidden" value="<?= $value['id_pengajuan']; ?>" name="id_pengajuan">
          <input type="hidden" value="<?= $value['id_transaksi']; ?>" name="id_transaksi">
          <div class="form-group">
            <label>Terima?</label>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary btn-flat">Ya</button>
        </div>
        <?php echo form_close() ?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>

<!-- modal rincian -->
<?php foreach ($buktipengiriman as $key => $value) { ?>
  <div class="modal fade" id="modal-rincian<?= $value['id_bukti_pengiriman'] ?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Bukti Transaksi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open(base_url('Admin/TerimaBuktiTransaksi/' . $value['id_bukti_pengiriman'])) ?>
          <input type="hidden" value="<?= $value['id_pengajuan']; ?>" name="id_pengajuan">
          <div class="form-group">
            <img src="<?= base_url('foto/BuktiPengiriman/' . $value['foto']); ?>" alt="" width="100%" height="400">
            <label>Keterangan:</label><br>
            <?= $value['keterangan']; ?>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
        </div>
        <?php echo form_close() ?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>

<!-- modal ditolak -->
<?php foreach ($buktipengiriman as $key => $value) { ?>
  <div class="modal fade" id="modal-ditolak<?= $value['id_bukti_pengiriman'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Konfirmasi Bukti Pengiriman</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <?php echo form_open(base_url('Admin/TolakBuktiPengiriman/' . $value['id_bukti_pengiriman'])) ?>
          <input type="hidden" value="<?= $value['id_pengajuan']; ?>" name="id_pengajuan">
          <div class="form-group">
            <label>Ditolak?</label>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary btn-flat">Ya</button>
        </div>
        <?php echo form_close() ?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>
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
            <th>ID Bukti Transaksi</th>
            <th>Tanggal</th>
            <th>Foto</th>
            <th>ID Pengajuan</th>
            <th colspan="2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($buktitransaksi as $key => $value) { ?>
            <tr tr class="text-center">
              <td><?= $value['id_bukti_transaksi']; ?></td>
              <td><?= $value['tanggal']; ?></td>
              <td>
                <img src="<?= base_url('foto/BuktiTransaksi/' . $value['foto']); ?>" width="120" height="120">
              </td>
              <td><?= $value['id_pengajuan']; ?></td>
              <td>
                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-diterima<?= $value['id_bukti_transaksi'] ?>" <?php if ($value['validasi'] == 'valid') { ?> disabled <?php  } ?>>
                  <?php if ($value['validasi'] == 'valid') { ?>
                    <i class="fas fa-check"></i>
                  <?php } ?>
                  Diterima
                </button>
                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-ditolak<?= $value['id_bukti_transaksi'] ?>">

                  Ditolak
                </button>
              </td>
              <td>
                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-rincian<?= $value['id_bukti_transaksi'] ?>">
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
<?php foreach ($buktitransaksi as $key => $value) { ?>
  <div class="modal fade" id="modal-diterima<?= $value['id_bukti_transaksi'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Konfirmasi Bukti Pembayaran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <?php echo form_open(base_url('Admin/TerimaBuktiTransaksi/' . $value['id_bukti_transaksi'])) ?>
          <input type="hidden" value="<?= $value['id_pengajuan']; ?>" name="id_pengajuan">
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

<!-- modal ditolak -->
<?php foreach ($buktitransaksi as $key => $value) { ?>
  <div class="modal fade" id="modal-ditolak<?= $value['id_bukti_transaksi'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Konfirmasi Bukti Pembayaran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <?php echo form_open(base_url('Admin/TolakBuktiTransaksi/' . $value['id_bukti_transaksi'])) ?>
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

<!-- modal rincian -->
<?php foreach ($buktitransaksi as $key => $value) { ?>
  <div class="modal fade" id="modal-rincian<?= $value['id_bukti_transaksi'] ?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Bukti Transaksi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open(base_url('Admin/TerimaBuktiTransaksi/' . $value['id_bukti_transaksi'])) ?>
          <input type="hidden" value="<?= $value['id_pengajuan']; ?>" name="id_pengajuan">
          <div class="form-group">
            <img src="<?= base_url('foto/BuktiTransaksi/' . $value['foto']); ?>" alt="" width="100%" height="400">
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
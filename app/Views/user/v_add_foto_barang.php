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

      <?php
      $errors = session()->getFlashdata('errors');
      if (!empty($errors)) {
      ?>
        <div class="alert alert-danger" role="alert">
          <ul>
            <?php foreach ($errors as $key => $error) : ?>
              <li><?= esc($error); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php } ?>

      <?php echo form_open_multipart('User/SimpanAlbumBarang/' . $barang['id_barang']) ?>
      <div class="row">
        <div class="col-4">
          <div class="form-group">
            <input type="hidden" name="id_barang" value="<?= $barang['id_barang']; ?>" class="form-control">
            <input type="text" name="ket" placeholder="Ket Gambar" class="form-control">
          </div>
        </div>
        <div class="col-4">
          <div class="form-group">
            <input type="file" name="gambar" class="form-control" id="preview_gambar">
          </div>
        </div>
        <div class="col-4 text-center">
          <div class="form-group">
            <img src="<?= base_url('foto/fotobarang/gallery.png'); ?>" width="150" id="gambar_load">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <a href="<?= base_url('User/FotoBarang/' . session('id_user')); ?>" class="btn btn-warning">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
      <hr>

      <div class="row text-center">
        <?php foreach ($gambar as $key => $value) { ?>
          <div class="col-sm-3">
            <div class="form-group">
              <img src="<?= base_url('foto/albumbarang/' . $value['gambar']); ?>" width="150" height="120" id="gambar_load">
            </div>
            <p>Ket : <?= $value['ket']; ?></p>
            <button class="btn btn-danger btn-xs btn-block" data-toggle="modal" data-target="#modal-hapus<?= $value['id_gambar'] ?>" type="button"><i class="fas fa-trash"></i> Hapus</button>
          </div>
        <?php } ?>
      </div>

      <?php echo form_close() ?>
    </div>
  </div>
</div>

<!-- modal hapus -->
<?php foreach ($gambar as $key => $value) { ?>
  <div class="modal fade" id="modal-hapus<?= $value['id_gambar'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Konfirmasi Hapus Foto Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <?php echo form_open(base_url('User/DeleteAlbumBarang/' . $value['id_gambar'])) ?>
          <input type="hidden" value="<?= $value['id_gambar']; ?>" name="id_gambar">
          <div class="form-group">
            <label>Yakin Mau Hapus?</label>
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
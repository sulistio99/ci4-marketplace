<div class="col-md-12">
  <div class="card">
    <div class="card-header p-2 text-center">
      <h1><i class="fas fa-handshake"></i> <?= $title; ?>.</h1>
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

      <!-- Notif error -->
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

      <div class="row">
        <div class="col-12 table-responsive">
          <table id="example2" class="table table-bordered table-sm">
            <thead class="thead-dark">
              <tr class="text-center">
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Pembeli</th>
                <th>Total</th>
                <th>Harga Akhir</th>
                <th>Status</th>
                <th width="180px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($transaksi as $key => $value) { ?>
                <?php
                $db = \Config\Database::connect();
                // $nama_penjual = $db->table('tb_barang')
                //   ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
                //   ->where('tb_barang.id_user', $value['id_penjual'])
                //   ->get()->getRowArray();

                // $nama_pembeli = $db->table('tb_barang')
                //   ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
                //   ->where('tb_barang.id_user', $value['id_pembeli'])
                //   ->get()->getRowArray();

                $nama_penjual = $db->table('tb_user')
                  ->where('id_user', $value['id_penjual'])
                  ->get()->getRowArray();

                $nama_pembeli = $db->table('tb_user')
                  ->where('id_user', $value['id_pembeli'])
                  ->get()->getRowArray();

                $statusbuktitransaksi = $db->table('tb_bukti_transaksi')
                  ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=tb_bukti_transaksi.id_pengajuan')
                  ->where('tb_pengajuan.id_penjual', $value['id_user'])
                  ->get()->getRowArray();

                $statusbuktipengiriman = $db->table('tb_bukti_pengiriman')
                  ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=tb_bukti_pengiriman.id_pengajuan')
                  ->where('tb_pengajuan.id_penjual', $value['id_user'])
                  ->get()->getRowArray();

                $status = $db->table('tb_pengajuan')
                  ->where('id_pengajuan', $value['id_pengajuan'])
                  ->get()->getRowArray();

                $kategori = $db->table('tb_barang')
                  ->join('tb_pengajuan', 'tb_pengajuan.id_barang=tb_barang.id_barang')
                  ->join('tb_kategori', 'tb_kategori.id_kategori=tb_barang.id_kategori')
                  ->where('tb_barang.id_barang', $value['id_barang'])
                  ->get()->getRowArray();
                ?>
                <tr>
                  <td><?= date('d M Y', strtotime($value['tanggal'])); ?></td>
                  <td><?= $value['nama_barang']; ?></td>
                  <td><?= $nama_pembeli['nama_user']; ?></td>
                  <td><?= number_to_currency($value['harga_barang'], 'Rp.') ?></td>
                  <td><?= number_to_currency($value['harga_akhir'], 'Rp.') ?></td>
                  <td class="text-center">
                    <?php if ($status['status'] == 'Transaksi Disetujui (lanjutkan ke menu transaksi)' || $status['status'] == 'Menunggu Konfirmasi Transaksi Dari Admin' || $status['status'] == 'Menunggu Konfirmasi Pengiriman Dari Admin' || $status['status'] == 'Bukti Pengiriman Diterima (Barang Dikirim Kelokasi Pembeli)'  || $status['status'] == 'Bukti Pembayaran Diterima (Menunggu Barang Dikirim Oleh Penjual)' || $status['status'] == 'Bukti Pengiriman Ditolak (Pastikan Bukti Pengiriman Asli)') { ?>
                      <?= $status['status']; ?><br>
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-uploadbuktipengiriman<?= $value['id_transaksi'] ?>" <?php if ($status['status'] == 'Transaksi Disetujui (lanjutkan ke menu transaksi)' || $status['status'] == 'Menunggu Konfirmasi Transaksi Dari Admin' || $status['status'] == 'Menunggu Konfirmasi Pengiriman Dari Admin' || $status['status'] == 'Bukti Pengiriman Diterima (Barang Dikirim Kelokasi Pembeli)' || $status['status'] == 'Barang Diterima') { ?> disabled<?php } ?>>
                        <i class="fas fa-upload"></i> Upload Bukti Pengiriman
                      </button>
                    <?php } else { ?>
                      <span class="text-primary"><?= $status['status']; ?></span>
                    <?php } ?>


                  </td>
                  <td width="180px">
                    <div class="btn-group">
                      <a href="<?= base_url('User/RincianPenjualan/' . $value['id_transaksi']); ?>" class="btn btn-warning btn-sm">
                        <i class="fas fa-bars"></i> Rincian
                      </a>
                      <!-- <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-rincianidtransaksi">
                      Rincian
                    </button> -->
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-deletetransaksi<?= $value['id_transaksi'] ?>" <?php if ($status['status'] == 'Barang Diterima') { ?> disabled <?php } ?>>
                        <i class="fas fa-trash"></i> Batalkan
                      </button>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- modal Hapus -->
<?php foreach ($transaksi as $key => $value) { ?>
  <div class="modal fade" id="modal-deletetransaksi<?= $value['id_transaksi'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Konfirmasi Pembatalan Transaksi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <?php echo form_open_multipart(base_url('User/DeleteTransaksiPembelian/' . $value['id_transaksi'])) ?>
          <input type="text" name="id_barang" value="<?= $value['id_barang']; ?>">
          <input type="text" name="id_cart" value="<?= $value['id_cart']; ?>">
          <input type="text" name="id_pengajuan" value="<?= $value['id_pengajuan']; ?>">
          <div class="form-group">
            Yakin Mau Batalkan Transaksi Pembelian <b><?= $value['nama_barang']; ?> ?</b>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tidak</button>
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

<!-- modal upload -->
<?php foreach ($transaksi as $key => $value) { ?>
  <div class="modal fade" id="modal-uploadbuktipengiriman<?= $value['id_transaksi'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload Bukti Pengiriman</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open_multipart(base_url('User/UploadBuktiPengiriman/' . $value['id_transaksi'])) ?>
          <input type="hidden" name="id_barang" value="<?= $value['id_barang']; ?>">
          <input type="hidden" name="id_cart" value="<?= $value['id_cart']; ?>">
          <input type="hidden" name="id_pengajuan" value="<?= $value['id_pengajuan']; ?>">
          <input type="hidden" name="id_transaksi" value="<?= $value['id_transaksi']; ?>">
          <div class="form-group">
            <div class="form-group">
              <label class="form-control">Keterangan :</label>
              <textarea name="keterangan" cols="30" rows="3" class="form-control"><?= old('keterangan'); ?></textarea>
              <input id="preview_gambar" type="file" name="foto">
              <img id="gambar_load" class="text-center" style="border: none;" src="<?= base_url('foto/fotobarang/gallery.png'); ?>" width="100%" height="200">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary btn-flat">Upload</button>
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
<?php foreach ($transaksi as $key => $value) { ?>
  <div class="modal fade" id="modal-rincian<?= $value['id_transaksi'] ?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Transaksi Penjualan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open_multipart(base_url('User/BarangDiterima/' . $value['id_transaksi'])) ?>
          <input type="hidden" name="id_barang" value="<?= $value['id_barang']; ?>">
          <input type="hidden" name="id_cart" value="<?= $value['id_cart']; ?>">
          <input type="hidden" name="id_pengajuan" value="<?= $value['id_pengajuan']; ?>">
          <div class="form-group">
            <div class="form-group">
              <div class="table-responsive">
                <table id="" class="table">
                  <thead>
                    <tr class="text-center">
                      <th width="200px">Foto Barang</th>
                      <th>Detail Barang</th>
                      <th>Penjual</th>
                      <th>Pembeli</th>
                      <th>Alamat Pengiriman</th>
                      <th>Harga Akhir</th>
                      <th>Status Penawaran</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($transaksi as $key => $value) { ?>
                      <tr>
                        <td>

                          <img src="<?= base_url('foto/FotoBarang/' . $value['foto1']); ?>" width="200px" height="200px" class="rounded">
                        </td>
                        <td>
                          <table class="table table-striped">
                            <tr>
                              <td colspan="2"><b><?= $value['nama_barang']; ?></b></td>
                            </tr>
                            <tr>
                              <td>Kategori</td>
                              <td>:<?= $kategori['nama_kategori']; ?></td>
                            </tr>
                            <tr>
                              <td>Harga</td>
                              <td>:<?= number_to_currency($value['harga_barang'], 'Rp.') ?></td>
                            </tr>
                            <tr>
                              <td>Status</td>
                              <td>:<?= $value['status']; ?></td>
                            </tr>
                          </table>
                        </td>
                        <td><?= $nama_penjual['nama_user']; ?></td>
                        <td><?= $nama_pembeli['nama_user']; ?></td>
                        <td><?= $nama_pembeli['alamat']; ?></td>
                        <td><?= number_to_currency($value['harga_tawar_penjual'], 'Rp.') ?></td>
                        <td><?= $status['status']; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
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
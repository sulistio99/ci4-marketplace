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
                <th>Foto Barang</th>
                <th>Detail Barang</th>
                <th>Deskripsi Barang</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $db = \Config\Database::connect();
              // $nama_penjual = $db->table('tb_barang')
              //   ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
              //   ->where('tb_barang.id_user', $detailtransaksi['id_penjual'])
              //   ->get()->getRowArray();

              // $nama_pembeli = $db->table('tb_barang')
              //   ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
              //   ->where('tb_barang.id_user', $detailtransaksi['id_pembeli'])
              //   ->get()->getRowArray();

              $nama_penjual = $db->table('tb_pengajuan')
                ->join('tb_user', 'tb_user.id_user=tb_pengajuan.id_penjual')
                ->where('id_user', $detailtransaksi['id_penjual'])
                ->get()->getRowArray();

              $nama_pembeli = $db->table('tb_pengajuan')
                ->join('tb_user', 'tb_user.id_user=tb_pengajuan.id_pembeli')
                ->where('id_user', $detailtransaksi['id_pembeli'])
                ->get()->getRowArray();

              $status = $db->table('tb_pengajuan')
                ->where('id_pengajuan', $detailtransaksi['id_pengajuan'])
                ->get()->getRowArray();

              $kategori = $db->table('tb_barang')
                ->join('tb_pengajuan', 'tb_pengajuan.id_barang=tb_barang.id_barang')
                ->join('tb_kategori', 'tb_kategori.id_kategori=tb_barang.id_kategori')
                ->where('tb_barang.id_barang', $detailtransaksi['id_barang'])
                ->get()->getRowArray();
              ?>
              <tr>
                <td class="text-center"><img src="<?= base_url('foto/FotoBarang/' . $detailtransaksi['foto1']); ?>" width="200" height="200"></td>
                <td>
                  <table class="table table-borderless">
                    <tr>
                      <td colspan="2"><b><?= $detailtransaksi['nama_barang']; ?></b></td>
                    </tr>
                    <tr>
                      <td><b>Penjual</b></td>
                      <td>: <?= $nama_penjual['nama_user']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Kategori</b></td>
                      <td>: <?= $detailtransaksi['nama_kategori']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Harga</b></td>
                      <td>: <?= number_to_currency($detailtransaksi['harga_barang'], 'Rp.') ?></td>
                    </tr>
                    <tr>
                      <td><b>Status</b></td>
                      <td>: <?= $detailtransaksi['status']; ?></td>
                    </tr>
                  </table>
                </td>
                <td><?= $detailtransaksi['deskripsi']; ?></td>
              </tr>
              <tr class="bg-secondary">
                <td colspan="2">Pembeli</td>
                <td><?= $nama_pembeli['nama_user']; ?></td>
              </tr>
              <tr class="bg-secondary">
                <td colspan="2">Alamat</td>
                <td><?= $nama_pembeli['alamat']; ?></td>
              </tr>
              <tr class="bg-secondary">
                <td colspan="2">Harga Akhir</td>
                <td><?= number_to_currency($detailtransaksi['harga_akhir'], 'Rp.') ?></td>
              </tr>
              <tr class="bg-secondary">
                <td colspan="2">Status</td>
                <td><?= $status['status']; ?></td>
              </tr>
              <tr>
                <td colspan="4"><a href="<?= base_url('User/TransaksiPenjualan/' . session('id_user')); ?>" class="btn btn-warning btn-xs btn-block">KEMBALI</a></td>
              </tr>
            </tbody>
          </table>
          <?php echo form_close() ?>
        </div>
      </div>
    </div>
  </div>
</div>
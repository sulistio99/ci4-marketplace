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
            <th>Tanggal</th>
            <th>Bukti Transaksi</th>
            <th>Bukti Pengiriman</th>
            <th>Barang</th>
            <th>Penjual</th>
            <th>Pembeli</th>
            <th>Harga AKhir</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($riwayattransaksi as $key => $value) { ?>
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

            $nama_penjual = $db->table('tb_pengajuan')
              ->join('tb_user', 'tb_user.id_user=tb_pengajuan.id_penjual')
              ->where('id_user', $value['id_penjual'])
              ->get()->getRowArray();

            $nama_pembeli = $db->table('tb_pengajuan')
              ->join('tb_user', 'tb_user.id_user=tb_pengajuan.id_pembeli')
              ->where('id_user', $value['id_pembeli'])
              ->get()->getRowArray();

            $foto_bukti_pengiriman = $db->table('tb_bukti_pengiriman')
              ->join('tb_riwayat_transaksi', 'tb_riwayat_transaksi.id_bukti_pengiriman=tb_bukti_pengiriman.id_bukti_pengiriman')
              ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=tb_bukti_pengiriman.id_pengajuan')
              ->where('tb_bukti_pengiriman.id_pengajuan', $value['id_pengajuan'])
              ->get()->getRowArray();

            $foto_bukti_transaksi = $db->table('tb_bukti_transaksi')
              ->join('tb_riwayat_transaksi', 'tb_riwayat_transaksi.id_bukti_transaksi=tb_bukti_transaksi.id_bukti_transaksi')
              ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=tb_bukti_transaksi.id_pengajuan')
              ->where('tb_bukti_transaksi.id_pengajuan', $value['id_pengajuan'])
              ->get()->getRowArray();
            ?>

            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['tanggal']; ?></td>
              <td>
                <img src="<?= base_url('foto/BuktiTransaksi/' . $foto_bukti_transaksi['foto']); ?>" width="150" height="150">
              </td>
              <td>
                <img src="<?= base_url('foto/BuktiPengiriman/' . $foto_bukti_pengiriman['foto']); ?>" width="150" height="150">
              </td>
              <td><?= $value['nama_barang']; ?></td>
              <td><?= $nama_penjual['nama_user']; ?></td>
              <td><?= $nama_pembeli['nama_user']; ?></td>
              <td><?= number_to_currency($value['harga_akhir'], 'Rp.') ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
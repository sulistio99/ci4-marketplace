<div class="col-md-12">
  <div class="card">
    <div class="card-header p-2 text-center">
      <b>Dashboard | <b><?= session('nama_user'); ?></b></b>
    </div><!-- /.card-header -->
    <div class="card-body">
      <div class="tab-content">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 class="text-dark"><?= $totalbarang; ?></h3>
                <p>Barang</p>
              </div>
              <div class="icon bg-light">
                <i class="ion ion-bag "></i>
              </div>
              <a href="<?= base_url('User/LihatBarang/' . session('id_user')); ?>" class="small-box-footer text-dark">Lihat<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 class="text-dark"><?= $totalpenawaranpenjualan; ?></h3>

                <p>Penawaran Penjualan</p>
              </div>
              <div class="icon bg-light">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('User/Penjualan/' . session('id_user')); ?>" class="small-box-footer text-dark">Lihat<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 class="text-dark"><?= $totalpenawaranpembelian; ?></h3>

                <p>Penawaran Pembelian</p>
              </div>
              <div class="icon bg-light">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('User/Pembelian/' . session('id_user')); ?>" class="small-box-footer text-dark">Lihat<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 class="text-dark"><?= $totalriwayattransaksi; ?></h3>

                <p>Riwayat Transaksi</p>
              </div>
              <div class="icon bg-light">
                <i class="fas fa-history"></i>
              </div>
              <a href="<?= base_url('User/RiwayatTransaksi/' . session('id_user')); ?>" class="small-box-footer text-dark">Lihat<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
      </div>
      <!-- /.tab-content -->
    </div><!-- /.card-body -->
  </div>
  <!-- /.nav-tabs-custom -->
</div>
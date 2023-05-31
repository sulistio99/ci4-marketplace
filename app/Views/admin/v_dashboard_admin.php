<div class="col-md-12">
  <div class="card">
    <div class="card-header p-2 text-center">
      <b>Dashboard</b>
    </div><!-- /.card-header -->
    <div class="card-body">
      <div class="tab-content">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $totaluser; ?></h3>
                <p>User</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?= base_url('Admin/KelolaUser'); ?>" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i> Lihat</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $totalbuktipembayaran; ?></h3>
                <p>Bukti Pembayaran</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('Admin/BuktiPembayaran'); ?>" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i> Lihat</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $totalbuktipengiriman; ?></h3>
                <p>Bukti Pengiriman </p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?= base_url('Admin/BuktiPengiriman'); ?>" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i> Lihat</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $totalbarang; ?></h3>

                <p>Barang</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?= base_url('Barang'); ?>" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i> Lihat</a>
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
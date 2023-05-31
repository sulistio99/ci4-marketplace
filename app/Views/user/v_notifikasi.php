<div class="col-md-12">
  <div class="card">
    <div class="card-header p-2 text-center">
      <h1><i class="fas fa-bell"></i> <?= $title; ?>.</h1>
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
          <?php echo form_open() ?>
          <?php foreach ($notifikasi as $key => $value) { ?>
            <div class="card">
              <div class="card-header bg-secondary">
                Dari : <b><?= $value['dari']; ?></b>
                <div class="card-tools">
                  <label><?= date('d F Y H:i:s', strtotime($value['tanggal'])); ?></label> <i class="fas fa-bell text-warning"></i>
                </div>
              </div>
              <div class="card-body">
                <i class="fas fa-envelope-open"></i> | <?= $value['aksi']; ?><br>
                <br>
              </div>
            </div>
          <?php } ?>
          <?php echo form_close() ?>
        </div>
      </div>
    </div>
  </div>
</div>
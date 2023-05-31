<div class="col">
  <section class="py-3">
    <div class="container">
      <div class="row">
        <div class="col">
          <?php echo form_open('') ?>
          <div class="input-group">
            <input type="text" class="form-control form-control-lg" placeholder="Pencarian" name="keywoard">
            <div class="input-group-append">
              <button type="submit" class="btn btn-lg btn-default">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
          <?php echo form_close() ?>
        </div>`
      </div>
      <div class="row">
        <div class="col">
          <section class="py-3">
            <div class="container">
              <div class="row text-center">
                <div class="col">
                  <img src="<?= base_url('foto/emptysearch.png'); ?>" width="120">
                </div>
              </div>
              <div class="row text-center py-3">
                <div class="col">
                  <h5>Barang tidak ditemukan.</h5>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
</div>
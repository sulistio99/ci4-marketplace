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
        </div>
      </div>
      <div class="row text-center py-3">
        <div class="col">
          <h4>Pilihan Barang</h4>
        </div>
      </div>
      <?php if (!$b) { ?>
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
                    <h5>Barang tidak ditemukan ditoko ini.</h5>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      <?php } ?>
      <div class="row">
        <?php foreach ($b as $key => $value) { ?>
          <div class="col-6 col-md-3 col-lg-2 mb-5">
            <?php echo form_open_multipart('User/TambahCart/' . session('id_user')) ?>
            <!-- id informasi barang -->
            <input type="hidden" value="<?= $value['id_user']; ?>" name="id_penjual">
            <input type="hidden" value="<?= $value['harga_barang']; ?>" name="harga">
            <input type="hidden" value="<?= $value['id_barang']; ?>" name="id_barang">
            <div class="card" style="height:320px ;">
              <!-- Product image-->
              <img src="<?= base_url('foto/FotoBarang/' . $value['foto1']); ?>" height="120px" style="border: 2px;" />
              <!-- Product details-->
              <div class="card-body">
                <div class="text-center">
                  <!-- Product name-->
                  <!-- Product reviews-->
                  <div class="d-flex justify-content-center">
                    <!-- <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div> -->
                    <label class="fw-bolder"><?= $value['nama_barang']; ?></label>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <span class="text-primary"><?= $value['status']; ?></span><br>
                <!-- Product price-->
                <b><?= number_to_currency($value['harga_barang'], 'Rp.') ?></b>
              </div>
              <!-- Product actions-->
              <div class="card-footer p-1 pb-2 border-top-0 bg-transparent">
                <div class="text-right">
                  <div class="row">
                    <div class="col-4">
                      <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#detailbarang<?= $value['id_barang'] ?>">Detail</button>
                    </div>
                    <div class="col-8">
                      <button type="submit" class="btn btn-success btn-sm swalDefaultSuccess" <?= $value['status'] == 'terjual' ? 'disabled' : ''; ?>><i class="fas fa-cart-plus"></i>Keranjang</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php echo form_close() ?>
          </div>
        <?php } ?>
      </div>
      <?= $pager->links('b', 'paging'); ?>
    </div>
  </section>
</div>

<!-- Modal Detail -->
<?php foreach ($barang as $key => $value) { ?>
  <div class="modal fade" id="detailbarang<?= $value['id_barang'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Detail Barang</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <?php
            $db = \Config\Database::connect();
            $albumbarang = $db->table('tb_gambar')
              ->where('id_barang', $value['id_barang'])
              ->get()->getResultArray();
            ?>
            <div class="col-12 col-sm-6 text-center">
              <img src="<?= base_url('foto/fotobarang/' . $value['foto1']); ?>" class="product-image" style="width: 370px; height: 300px;">
            </div>
            <div class="col-12 col-sm-6">
              <table class="table table-borderless">
                <tr class="text-center">
                  <td colspan="3">
                    <h4><b><?= $value['nama_barang']; ?></b></h4>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <a href="<?= base_url('Home/DetailToko/' . $value['id_user']); ?>" class="btn btn-default btn-sm"><i class="fa-solid fa-store"></i> Kunjungi Toko</a>
                  </td>
                </tr>
                <tr>
                  <th>
                    Penjual
                  </th>
                  <td>:</td>
                  <td>
                    <?= $value['nama_user']; ?>
                  </td>
                </tr>
                <tr>
                  <th>
                    Kategori
                  </th>
                  <td>:</td>
                  <td>
                    <?= $value['nama_kategori']; ?>
                  </td>
                </tr>
                <tr>
                  <th>
                    Harga
                  </th>
                  <td>:</td>
                  <td>
                    <?= number_to_currency($value['harga_barang'], 'Rp.') ?>
                  </td>
                </tr>
                <tr>
                  <th>
                    Status
                  </th>
                  <td>:</td>
                  <td class="text-primary">
                    <?= $value['status']; ?>
                  </td>
                </tr>
                <tr>
                  <th>
                    Deskripsi
                  </th>
                  <td>:</td>
                  <td>
                    <?= $value['deskripsi']; ?>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <hr>

          <div class="row text-center">
            <div class="col-12 product-image-thumbs justify-content-center" style="margin-top: 0;">
              <div class="product-image-thumb">
                <img src="<?= base_url('foto/fotobarang/' . $value['foto1']); ?>">
              </div>
              <?php foreach ($albumbarang as $key => $dataalbum) { ?>
                <div class="product-image-thumb">
                  <img src="<?= base_url('foto/albumbarang/' . $dataalbum['gambar']); ?>" alt="Product Image">
                </div>
              <?php } ?>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>


<?php } ?>
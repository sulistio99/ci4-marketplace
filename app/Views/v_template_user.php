<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>E-Marketplace</title>
  <script src="https://kit.fontawesome.com/11577a6fdb.js" crossorigin="anonymous"></script>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/dist/css/adminlte.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<?php if (session('id_user')) {
  echo '<body class="hold-transition sidebar-mini layout-navbar-fixed">';
} else {
  echo '<body class="hold-transition layout-top-nav">';
} ?>
<!-- /.layout-top-nav -->
<div class="wrapper">
  <?php
  $db = \Config\Database::connect();

  $totalnotifikasi = $db->table('tb_notifikasi')
    ->where('id_user', session('id_user'))
    ->countAllResults();

  $totalcart = $db->table('tb_cart')
    ->where('id_pembeli', session('id_user'))
    ->where('status', 'belum terjual')
    ->countAllResults();

  $notifikasi = $db->table('tb_notifikasi')
    ->where('id_user', session('id_user'))
    ->orderBy('id_notifikasi', 'desc')
    ->get()->getResultArray();

  $cart = $db->table('tb_cart')
    ->join('tb_barang', 'tb_barang.id_barang=tb_cart.id_barang')
    ->where('id_pembeli', session('id_user'))
    ->where('tb_cart.status', 'belum terjual')
    ->get()->getResultArray();

  $totaltransaksipembelian = $db->table('tb_transaksi')
    ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=tb_transaksi.id_pengajuan')
    ->where('tb_pengajuan.id_pembeli', session('id_user'))
    ->countAllResults();

  $totaltransaksipenjualan = $db->table('tb_transaksi')
    ->join('tb_pengajuan', 'tb_pengajuan.id_pengajuan=tb_transaksi.id_pengajuan')
    ->where('tb_pengajuan.id_penjual', session('id_user'))
    ->countAllResults();

  $totalpenawaranpembelian = $db->table('tb_pengajuan')
    ->where('tb_pengajuan.id_pembeli', session('id_user'))
    ->countAllResults();

  $totalpenawaranpenjualan = $db->table('tb_pengajuan')
    ->where('tb_pengajuan.id_penjual', session('id_user'))
    ->countAllResults();

  $datauser = $db->table('tb_user')
    ->where('id_user', session('id_user'))
    ->get()->getRowArray();

  $kategori = $db->table('tb_kategori')
    ->get()->getResultArray();
  ?>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <div class="container">
      <ul class="navbar-nav">
        <?php if (session('id_user')) { ?>
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
        <?php } ?>
      </ul>
      <a href="<?= base_url(); ?>" class="navbar-brand">
        <img src="<?= base_url(); ?>/Foto/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-2" style="opacity: .8" width="30">
        <span class="font-weight-bold font-weight-light">E-Marketplace Mahasiswa</span>
      </a>
      <!-- Left navbar links -->

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url(); ?>" class="nav-link"><i class="fas fa-home"></i> Beranda</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url('Home/Bantuan'); ?>" class="nav-link"><i class="fas fa-circle-info"></i> Bantuan</a>
        </li>
        <?php if (session('id_user')) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-bell text-warning"></i>
              <span class="badge badge-danger navbar-badge"><?= $totalnotifikasi; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <?php if (empty($totalnotifikasi)) { ?>
                <a href="" class="dropdown-item text-center">
                  <p>Tidak Ada Notifikasi</p>
                </a>
              <?php } else { ?>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item text-center">
                  <i class="fas fa-envelope mr-2"></i> <?= $totalnotifikasi; ?> Pesan Pemberitahuan </a>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('User/Notifikasi/' . session('id_user')); ?>" class="dropdown-item dropdown-footer"><i class="fas fa-bars"></i> Lihat Notifikasi</a>
              <?php } ?>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-shopping-cart"></i>
              <span class="badge badge-danger navbar-badge"><?= $totalcart; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <?php if (empty($totalcart)) { ?>
                <a href="" class="dropdown-item text-center">
                  <p><i class="fas fa-cart-plus"></i> Keranjang Belanja Kosong</p>
                </a>
              <?php } else { ?>
                <a href="#" class="dropdown-item">
                  <!-- Message Start -->
                  <div class="media-title text-center">
                    <i class="fas fa-shopping-cart"></i> Daftar Keranjang
                  </div>
                  <?php foreach ($cart as $key => $value) {
                  ?>
                    <hr>
                    <div class="media">
                      <img src="<?= base_url('foto/FotoBarang/' . $value['foto1']); ?>" class="img img-fluid img-size-50 mr-3">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          <?= $value['nama_barang']; ?>
                        </h3>
                        <p class="text-sm"><?= number_to_currency($value['harga_barang'], 'Rp.'); ?></p>
                      </div>
                    </div>
                  <?php } ?>
                  <!-- Message End -->
                </a>

                <div class="dropdown-divider"></div>
                <a href="<?= base_url('User/Cart/' . session('id_user')); ?>" class="dropdown-item dropdown-footer"><i class="fas fa-bars"></i> Lihat Keranjang</a>
              <?php } ?>
          </li>
        <?php } ?>
        <?php if (!session('id_user')) { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('Auth/Registrasi'); ?>"><i class="fas fa-user-plus"></i> Daftar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('Auth'); ?>"><i class="fas fa-user-plus"></i> Masuk</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <?php if (session('id_user')) { ?>
    <aside class="main-sidebar sidebar-dark-primary elevation-2">
      <a href="" class="brand-link elevation-4">
        <?php if (session('foto_user') == '' or session('foto_user') == null) { ?>
          <img src="<?= base_url('foto/blank.png'); ?>" class="brand-image img-circle">
        <?php } ?>
        <?php if (session('foto_user')) { ?>
          <img src="<?= base_url('foto/fotouser/' . session('foto_user')); ?>" alt="AdminLTE Logo" class="brand-image img-circle">
        <?php } ?>
        <span class="font-weight-bold brand-text font-weight-light"><?= session('nama_user'); ?></span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <?php if ($datauser['alamat'] == '') { ?>
              <li class="nav-item bg-danger mb-2">
                <a class="nav-link">
                  <p>
                    <i class="fas fa-circle-info"></i><br>
                    Lengkapi Data Profile Terlebih Dahulu, sebelum memulai transaksi!
                  </p>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a href="<?= base_url('User/DashboardUser/' . session('id_user')); ?>" class="nav-link <?= $menu == 'dashboarduser' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('User/EditProfil/' . session('id_user')); ?>" class="nav-link <?= $menu == 'edituser' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Edit Profil
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview <?= $menu == 'kelolabarang' ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= $menu == 'kelolabarang' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-list"></i>
                <p>
                  Kelola Barang
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('User/TambahBarang/' . session('id_user')); ?>" class="nav-link <?= $submenu == 'tambahbarang' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tambah Barang</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('User/FotoBarang/' . session('id_user')); ?>" class="nav-link <?= $submenu == 'fotobarang' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Foto Barang</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('User/LihatBarang/' . session('id_user')); ?>" class="nav-link <?= $submenu == 'lihatbarang' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lihat Barang</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview <?= $menu == 'penawaran' ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= $menu == 'penawaran' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-handshake"></i>
                <p>
                  Penawaran
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview ">
                <li class="nav-item">
                  <a href="<?= base_url('User/Penjualan/' . session('id_user')); ?>" class="nav-link <?= $submenu == 'penjualan' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penjualan <span class="badge badge-primary"><?= $totalpenawaranpenjualan; ?></p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('User/Pembelian/' . session('id_user')); ?>" class="nav-link <?= $submenu == 'pembelian' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pembelian <span class="badge badge-primary"><?= $totalpenawaranpembelian; ?></p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview <?= $menu == 'transaksi' ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= $menu == 'transaksi' ? 'active' : '' ?>">
                <i class="fa-solid fa-money-bill-transfer"></i>
                <p>
                  Transaksi
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('User/TransaksiPenjualan/' . session('id_user')); ?>" class="nav-link <?= $submenu == 'buktitransaksipenjualan' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Transaksi Penjualan <span class="badge badge-primary"><?= $totaltransaksipenjualan; ?></p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('User/TransaksiPembelian/' . session('id_user')); ?>" class="nav-link <?= $submenu == 'buktitransaksipembelian' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Transaksi Pembelian <span class="badge badge-primary"><?= $totaltransaksipembelian; ?></span></p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('User/RiwayatTransaksi/' . session('id_user')); ?>" class="nav-link <?= $menu == 'riwayattransaksi' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-history"></i>
                <p>
                  Riwayat Transaksi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('Auth/Logout'); ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Keluar
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  <?php } ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="content-header">
        <div class="container">
          <div class="row">
            <?php if ($page) {
              echo view($page);
            } ?>
          </div>
        </div><!-- /.container -->
      </div>
      <!-- /.content -->
    </div>
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer text-center">
    <strong>Copyright &copy; 2018-2022 <a href="https://adminlte.io">Sulistio.TI</a>.</strong> UNITAMA.
  </footer>
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url(); ?>/template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>/template/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url(); ?>/template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/template/dist/js/adminlte.min.js"></script>
<script>
  function bacaGambar(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#gambar_load').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $('#preview_gambar').change(function() {
    bacaGambar(this);
  });
</script>

<!-- Page specific script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "paging": true,
      "responsive": true,
      "lengthChange": true,
      "searching": true,
      "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>
<script>
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Barang Berhasil Ditambahkan Kekeranjang!'
      })
    });
  });
</script>
</body>

</html>
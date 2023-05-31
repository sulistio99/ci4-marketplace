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

  <title>Admin | E-Marketplace</title>
  <script src="https://kit.fontawesome.com/11577a6fdb.js" crossorigin="anonymous"></script>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <?php
  $db = \Config\Database::connect();
  $totalkonfirmasitransaksi = $db->table('tb_konfirm_transaksi')
    ->countAll();
  $totalbuktipembayaran = $db->table('tb_bukti_transaksi')
    ->countAll();
  $totalbuktipengiriman = $db->table('tb_bukti_pengiriman')
    ->countAll();
  ?>
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href=""><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block fs-2">
          <b><a href="<?= base_url('Admin'); ?>" class="nav-link">E-Marketplace</a></b>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('auth/LogOutAdmin'); ?>">
            <i class="fas fa-sign-out-alt"></i> LOGOUT
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url('Admin'); ?>" class="brand-link">
        <img src="<?= base_url('foto/logo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">E-MARKETPLACE</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url('foto/' . session('foto')); ?>" class="img-circle elevation-2">
          </div>
          <div class="info">
            <a href="" class="d-block"><?= session('nama_admin'); ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?= base_url('Admin'); ?>" class="nav-link <?= $menu == 'dashboardadmin' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('Admin/KelolaUser'); ?>" class="nav-link <?= $menu == 'kelolauser' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Kelola User
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
                  <a href="<?= base_url('Barang'); ?>" class="nav-link <?= $submenu == 'daftarbarang' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Daftar Barang</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('Kategori'); ?>" class="nav-link <?= $submenu == 'kategori' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kategori</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview <?= $menu == 'kelolatransaksi' ? 'menu-open' : '' ?>">
              <a href="" class="nav-link <?= $menu == 'kelolatransaksi' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-handshake"></i>
                <p>
                  Kelola Transaksi
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('Admin/KonfirmasiTransaksi'); ?>" class="nav-link <?= $submenu == 'konfirmasitransaksi' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Konfirmasi Transaksi <span class="badge badge-primary"><?= $totalkonfirmasitransaksi; ?></p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('Admin/BuktiPembayaran'); ?>" class="nav-link <?= $submenu == 'buktipembayaran' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bukti Pembayaran <span class="badge badge-primary"><?= $totalbuktipembayaran; ?></p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('Admin/BuktiPengiriman'); ?>" class="nav-link <?= $submenu == 'buktipengiriman' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bukti Pengiriman <span class="badge badge-primary"><?= $totalbuktipengiriman; ?></p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('Admin/RiwayatTransaksi'); ?>" class="nav-link <?= $menu == 'riwayattransaksi' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-history"></i>
                <p>
                  Riwayat Transaksi
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <?php if ($page) {
              echo view($page);
            } ?>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer text-center">
      <!-- Default to the left -->
      <strong>Copyright &copy; 2018-2022 <a href="<?= base_url(); ?>">Admin-Marketplace</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="<?= base_url(); ?>/template/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url(); ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
</body>

</html>
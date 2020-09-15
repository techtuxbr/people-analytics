<?php
    session_start();
    require_once("../services/company.php");


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $companies = getCompanies();
        echo json_encode($companies);
        exit;
        //return $companies;
    }
    
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>People Analytics | Painel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php require("../ui/admin/navbar.php") ?>

  <?php require("../ui/admin/sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Empresas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-2"></div>
          <div class="col-8">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Busque uma empresa pelo nome ou e-mail dela.">
            </div>
            
          </div>
          <div class="col-1">
            <button type="button" class="btn btn-block btn-primary">Buscar</button>
          </div>
        </div>
        <div class="row">
          <div class="col-3"></div>
          <div class="col-6">
          <div id="companies">
          </div>
          </div>
        </div>


        
        <div class="card card-widget widget-user-2" id="companyPrefab" style="display: none;">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-success">
                <div class="widget-user-image">
                   <img class="img-circle elevation-2" src="../img/w4ticon.png" alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username companyName">Empresa</h3>
                <h5 class="widget-user-desc bnumber">CNPJ</h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <span class="nav-link">
                      <div>Responsável: <span class="responsible"></span></div>
                    </span>
                  </li>
                  <li class="nav-item">
                    <span class="nav-link">
                      <div>E-mail: <span class="email"></span></div>
                    </span>
                  </li>
                  <li class="nav-item">
                    <span class="nav-link">
                      <div>Créditos: <span class="credits badge bg-success">199</span></div>
                    </span>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link btn btn-block btn-primary">
                      Detalhes
                    </a>
                  </li>
                </ul>
              </div>
            </div>


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<script>
  $(document).ready(function(){

    var companyPrefab = $("#companyPrefab");
    var companiesDiv = $("#companies");
    

    $.post( "companies.php", function( data ) {

      data = JSON.parse(data);
      
      data.forEach(company => {
        var companyComponent = $(companyPrefab).clone();
        $(companyComponent).removeAttr("id");
        $(companyComponent).removeAttr("style");

        $(companyComponent).find(".companyName").html(company.name);
        $(companyComponent).find(".bnumber").html(company.bnumber);
        $(companyComponent).find(".responsible").html(company.responsible);
        $(companyComponent).find(".email").html(company.email);
        $(companyComponent).find(".credits").html(company.credits);
        




        $(companyComponent).appendTo(companiesDiv);
      });
    });
  });
</script>
</body>
</html>

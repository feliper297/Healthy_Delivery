<?php
 @session_start();
 include_once("../conexao.php");

if($_SESSION['nivel_usuario'] != 'Admin'){
    echo "<script language='javascript'>window.location='../login.php'; </script>";
}

//ESTRUTURA DO MENU
$item1 = 'home';
$item2 = 'produtos';
$item3 = 'categorias';
$item4 = 'balconistas';
$item5 = 'locais';

//CLASSE PARA OS ITENS ATIVOS
if(@$_GET['acao'] == $item1){
          $item1ativo = 'active';
        }else if(@$_GET['acao'] == $item2){
          $item2ativo = 'active';
        }else if(@$_GET['acao'] == $item3){
          $item3ativo = 'active';
        }
           else if(@$_GET['acao'] == $item4){
          $item4ativo = 'active';
        }
        else if(@$_GET['acao'] == $item5){
          $item5ativo = 'active';
        }

 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Painel do Administrador</title>

 <link rel="icon" href="../images/favicon-nova.ico" type="image/x-icon">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <link href="dist/css/painel.css" rel="stylesheet">



   
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>

 

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php?acao=<?php echo $item1 ?>" class="nav-link <?php echo $item1ativo ?>">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php?acao=<?php echo $item2 ?>" class="nav-link <?php echo $item2ativo ?>">Produtos</a>
      </li>

        <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php?acao=<?php echo $item3 ?>" class="nav-link <?php echo $item3ativo ?>">Categorias</a>
      </li>

       <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php?acao=<?php echo $item4 ?>" class="nav-link <?php echo $item4ativo ?>">Balconistas</a>
      </li>

           <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php?acao=<?php echo $item5 ?>" class="nav-link <?php echo $item5ativo ?>">Locais</a>
      </li>

    </ul>

   

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <?php echo $_SESSION['nome_usuario'] ?>
          <i class="fas fa-sign-out-alt ml-1"></i>
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">

            <!-- Message Start -->
            <div class="media">
              <img src="../images/usuario-icone.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?php echo $_SESSION['nome_usuario'] ?>
                  <span class="float-right text-sm text-danger"><i class="fas fa-star text-success"></i></span>
                </h3>
                 <small><?php echo $_SESSION['email_usuario'] ?></small>
               
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="../logout.php" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../images/logout.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Sair do Site
                  <span class="float-right text-sm text-muted"><i class="fas fa-star text-danger"></i></span>
                </h3>
                <p class="text-sm">Voltar para o Login</p>
                
              </div>
            </div>
            <!-- Message End -->
          </a>
         
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
     
      <span class="brand-text font-weight-light ml-4">Painel Administrativo</span>
   
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../images/usuario-icone-claro.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> <?php echo $_SESSION['nome_usuario'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item ">
            <a href="index.php?acao=<?php echo $item1 ?>" class="nav-link <?php echo $item1ativo ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
                
              </p>
            </a>
          </li>



          <li class="nav-item">
            <a href="index.php?acao=<?php echo $item2 ?>" class="nav-link <?php echo $item2ativo ?>">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Produtos
                
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="index.php?acao=<?php echo $item3 ?>" class="nav-link <?php echo $item3ativo ?>">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Categorias
                
              </p>
            </a>
          </li>


         
          
  <li class="nav-item">
            <a href="index.php?acao=<?php echo $item4 ?>" class="nav-link <?php echo $item4ativo ?>">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Balconistas
                
              </p>
            </a>
          </li>
         
  <li class="nav-item">
            <a href="index.php?acao=<?php echo $item5 ?>" class="nav-link <?php echo $item5ativo ?>">
              <i class="nav-icon fas fa-city"></i>
              <p>
                Locais
                
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
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


       <!-- /.Chamadas dos Includes das páginas -->
       <?php 
        if(@$_GET['acao'] == $item1){
          include_once($item1.'.php');
        }else if(@$_GET['acao'] == $item2){
          include_once($item2.'.php');
        }else if(@$_GET['acao'] == $item3){
          include_once($item3.'.php');
        }
      else if(@$_GET['acao'] == $item4){
          include_once($item4.'.php');
        }
         else if(@$_GET['acao'] == $item5){
          include_once($item5.'.php');
        }


        else{
          include_once($item1.'.php');
        }
        ?>
        

   
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
 
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->








</body>
</html>

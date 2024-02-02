<?php
    session_start();
    include "head.php";
?>


<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

 <?php
    include "menusuperior.php";
    include "menuprincipal.php";
    //include "rotas.php";
 ?>
 



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
<?php
  include "rotas.php";
?>


    
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

</body>



<?php
    include "footer.php";
?>
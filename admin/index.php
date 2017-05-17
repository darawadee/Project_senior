<?php 
  session_start();
  
  if($_SESSION['data_user']['user_type'] != '3'){
    echo "not found page";
    die();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="../lib/css/sweetalert2.min.css">
    
    <title>Vali Admin</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
  </head>
  <body class="sidebar-mini fixed">
    <div class="wrapper">
      <!-- Navbar-->
      <header class="main-header hidden-print"><a class="logo" href="#">Admin</a>
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button--><a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
          <!-- Navbar Right Menu-->
          <div class="navbar-custom-menu">
            <ul class="top-nav">
              <!--Notification Menu-->
             
              <!-- User Menu-->
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu">
                  <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i>หน้าหลัก</a></li>
                  <li><a href="../login_from.html"><i class="fa fa-sign-out fa-lg"></i>ออกจากระบบ</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Side-Nav-->
      <aside class="main-sidebar hidden-print">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
                    <img class="img-circle" src="../img/bs.png" alt="User Image">
             </div>
            <div class="pull-left info">
              <p>ระบบบริหารจัดการ</p>
              <p class="designation">อุปกรณ์กีฬาโรงเรียนสาธิต</p>
            </div>
          </div>
          <!-- Sidebar Menu-->
          <ul class="sidebar-menu">
            <li class="active"><a href="#" id="btn-dashbroad"><i class="fa fa-dashboard"></i><span>ระบบสรุปรายงาน</span></a></li>
            <li class="treeview"><a href="#"><i class="fa fa-laptop"></i><span>ระบบจัดการ</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="#" id='btn-item-manager'><i class="fa fa-circle-o"></i> จัดการอุปกรณ์กีฬา</a></li>
                <li><a href="#" id='btn-usermanager'><i class="fa fa-circle-o"></i> จัดการข้อมูลสมาชิก</a></li>
                <li><a href="#" id='btn-br-manager'><i class="fa fa-circle-o"></i> อัพเดทสถานะยืม/คืนอุปกรณ์กีฬา</a></li>
              </ul>
            </li>
            <li class="treeview"><a href="#" id="btn-request"><i class="fa fa-commenting" aria-hidden="true"></i><span>รายการคำร้อง</span><i class="fa fa-angle-right"></i></a>
            </li>
              </ul>
            </li>
          </ul>
        </section>
      </aside>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-dashboard"></i> รายงานข้อมูล</h1>
          </div>
          <!-- <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
            </ul>
          </div> -->
        </div>
        <div class="row">
          <div class="col-md-12" >
            <div class="card" >
              <div id="content" style="height: auto;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Javascripts-->
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/pace.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="../lib/js/sweetalert2.min.js"></script>
    <script type="text/javascript" src="js/highcharts.js"></script>
    <script type="text/javascript" src="js/highcharts-3d.js"></script>

   
  </body>
</html>
<script type="text/javascript">
$(function(){
  $("#btn-dashbroad").click(function(event) {
    get_dashbord();
  });
  $("#btn-usermanager").click(function(event) {
      get_user_manager();
      //alert(444);
  });
  $("#btn-item-manager").click(function(event) {
    get_item_manager();
  });

  $("#btn-br-manager").click(function(event) {
      // alert("รายการ");
     get_table_list();
  });

  $("#btn-request").click(function(event) {
    get_read_request();
  });
  
   get_dashbord();

});




function get_table_list(){
     $.get('../service/show_list_br.php', function() {
          /*optional stuff to do after success */
        }).done(function(data){
          $("#content").html(data);

        });
  }

function get_user_manager(){
  $.get('../manager_user.php', function() {
    /*optional stuff to do after success */
  }).done(function(data){
    $("#content").html(data);
  });
}

function get_read_request(){
  $.get('service_admin/read_request_table.php', function(data) {
    /*optional stuff to do after success */
  }).done(function(data){
    $("#content").html(data);
  });
}
function get_item_manager(){
  /* Act on the event */
  $.get('../manager.php', function() {
  /*optional stuff to do after success */

  }).done(function(data){
    $("#content").html(data);

  });

}
function get_dashbord(){
  $.get('report/dashbord.php', function() {
    
  }).done(function(data){
      $("#content").html(data);
  });
}


  



</script>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title><?php echo $titlePage;?> | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>asset/admins/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url()?>asset/admins/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Datatables-->
    <link href="<?php echo base_url()?>asset/admins/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>asset/admins/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>asset/admins/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>asset/admins/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>asset/admins/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url()?>asset/admins/build/css/custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>asset/admins/css/style.css" rel="stylesheet">

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url()?>" class="site_title"><i class="fa fa-paw"></i> <span>Freelancer Việt Nam</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url();?>asset/users/images/artistry.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['user']['name'];?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo base_url()?>admin"><i class="fa fa-home"></i> Home </a>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Managers <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url()?>manager-news">Quản lý tin tức</a></li>
                      <li><a href="<?php echo base_url()?>manager-category">Quản lý thể loại</a></li>
                     
                      <li><a href="<?php echo base_url()?>manager-users">Quản lý user</a></li>
                      
                      <li><a href="<?php echo base_url()?>manager-comments">Quản lý bình luận</a></li>
                      <li><a href="<?php echo base_url()?>manager-userroles">Quản lý quyền user</a></li>
                      
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="#" alt=""><?php echo $_SESSION['user']['name'];?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    
                    
                    <li><a href="<?php echo base_url()?>authentication/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div id="content">
            <?php $this->load->view($subview);?>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Copyright © 2018 freelancerViet Co., Ltd. All Rights Reserved
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    
    
    <script src="<?php echo base_url()?>asset/admins/vendors/jquery/dist/jquery.min.js"></script>

    <script src="<?php echo base_url()?>asset/bootstrap/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url()?>asset/admins/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <!-- Datatables-->
    <script src="<?php echo base_url()?>asset/admins/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>asset/admins/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>asset/admins/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url()?>asset/admins/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>asset/admins/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url()?>asset/admins/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url()?>asset/admins/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url()?>asset/admins/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url()?>asset/admins/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url()?>asset/admins/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url()?>asset/admins/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url()?>asset/admins/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url()?>asset/admins/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url()?>asset/admins/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url()?>asset/admins/vendors/pdfmake/build/vfs_fonts.js"></script>

    <script src="<?php echo base_url()?>asset/bootstrap/js/jquery.shorten.1.0.js"></script>
    <script src="<?php echo base_url()?>asset/bootstrap/js/colResizable-1.6.min.js"></script>


    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url()?>asset/admins/build/js/custom.min.js"></script>
    <script src="<?php echo base_url()?>asset/admins/ckeditor/ckeditor.js"></script>
    
    
    <script type="text/javascript">
      $(document).ready(function(){
        $('#datatable-responsive').DataTable();
      });
    </script>

    <script type="text/javascript">
       $(".rutgon").shorten({
        "showChars" : 20,
        "moreText"  : "...",
        "lessText"  : "Rút gọn",
    });
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $("table").colResizable({resizeMode:'overflow'});
      });
    </script>
    
  </body>
</html>

<script type="text/javascript">
  $(function() {                        
    var editor = CKEDITOR.replace('news-content',
    {
    filebrowserBrowseUrl : '<?php echo base_url()."asset/admins/ckfinder/ckfinder.html"; ?>',
    filebrowserImageBrowseUrl : '<?php echo base_url()."asset/admins/ckfinder/ckfinder.html?Type=Images";?>',
    filebrowserFlashBrowseUrl : '<?php echo base_url()."asset/admins/ckfinder/ckfinder.html?Type=Flash" ?>',
    filebrowserUploadUrl : '<?php echo base_url()."asset/admins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files"?>',
    filebrowserImageUploadUrl : '<?php echo base_url()."asset/admins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images";?>',
    filebrowserFlashUploadUrl : '<?php echo base_url()."ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash";?>',
    filebrowserWindowWidth : '800',
    filebrowserWindowHeight : '480'
    });
    CKFinder.setupCKEditor( editor, "<?php echo base_url().'asset/admins/ckfinder/'?>" );
  });
</script>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="<?php echo base_url();?>asset/bootstrap/css/bootstrap.min.CSS" >
    <link rel="stylesheet" href="<?php echo base_url();?>asset/users/css/style.css" >
    <link rel="stylesheet" href="<?php echo base_url();?>asset/admins/vendors/font-awesome/css/font-awesome.min.css" >

    <title><?php echo $titlePage; ?></title>
  </head>
  <body class>
    <div id="main">
      <header id="header" class="fixed-top ">
        <div class="container">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"><img class="navbar-brand-normal" src="<?php echo base_url()?>asset/users/images/logo-2.png" alt="freelancerViet"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo base_url()?>blog-ky-nang.html">Home <span class="sr-only">(current)</span></a>
                </li>

                <?php  $i=0; foreach ($listTheloai as $cats)
                {
                  if($i<4)
                  {


                ?>
                  <li class="nav-item ">
                  <a class="nav-link" href="<?php echo base_url()?>blog-ky-nang/<?php echo $cats['slug_theloai']?>.html"><?php echo $cats['name'];?></a>
                  </li>
                <?php 
              
               $i++;} }
                ?>
                
                <li class="nav-item dropdown" id='menu-danhmuc'>
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    More
                  </a>

                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php $i=0; foreach ($listTheloai as $cats){
                      
                      if($i>=4){
                    ?>
                    <a class="dropdown-item" href="<?php echo base_url()?>blog-ky-nang/<?php echo $cats['slug_theloai']?>.html"><?php echo $cats['name'];?></a>
                    <div class="dropdown-divider"></div>
                    <?php  }$i++;}?>
                  </div>
                </li>
                
                </ul>
              </ul>
              <form action="<?php echo base_url();?>blog-ky-nang/timkiem" class="form-inline my-2 my-lg-0" method="post">
                <input class="form-control mr-sm-2" type="search" name ='noidung' placeholder="Search" aria-label="Search">
              </form>
              <ul class='navbar-nav ml-auto'>
              <?php if(isset($_SESSION['user'])) {?>
                
                  <li class='nav-item dropdown'>
                      <a class="nav-link dropdown-toggle user-profile" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <?php echo $_SESSION['user']['name'];?>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <?php if($_SESSION['user']['level'] != 2) { ?>
                      <a class="dropdown-item user-profile" href="<?php echo base_url()?>admin">Admin</a>
                      <?php }?>
                      <a class="dropdown-item user-profile" href="<?php echo base_url()?>authentication/logout">Logout<i class="fa fa-sign-out pull-right"></i></a>
                  </li>
                  <?php } else {?>
                  <li class="nav-item">
                    <a class="nav-link user-profile" href='<?php echo base_url()?>login.html'>Login</a>
                  </li>
                  <?php }?>
                </ul>

              
              
            </div>
          </nav>
        </div>
      </header>    
      <!-- Content-->
      <div id="content">
        
        <?php $this->load->view($subview); ?>
      </div>
      <!-- End Content-->
      <footer id="footer">
        <div class="footer-content">
          <div class="container">
            <div class="row">
              <div class="col-lg-3">
                <div class="about-footer">
                  <img src="https://fvstaticws.freelancerviet.vn/fv3templates/default/images/logo-2.png" alt="">
                  <div class="socials">
                    <a target="_blank" href="https://www.facebook.com/FreelancerViet"><ion-icon name="logo-facebook"></ion-icon>
                    </a>
                    <a target="_blank" href="https://plus.google.com/u/5/+freelancervietvncongdong"><ion-icon name="logo-googleplus"></ion-icon></a>
                    <a target="_blank" href="https://twitter.com/freelancerViet"><ion-icon name="logo-twitter"></ion-icon></a>
                  </div>
                  <img src="https://fvstaticws.freelancerviet.vn/fv3templates/default/images/bct.png" alt="">
                </div>
              </div>
              <div class="col-lg-9">
                <div class="row">
                  <div class="col-lg-3 col-md-6">
                    <div class="block-menu">
                      <h3>Công ty</h3>
                      <ul class="list-unstyled">
                        <li>
                          <a href="#">Về chúng tôi</a>
                        </li>
                        <li>
                          <a href="#">Vinh danh trên báo chí</a>
                        </li>
                        <li>
                          <a href="#">Đối tác</a>
                        </li>
                        <li>
                          <a href="<?php echo base_url()?>blog-ky-nang.html">Tin tức cộng đồng</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <div class="block-menu">
                      <h3>Khách hàng</h3>
                      <ul class="list-unstyled">
                        <li>
                          <a href="#">Đăng việc</a>
                        </li>
                        <li>
                          <a href="#">Tìm freelancer</a>
                        </li>
                        <li>
                          <a href="#">Dịch vụ trọn gói</a>
                        </li>
                        <li>
                          <a href="#">Bảng giá</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <div class="block-menu">
                      <h3>Freelancer</h3>
                      <ul class="list-unstyled">
                        <li>
                          <a href="<?php echo base_url()?>register.html">Đăng ký</a>
                        </li>
                        <li>
                          <a href="#">Tìm việc</a>
                        </li>
                        <li>
                          <a href="#">Bảng giá</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <div class="block-menu">
                      <h3>Trợ giúp</h3>
                      <ul class="list-unstyled">
                        <li>
                          <a href="#">Trợ giúp</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="copyright">
          <div class="container">
            Copyright © 2018 freelancerViet Co., Ltd. All Rights Reserved.
            <div class="links">
              <a href="#">Điều khoản sử dụng</a>
              <span class="">|</span>
              <a href="#">Chính sách bảo mật</a>
            </div>
          </div>
        </div>
      </footer>

      <div class="modal modal-default modal-flat modal-notification fade modal-animation" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification-label">
        <div class="modal-dialog h-100 d-flex flex-column justify-content-center my-0 animated" data-animate-show="fadeIn" data-animate-hide="fadeOut" role="document">
          <div class="modal-content">
            <div class="modal-body" role="tablist">
              <div class="box box-notification">
                <div class="content">
                  <div class="icon">
                    <img src="https://fvstaticws.freelancerviet.vn/fv3templates/default/images/icon-alarm-80.png" alt="">
                  </div>
                  <div class="info">
                    <p class="heading ">Bạn muốn nhận tức thì các thông tin mới nhất từ freelancerViet?</p>
                    <div class="text-right">
                      <a href="#" onclick="return cancel_subscribe(this);" class="btn btn-link text-primary">TỪ CHỐI</a>
                      <a href="#" onclick="return subscribe(this);" class="btn btn-primary ml-2">ĐỒNG Ý</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- modal-content -->
        </div><!-- modal-dialog -->
      </div> 
    </div>

  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="<?php echo base_url();?>asset/bootstrap/js/jquery-3.3.1.min.js" ></script>
    <script src="<?php echo base_url();?>asset/bootstrap/js/popper.min.js" ></script>
    <script src="<?php echo base_url();?>asset/bootstrap/js/bootstrap.min.js" ></script>

    <script src="https://unpkg.com/ionicons@4.2.6/dist/ionicons.js"></script>

    <!-- Khởi tạo-->
    <script type="text/javascript">
      $(document).ready(function(){
        $('.page-item a').addClass('page-link');

        $('#btn-comment').click(function(){
          $('#comment-erros').html("");
        });
      });
    </script>

    <!-- Gửi bình luận-->
    <script type="text/javascript">
      $(document).ready(function(){
        $('#comment-submit').click(function(event){
          event.preventDefault();
          var user = $('#recipient-name').val();
          var comment = $('#message-text').val();
          var idtin = $('#idtin').val();
          $('#recipient-name').val('');
          $('#message-text').val('');


          if(!user||!comment)
          {
            $('#recipient-name').val(user);
            $('#message-text').val(comment);
            $('#comment-erros').html('<div class="alert alert-danger">Tên và nội dung không được bỏ trống</div>');
          }
          else
          {
            $('#commentModal').modal('hide');
            $.post('<?php echo base_url('tintuc/comment'); ?>',{user:user,comment:comment,idtin:idtin},function(data){
                // alert('them thành công');
                data = JSON.parse(data)

                content = "";
                for (var i=0;i<data.length;i++)
                { 
                  content += "<div class='container'><div class='row'><div class='col-lg-12'><span class='comment-name-user'>"+data[i]['name_user']+"</span><span class='comment-datetime'>"+data[i]['time_comment']+"</span></div><div class='col-lg-12 comment-content'><span>"+data[i]['content_comment']+"</span></div></div></div><div class='dropdown-divider'></div>";
                }
                $('#comment-list-child').html(content);
            });
          }
        });
      });
    </script>

    <!-- Ẩn hiện menu khi cuộn trang-->
    <script type="text/javascript">
      $(document).ready(function() {
          var lastScrollTop = 0;
          $(window).scroll(function() {
              var currentScrollTop = $(this).scrollTop();
              if (currentScrollTop < lastScrollTop) 
              {
                  $('#header').removeClass('nav-up').addClass('nav-down');
              } 
              else 
              {
                   $('#header').removeClass('nav-down').addClass('nav-up');
              }
              lastScrollTop = currentScrollTop;
          });
      });
    </script>

    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>

  
  </body>
</html>
<section class="section-main section-register bg-gray">
    <div class="container">
        <div class="auth m-auto">
            <h1 class="page-title mb-4">Đăng nhập</h1>
            <?php 
                      if(isset($mess) &&  $mess!='')
                      {
                          echo $mess;
                      }
            ?>
            <?php if(isset($b_Check) && $b_Check == false){ ?> <?php echo "<div class='alert alert-danger'>Tài khoản không đúng. Xin vui lòng đăng nhập lại !</div>"; }?>
            <form action="<?php echo base_url();?>authentication/checklogin" class="form form-auth form-validate form-ajax needs-validation" method="post" novalidate>
                <div class="form-group ">
                    <label class="form-control-label">Tên tài khoản</label>
                    <input type="text" name="login-name" value="" id="login-name" class="form-control required" data-validate-hide-message="1" data-rule-required="true" data-rule-email="true" required="true" label="Email" aria-required="true">
                </div>
                <div class="form-group ">
                    <label class="form-control-label">Mật khẩu</label>
                    <input type="password" name="login-password" value="" id="login-password" class="form-control required" data-validate-hide-message="1" data-rule-required="true" required="true" label="Mật khẩu" aria-required="true">
                </div>
                <div class="form-button">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-lg btn-primary btn-block" data-loading-text="<i class='fa fa-spinner fa-spin'></i> ĐĂNG NHẬP" id='btn-login'>ĐĂNG NHẬP</button>
                        </div>
                        
                    </div>
                </div>
                
                <p class="form-helper last">
                    Bạn chưa có tài khoản? <a href="<?php echo base_url()?>register.html" class="text-primary">Đăng ký</a>
                </p>
                <input type="hidden" name="redirect" value="dHJhbmctY2h1" id="redirect">
                <input type="hidden" name="_token" value="7c655ca022ad52880542b9f2e20370b2">
            </form>
        </div>
    </div>
</section>

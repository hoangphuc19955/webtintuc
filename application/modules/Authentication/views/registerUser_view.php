<section class="section-main section-register bg-gray">
    <div class="container">
        <div class="auth m-auto">
            <h1 class="page-title mb-4">Đăng ký</h1>
            
            <?php if(validation_errors() !=''){?>
                    <div class='alert alert-danger'><?php echo validation_errors(); ?></div>
                    <?php }?>
            <form action="<?php echo base_url();?>authentication/checkregister" class="form form-auth form-validate form-ajax needs-validation" method="post" novalidate>
                <div class="form-group ">
                    <label class="form-control-label">Tên tài khoản</label><span class="required">*</span>
                    <input type="text" name="register-username" value="" id="register-username" class="form-control required" data-validate-hide-message="1" data-rule-required="true" data-rule-email="true" required="true" label="Email" aria-required="true">
                </div>
                <div class="form-group ">
                    <label class="form-control-label">Mật khẩu</label><span class="required">*</span>
                    <input type="password" name="register-password" value="" id="register-password" class="form-control required" data-validate-hide-message="1" data-rule-required="true" required="true" label="Mật khẩu" aria-required="true">
                </div>
                <div class="form-group ">
                    <label class="form-control-label">Nhập lại mật khẩu</label><span class="required">*</span>
                    <input type="password" name="register-repassword" value="" id="register-password" class="form-control required" data-validate-hide-message="1" data-rule-required="true" required="true" label="Mật khẩu" aria-required="true">
                </div>
                <div class="form-group ">
                    <label class="form-control-label">Email</label><span class="required">*</span>
                    <input type="text" name="register-email" value="" id="register-email" class="form-control required" data-validate-hide-message="1" data-rule-required="true" data-rule-email="true" required="true" label="Email" aria-required="true">
                </div>
                <div class="form-group ">
                    <label class="form-control-label">Tên</label><span class="required">*</span>
                    <input type="text" name="register-name" value="" id="register-name" class="form-control required" data-validate-hide-message="1" data-rule-required="true" data-rule-email="true" required="true" label="Email" aria-required="true">
                </div>
                <div class="form-button">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-lg btn-primary btn-block" data-loading-text="<i class='fa fa-spinner fa-spin'></i> ĐĂNG NHẬP" id='btn-login'>ĐĂNG KÝ</button>
                        </div>
                        
                    </div>
                </div>
                
                <p class="form-helper last">
                    Bạn đã có tài khoản? <a href="<?php echo base_url()?>login.html" class="text-primary">Đăng nhập</a>
                </p>
                <input type="hidden" name="redirect" value="dHJhbmctY2h1" id="redirect">
                <input type="hidden" name="_token" value="7c655ca022ad52880542b9f2e20370b2">
            </form>
        </div>
    </div>
</section>

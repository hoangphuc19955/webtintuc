
            <div class="page-title">
              <div class="title_left">
                <h3>Quản lý User</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update Users </h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php if(validation_errors() !=''){?>
                    <div class='alert alert-danger'><?php echo validation_errors(); ?></div>
                    <?php }?>
                    <form action='<?php echo base_url();?>manager-users/update/<?php echo $user['id_user'];?>' method='POST'data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" ">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name='user-name'  class="form-control col-md-7 col-xs-12" value="<?php echo $user['username'];?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" ">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" name='user-password'  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" ">RePassword <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" name='user-repassword'  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" ">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name='user-email'  class="form-control col-md-7 col-xs-12" value="<?php echo $user['email'];?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" ">Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name='user-appellation'  class="form-control col-md-7 col-xs-12" value="<?php echo $user['name'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Level<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="level" name='user-level' class="form-control" required>
                            <?php foreach($userrole as $role) { 
                              if($role['id_user_role'] == $user['level']) {
                            ?>
                            <option value="<?php echo $role['id_user_role'];?>" selected><?php echo $role['role_name'];?></option>
                            <?php }else {?>
                            
                            <option value="<?php echo $role['id_user_role'];?>"><?php echo $role['role_name'];?></option>
                            <?php }}?>
                          </select>
                        </div>
                      </div>
                      
                                                   
                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="<?php echo base_url()?>manager-users" class="btn btn-primary" type="button">Cancel</a>
						              
                          <button type="submit" name='category-submit' class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

         

            
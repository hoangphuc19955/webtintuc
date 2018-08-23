
            <div class="page-title">
              <div class="title_left">
                <h3>Quản lý Userrole</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Grant Right Userroles </h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php if(validation_errors() !=''){?>
                    <div class='alert alert-danger'><?php echo validation_errors(); ?></div>
                    <?php }?>
                    <form action='<?php echo base_url();?>manager-userroles/update/<?php echo $userrole['id_user_role'];?>' method='POST'data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" ">Role Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name='role-name' required="required" value='<?php echo $userrole['role_name'];?>' class="form-control col-md-7 col-xs-12" >
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" ">Permission <span class="required">*</span>
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <ul style="list-style-type: none;">
                          <?php foreach($listPermission as $permissions) { if($permissions['checked'] == 'checked') {?>
                            <li><input type="checkbox" name="permissions[]" value="<?php echo $permissions['id_user_permission']?>"  checked/> <?php echo $permissions['permission_name'];?>
                            </li>
                          <?php } else { ?>
                            <li><input type="checkbox" name="permissions[]" value="<?php echo $permissions['id_user_permission']?>"  /> <?php echo $permissions['permission_name'];?>
                            </li>

                          <?php }  } ?>
                          </ul>
                        </div>
                        
                      </div>
                      
                                       
                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="<?php echo base_url()?>manager-userroles" class="btn btn-primary" type="button">Cancel</a>
                          <button type="submit" name='category-submit' class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

         

            

            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $titlePage;?></h3>
              </div>

              
            </div>

            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List Users</h2>
                    <div class="fa-hover col-md-3 col-sm-4 col-xs-12 text-right" style="float: right">
                      <a href="<?php echo base_url()?>manager-users/add" style="font-size: 20px;"><i class="fa fa-plus"></i> Add User</a>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <?php 
                      if(isset($mess) &&  $mess!='')
                      {
                          echo $mess;
                      }
                    ?>
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th class='text-center'>Id</th>
                          <th class='text-center'>Username</th>
                          <th class='text-center'>Email</th>
                          <th class='text-center'>Name</th>
                          <th class='text-center'>Level</th>
                          
                          <th class='text-center'>Updated</th>
                          <th class='text-center'>Deleted</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php foreach($listUsers as $users) {?>
                        <tr>
                          <td class='text-center'><?php echo $users['id_user'];?></td>
                          <td class="text-center"><?php echo $users['username'];?></td>
                          <td class="text-center"><?php echo $users['email'];?></td>
                          <td class='text-center'><?php echo $users['name'];?></td>
                          <?php foreach($listUserroles as $role) { if($role['id_user_role'] == $users['level']){?>
                          <td class='text-center'><?php echo $role['role_name'];?></td>
                          <?php }}?>
                          
                          <td class='text-center'><a href="<?php echo base_url();?>manager-users/update/<?php echo $users['id_user'];?>"  style="font-size: 20px;"><i class="fa fa-edit" ></i> </a></td>
                          <td class='text-center'><a href="<?php echo base_url();?>manager-users/delete/<?php echo $users['id_user'];?>" style="font-size: 20px;"><i class="fa fa-close"></i></a></td>
                        </tr>
                    	<?php }?>
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>
            </div>
         
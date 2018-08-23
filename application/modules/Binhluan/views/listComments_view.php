
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
                    <h2>List Comments</h2>
                    
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
                          <th class='text-center'>Content</th>
                          <th class='text-center'>Name_User</th>
                          
                          <th class='text-center'>Datetime</th>
                          <th class='text-center'>Id_Tin</th>
                          <th class='text-center'>Id_User</th>
                          
                          <th class='text-center'>Deleted</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php foreach($listComments as $comments) {?>
                        <tr>
                          <td class='text text-center'><span><?php echo $comments['id_comment'];?></span></td>
                          <td class="text text-center"><span><?php echo $comments['content_comment'];?></span></td>
                          <td class="text text-center"><span><?php echo $comments['name_user'];?></span></td>
                          
                          <td class='text text-center'><span><?php echo $comments['time_comment'];?></span></td>
                          <td class='text text-center'><span><?php echo $comments['id_tin'];?></span></td>
                          <td class='text text-center'><span><?php echo $comments['id_user'];?></span></td>
                          
                          <td class='text-center'><a href="<?php echo base_url();?>manager-comments/delete/<?php echo $comments['id_comment'];?>" style="font-size: 20px;"><i class="fa fa-close"></i></a></td>
                        </tr>
                    	<?php }?>
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>
            </div>
         
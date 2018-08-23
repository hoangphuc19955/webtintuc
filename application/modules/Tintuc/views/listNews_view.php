
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $titlePage;?></h3>
              </div>

              
            </div>

            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title ">
                    <h2>List News</h2>
                    <div class="fa-hover col-md-3 col-sm-4 col-xs-12 text-right" style="float: right">
                      <a href="<?php echo base_url()?>manager-news/add" style="font-size: 20px;"><i class="fa fa-plus"></i> Add News</a>
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
                        <tr >
                          <th class='text-center'>Id</th>
                          <th class='text-center'>Title</th>
                          <th class='text-center'>Image</th>
                          <th class='text-center'>Datetime</th>
                          <th class='text-center'>Datetime_last</th>
                          <th class='text-center'>Id_user</th>
                          <th class='text-center'>Edit_last</th>
                          <th class='text-center'>Edit</th>
                          <th class='text-center'>Deleted</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php foreach($listNews as $news) {?>
                        <tr >
                          <td class='text align-middle'><span><?php echo $news['id'];?></span></td>
                          <td class="text align-middle"><span><?php echo $news['title'];?></span></td>
                          <td class="text align-middle"><span><img src="<?php echo base_url();?>asset/users/images/small/<?php echo $news['urlimage']?>" width='100px'></span></td>
                          
                          
                          <td class='text align-middle'><span><?php echo $news['datetime'];?></span></td>
                          <td class='text align-middle'><span><?php echo $news['datetime_last'];?></span></td>
                          <td class='text align-middle'><span><?php echo $news['id_user'];?></span></td>
                          <td class='text align-middle'><span><?php echo $news['id_user_update_last'];?></span></td>
                          <td class='align-middle'><a href="<?php echo base_url();?>manager-news/update/<?php echo $news['id'];?>"  style="font-size: 20px;"><i class="fa fa-edit" ></i> </a></td>
                          <td class='align-middle'><a href="<?php echo base_url();?>manager-news/delete/<?php echo $news['id'];?>" style="font-size: 20px;"><i class="fa fa-close"></i></a></td>
                        </tr>
                    	<?php }?>
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>
            </div>
         
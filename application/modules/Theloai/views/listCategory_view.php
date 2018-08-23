
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
                    <h2>List Category</h2>
                    <div class="fa-hover col-md-3 col-sm-4 col-xs-12 text-right" style="float: right">
                      <a href="<?php echo base_url()?>manager-category/add" style="font-size: 20px;"><i class="fa fa-plus"></i> Add Category</a>
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
                          <th class='text-center'>Name</th>
                          <th class='text-center'>Slug-Category</th>
                          <th class='text-center'>Updated</th>
                          <th class='text-center'>Deleted</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php foreach($listCategory as $cat) {?>
                        <tr>
                          <td class='text-center'><?php echo $cat['id'];?></td>
                          <td class='text-center'><?php echo $cat['name'];?></td>
                          <td class='text-center'><?php echo $cat['slug_theloai'];?></td>
                          <td class='text-center'><a href="<?php echo base_url();?>manager-category/update/<?php echo $cat['id'];?>"  style="font-size: 20px;"><i class="fa fa-edit" ></i> </a></td>
                          <td class='text-center'><a href="<?php echo base_url();?>manager-category/delete/<?php echo $cat['id'];?>" style="font-size: 20px;"><i class="fa fa-close"></i></a></td>
                        </tr>
                    	<?php }?>
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>
            </div>
         
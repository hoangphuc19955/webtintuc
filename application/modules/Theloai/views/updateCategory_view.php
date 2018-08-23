
            <div class="page-title">
              <div class="title_left">
                <h3>Quản lý thể loại</h3>
              </div>

              
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update Category </h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php if(validation_errors() !=''){?>
                    <div class='alert alert-danger'><?php echo validation_errors(); ?></div>
                    <?php }?>
                    <form action='<?php echo base_url();?>manager-category/update/<?php echo $category['id']?>' method='POST'data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name='category-name' required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $category['name']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Slug Name <span class="required" >*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name='category-slug-name' required="required" class="form-control col-md-7 col-xs-12" value='<?php echo $category['slug_theloai']?>'>
                        </div>
                      </div>
                                                   
                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="<?php echo base_url()?>manager-category" class="btn btn-primary" type="button">Cancel</a>
						              
                          <button type="submit" name='category-submit' class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

         

            
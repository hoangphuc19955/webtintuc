
            <div class="page-title">
              <div class="title_left">
                <h3>Quản lý tin tức</h3>
              </div>

              
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update News </h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php if($errors != ""){
                      echo $errors;
                    }?>
                    <?php if(validation_errors() !=''){?>
                    <div class='alert alert-danger'><?php echo validation_errors(); ?></div>
                    <?php }?>
                    <form action='<?php echo base_url();?>manager-news/update/<?php echo $news['id'];?>' method='POST'data-parsley-validate class="form-horizontal form-label-left" enctype='multipart/form-data'>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name='news-title' required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $news['title'];?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Slug Title <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name='news-slug-title' required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $news['slug_tintuc'];?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class="form-control"  name="news-description" ><?php echo $news['description'];?></textarea> 
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Category<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="Category" name='news-category' class="form-control" required>
                            <option value="<?php echo $news['idtheloai'];?>"><?php echo $news['name'];?></option>

                            <?php foreach($listTheloai as $cat) 
                            {
                              if($cat['id'] != $news['idtheloai'])
                              {
                            ?>

                            <option  value="<?php echo $cat['id']?>"><?php echo $cat['name']?></option>
                            <?php }}?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" class='form-control'  name='news-image' value="<?php echo $news['urlimage'];?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                            <div class="x_title">
                              <h2>Content</h2>
                             
                              <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                              <div id="alerts"></div>
                              <textarea class="form-control " id='news-content' name="news-content" ><?php echo $news['content'];?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>             
                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="<?php echo base_url()?>manager-news" class="btn btn-primary" type="button">Cancel</a>
                          <button type="submit" name='news-submit' class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

         

            
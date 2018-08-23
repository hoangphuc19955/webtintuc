
<section class="section-home-banner">
          <div class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100 lazyloaded" data-src="<?php echo base_url()?>asset/users/images/top-banner-10.png" src="<?php echo base_url()?>asset/users/images/top-banner-10.png">
                <div class="caption">
                    <div class="container">
                        <div class="caption-inside m-auto">
                            <h2 class="text-center">Tin tức cộng đồng</h2>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
</section>
<?php if($start_index === 0) {?>
<section class="section-main section-featured-articles">
          <div class="container">
            <ul class="list-featured-articles list-unstyled row">

              <?php foreach ($hotNews as $key=>$value){?>

              <li class="col-lg-4">
                <div class="item">
                  <img width="370" height="263" data-src="<?php echo base_url()?>asset/users/images/small/<?php echo $value['urlimage'];?>" class="img-fluid lazyloaded" alt="" src="<?php echo base_url()?>asset/users/images/small/<?php echo $value['urlimage'];?>">
                  <div class="info">
                    <a class="tag" href="<?php echo base_url()?>blog-ky-nang/<?php echo $value['slug_theloai']?>.html"><?php echo $value['name'];?></a>
                    <a class="title" href="<?php echo base_url()?>blog-ky-nang/<?php echo $value['slug_theloai']?>/<?php echo $value['slug_tintuc']?>.html"><?php echo $value['title'];?></a>
                  </div>
                </div>
              </li>
             <?php }?>
            </ul>
          </div>
</section>
<?php }?>
<section class="section-main section-blog">
          <div class="container">
            <div class="row">
              <div class="col-md-8">
                <ul class="list-blog list-unstyled">
                    <?php foreach ($pageNews as $news) {?>
                    <li>
                      <div class="item">
                        <h3><a href="<?php echo base_url()?>blog-ky-nang/<?php echo $news['slug_theloai']?>/<?php echo $news['slug_tintuc']?>.html"><?php echo $news['title'];?></a></h3>
                        <div class="meta">
                          <a href="<?php echo base_url()?>blog-ky-nang/<?php echo $news['slug_theloai']?>.html"><?php echo mb_strtoupper($news['name']);?></a>
                          <span class="text-muted">- <?php echo mdate('%d/%m/%Y', strtotime($news['datetime']));?></span>
                        </div>
                        <div class="img">
                          <a href="<?php echo base_url()?>blog-ky-nang/<?php echo $news['slug_theloai']?>/<?php echo $news['slug_tintuc']?>.html"><img data-src="<?php echo base_url();?>asset/users/images/big/<?php echo $news['urlimage'];?>" alt="" class="img-fluid lazyloaded resize" src="<?php echo base_url();?>asset/users/images/big/<?php echo $news['urlimage'];?>"></a>
                        </div>
                        <p class="intro"><?php echo $news['description'];?></p>
                      </div>
                    </li>
                    <?php }?>
                </ul>
                <div class="pagination-wrap">
                  <nav aria-label="Page navigation" class="float-md-right">
                    <?php 
                      if(isset($links)) 
                      {
                        echo $links;
                      }                            
                    ?> 
                  </nav>
                </div>
              </div>
              <div class="col-md-4">
                <div class="sidebar sidebar-right">               
                  <div class="box box-blog-categories">
                    <h3 class="heading">Danh mục</h3>
                    <div class="content">
                      <ul class="list-unstyled">
                        <?php foreach ($listTheloai as $cats){?>
                        <li class="">
                          <a href="<?php echo base_url()?>blog-ky-nang/<?php echo $cats['slug_theloai']?>.html"><?php echo $cats['name'];?></a>
                        </li>
                        <?php }?>
                      </ul>
                    </div>
                  </div>                
                </div>
              </div>
            </div>
          </div>
</section>    

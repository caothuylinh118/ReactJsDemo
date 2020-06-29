<?php include 'common/header.php' ?>
    <section class="slide whiteSlide" name="services" style="background: #000;" data-midnight="black">
      <div class="content">
        <div class="container">
          <div class="wrap">

            <!-- <div class="katana-12-12">
                <div class="col-12-12 ae-1 margin-top-3">
                  <a href="#">
                    <div class="text-image service" style="background: url(asset/img/service-1.jpg) no-repeat center;">
                      <p class="ae-2 text-title">Bespoke Training</p>
                      <span class="ae-3 text-description">Our print engines are built to meet customer needs with maximum productivity: connecting to the workflow of the customer.</span>
                    </div>
                  </a>
                </div>
            </div> -->
            <div class="katana-12-12">
              <div class="col-12-12 ae-1">
                <video poster="https://www.blue-zoo.co.uk/static/video/websiteloop.jpg" preload="auto" loop autoplay muted class="service_video text-image">
                  <source src='/files/services/row1/<?php echo $row1[4]['video'] ?>' type='video/mp4' />
                </video>
                <h2 class="ae-2 text-title-video service_title">WHAT WE DO ?</h2>
                <div class="entire_service">
                  <?php
                  for ($i = 0 ; $i < count($row1); $i ++) {
                    if ($row1[$i]['video']==null) {
                      $iconClass = 'service_icon_';
                      $textClass = 'service_text_';
                      $descriptionClass = 'service_description_';
                      $iconType = '';
                      if ($i == 0)
                        $iconType = 'film';
                      else if ($i == 1)
                        $iconType = 'tv';
                      else if ($i == 2)
                        $iconType = 'disk';
                      else if ($i == 3)
                        $iconType = 'laptop';
                      $iconFile = '/files/services/row1/'.$row1[$i]['image'];
                      echo '<div class="service_page">';
                      echo '<img class="ae-2 text-title-video '.$iconClass.$iconType.'" src="'.$iconFile.'" width="5%"/>';
                      echo '<h3 class="ae-2 text-title-video '.$textClass.$iconType.'">'.$row1[$i]['title'].'</h3>';
                      echo '<span class="ae-2 text-title-video '.$descriptionClass.$iconType.'">'.$row1[$i]['content'].'</span>';
                      echo '</div>';
                    }
                  }
                  ?>


                </div>
                <!-- <p class="ae-2 text-title-video">Bespoke Training</p>
                  <span class="ae-3 text-description-video">Our print engines are built to meet customer needs with maximum productivity: connecting to the workflow of the customer.</span> -->
                </div>
              </div>
              <div class="katana-12-12 wwd_mobile">
                <?php
                for ($i = 0 ; $i < count($row1); $i ++) {
                  if ($row1[$i]['video']==null) {
                    $iconClass = 'service_icon_';
                    $textClass = 'service_text_';
                    $descriptionClass = 'service_description_';
                    $iconType = '';
                    if ($i == 0)
                      $iconType = 'mobile';
                    else if ($i == 1)
                      $iconType = 'mobile';
                    else if ($i == 2)
                      $iconType = 'mobile';
                    else if ($i == 3)
                      $iconType = 'mobile';
                    $iconFile = '/files/services/'.$row1[$i]['image'];
                    echo '<div class="service_page_mobile">';
                    echo '<img class="ae-2 '.$iconClass.$iconType.'" src="'.$iconFile.'" width="5%"/>';
                    echo '<h3 class="ae-2 '.$textClass.$iconType.'">'.$row1[$i]['title'].'</h3>';
                    echo '<span class="ae-2 '.$descriptionClass.$iconType.'">'.$row1[$i]['content'].'</span>';
                    echo '</div>';
                  }
                }
                ?>
              </div>
            <div class="katana-12-12 slide_desktop">
              <div class="col-12-12 ae-2">
                <div class="movie_poster_slide">
                  <?php
                  for ($i = 0 ; $i < count($row2); $i ++) {
                    $file = '/files/services/row2/'.$row2[$i]['image'];
                    echo '<div><a href="#"><img src="'.$file.'"></a></div>';
                  }
                  ?>
                </div>
              </div>
            </div>
            <div class="clear"></div>
            <div class="katana-12-12">
              <div class="col-12-12 ae-1">

                  <video poster="https://www.blue-zoo.co.uk/static/video/websiteloop.jpg" preload="auto" loop autoplay muted class="video_width">
                    <source src='/files/services/row3/<?php echo $row3[0]['video'] ?>' type='video/mp4' />
                  </video>

               <!--  <div class="service_video">
                   <iframe class="full_video" id="kantana_cover" src="https://player.vimeo.com/video/260001330?autoplay=1&loop=1&autopause=0&background=1" width="1280" height="720" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div> -->
                <img id="img_hover" onmouseout="stopImageHover()" onmouseover="changeImageHover()" src="<?php echo base_url(); ?>asset/img/work_photo/1.jpg" class="image_hover_style">
              <!-- <a href="#">
                    <div class="text-image service" style="background: url(asset/img/OMO_bullet.jpg) no-repeat center;">
                      <p class="ae-2 text-title">Bespoke Training</p>
                      <span class="ae-3 text-description">Our print engines are built to meet customer needs with maximum productivity: connecting to the workflow of the customer.</span>
                    </div>
                  </a> -->
              </div>
            </div>
            <div class="katana-12-12 slide_mobile">
              <div class="col-12-12 ae-2">
                <div class="movie_poster_slide">
                  <?php
                  for ($i = 0 ; $i < count($row4); $i ++) {
                    $file = '/files/services/row4/'.$row4[$i]['image'];
                    echo '<div><a href="#"><img src="'.$file.'"></a></div>';
                  }
                  ?>
                </div>
              </div>
            </div>
            <div class="clear"></div>
            <div class="katana-12-12">
                <div class="col-12-12 ae-3 margin-top-3">
                  <div class="gallery">
                    <?php
                    for ($i = 0 ; $i < count($row4); $i ++) {
                      $file = '/files/services/row4/'.$row4[$i]['image'];
                      echo '<div class="artist_info">';
                      echo '<img src="'.$file.'" width="500" />';
                      echo '<div class="overlay">';

                      echo '</div>';
                      echo '</div>';

                    }
                    ?>




                    <!-- <div class="artist_info">
                      <img src="<?php echo base_url(); ?>asset/img/work_photo/20.jpg" />
                      <div class="overlay">
                        <div class="title_gallery img_name">Image Name</div>
                        <div class="title_gallery artist_name">Artist</div>
                      </div>
                    </div> -->
                  </div>
                </div>
            </div>

          </div>
        </div>
      </div>
    </section>

<?php include 'common/footer.php' ?>

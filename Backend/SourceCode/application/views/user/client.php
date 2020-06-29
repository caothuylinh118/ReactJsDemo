<?php include 'common/header.php' ?>
<section class="slide whiteSlide clientSlide" name="client" data-midnight="white">
  <div class="content">
    <div class="container">
      <div class="wrap">
        <div class="katana-10-12 toCenter margin-bottom-5" id="clientAgency">

          <img src="<?php echo base_url(); ?>asset/img/client/right-arrow.png" id="agencyRight" class="right-arrow" width="10px">
          <img src="<?php echo base_url(); ?>asset/img/client/left-arrow.png" id="agencyLeft" class="left-arrow" width="10px">

          <div class="owl-carousel owl-theme margin-top-5 ae-2">
            <?php
            for ($i = 0 ; $i < count($row1); $i ++) {
              $iconFile = '/files/clients/row1/'.$row1[$i]['image'];
              echo '<img class="client-img" src="'.$iconFile.'">';
            }
            ?>
          </div>
        </div>

        <div class="katana-10-12" id="clientBrand">

          <img src="<?php echo base_url(); ?>asset/img/client/right-arrow.png" class="right-arrow" id="brandRight" width="10px">
          <img src="<?php echo base_url(); ?>asset/img/client/left-arrow.png" class="left-arrow" id="brandLeft" width="10px">

          <div class="client-photo owl-carousel">
            <?php
            for ($i = 0 ; $i < count($row2); $i ++) {
              $iconFile = '/files/clients/row2/'.$row2[$i]['image'];
              echo '<img class="client-img" src="'.$iconFile.'">';
            }
            ?>
          </div>
          <div class="client-photo owl-carousel">
            <?php
            for ($i = 0 ; $i < count($row3); $i ++) {
              $iconFile = '/files/clients/row3/'.$row3[$i]['image'];
              echo '<img class="client-img" src="'.$iconFile.'">';
            }
            ?>
          </div>
        </div>

        <div class="katana-10-12 toCenter margin-bottom-5 margin-top-5" id="clientFilm">

          <img src="<?php echo base_url(); ?>asset/img/client/right-arrow.png" id="filmRight" class="right-arrow" width="10px">
          <img src="<?php echo base_url(); ?>asset/img/client/left-arrow.png" id="filmLeft" class="left-arrow" width="10px">

          <div class="owl-carousel owl-theme margin-top-5 ae-2">
            <?php
            for ($i = 0 ; $i < count($row4); $i ++) {
              $iconFile = '/files/clients/row4/'.$row4[$i]['image'];
              echo '<img class="client-img" src="'.$iconFile.'">';
            }
            ?>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<?php include 'common/footer.php' ?>

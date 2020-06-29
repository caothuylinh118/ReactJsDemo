<?php include 'common/header.php' ?>
<script src="<?php echo base_url(); ?>asset/js/admin/index.js"></script>
<script src="<?php echo base_url(); ?>asset/css/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<?php include 'common/sidebar.php' ?>
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Services
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">

          <?php
            if(isset($mess) && $mess != ''){
              echo '<div class="callout callout-info">';
              echo $mess;
              echo "</div>";
            }
          ?>

            <!-- ==== GENERAL ITEM ====== -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Service Row 1</h3>
              </div>
              <!-- /.box-header -->


                <?php
                  for ($i = 0 ; $i < count($services); $i ++) {
                    if ($services[$i]['video']==null){
                      echo '<form action="adminservicesrow1/change" method="post" enctype="multipart/form-data">';
                      echo '<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().' ">';
                      echo '<input type="hidden" name="id" value="'.$services[$i]['id'].'"/>';
                      echo '<input type="hidden" name="order" value="'.($i+1).'"/>';
                      echo '<div class="box-body">';

                      // Title
                      echo '<div class="form-group">';
                      echo '<label>Title '. ($i+1) .' </label>';
                      echo '<input type="text" class="form-control" name="title" value="'.$services[$i]['title'].'"/>';
                      echo '</div>';

                      // Content
                      echo '<div class="form-group">';
                      echo '<label>Content '. ($i+1) .' </label>';
                      echo '<input type="text" class="form-control" name="content" value="'.$services[$i]['content'].'"/>';
                      echo '</div>';

                      // Content
                      echo '<div class="form-group">';
                      echo '<label>File '. ($i+1) .' </label>';
                      echo '<input type="text" class="form-control" value="'.$services[$i]['image'].'" readonly/>';
                      echo '<input type="file" class="form-control" name="file" id="file" />';
                      echo '</div>';

                      echo '<input type="submit" class="btn btn-primary" value="Change"/>';

                      echo '</div>';
                      echo '</form>';
                      echo '-------------------------------';
                    }
                  }
                ?>

                <form action="adminServiceRowOneMaster/changeVideo" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <!-- radio -->
                  <div class="box-body">
                    <div class="form-group">
                      <label>
                        Row 1 Video
                      </label>
                      <input type="text" class="form-control" value="<?php echo $services[4]['video']; ?>" readonly/>
                      <input type="file" class="form-control" name="video" value=""/>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Change"/>
                  </div>
                </form>

              <!-- /.box general Item -->
            </div>

          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
  <?php include 'common/footer.php' ?>

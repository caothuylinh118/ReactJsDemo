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
        Client Row <?php echo $row; ?>
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
                <h3 class="box-title">List Image</h3>
              </div>
              <!-- /.box-header -->


                <?php
                if (count($clients) > 0) {
                  for ($i = 0 ; $i < count($clients); $i ++) {
                    $cipherID = encrypted($clients[$i]['id']);
                    $cipherImage = encrypted($clients[$i]['image']);
                    echo '<form action="adminclient/change" method="post" enctype="multipart/form-data">';
                    echo '<input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().' ">';
                    echo '<input type="hidden" name="id" value="'.$clients[$i]['id'].'"/>';
                    echo '<input type="hidden" name="row" value="'.$row.'"/>';
                    echo '<div class="box-body">';

                    // Content
                    echo '<div class="form-group">';
                    echo '<label>Position</label>';
                    echo '<input type="text" class="form-control" name="order" value="'.$clients[$i]['order'].'"/>';
                    echo '</div>';

                    // Content
                    echo '<div class="form-group">';
                    echo '<label>File</label>';
                    echo '<input type="text" class="form-control" value="'.$clients[$i]['image'].'" readonly/>';
                    echo '<input type="file" class="form-control" name="file" id="file" />';
                    echo '</div>';

                    echo '<input type="submit" class="btn btn-primary" value="Change"/>&nbsp;&nbsp;';
                    echo '<a href="adminclient/delete?id='. $cipherID .'&image='.$cipherImage.'"><button type="button" class="btn btn-primary">Delete</button></a>';
                    echo '</div>';
                    echo '</form>';
                    echo '-------------------------------';
                  }
                } else {
                  echo " <i> No Images</id>";
                }
                ?>

                <div class="box-header with-border">
                  <h3 class="box-title">Add New Image</h3>
                </div>

                <form action="adminclient/add" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <input type="hidden" name="row" value="<?php echo $row; ?>"/>
                  <!-- radio -->
                  <div class="box-body">
                    <div class="form-group">
                      <label>
                        Position
                      </label>
                      <input type="text" class="form-control" name="order" value=""/>
                    </div>
                    <div class="form-group">
                      <label>
                        New Image
                      </label>
                      <input type="file" class="form-control" name="file" value=""/>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Add New"/>
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

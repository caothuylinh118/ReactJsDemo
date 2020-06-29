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
        Job Application
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">

          <?php
          $title = '';
          $cvFile = '';
          $cvLink = '';
          $portfolioLink = '';
          $availableDate = '';
          $referencesFrom = '';
          $postDate = '';
          $status = '';

          if(isset($application)){
            $title = $application['title'];
            $cvFile = $application['cv_file'];
            $cvLink = $application['cv_link'];
            $portfolioLink = $application['portfolio_link'];
            $availableDate = $application['start_date'];
            $referencesFrom = $application['references_from'];
            $postDate = $application['post_date'];
            $status = $application['status'];
          }
          ?>

          <form action="" method="post">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" id="deCount" name="deCount" value="0">
            <input type="hidden" id="reCount" name="reCount" value="0">
            <!-- ==== GENERAL ITEM ====== -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Cadidate Application Item</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">

                <div class="form-group">
                  <label>Job Title</label>
                  <input type="text" class="form-control" placeholder="Job Position ..." name="title" value="<?php echo $title;?>"  disabled />
                </div>

                <div class="form-group">
                  <label>
                    CV File
                  </label>
                  <?php
                  $cipherFile = encrypted($cvFile);
                  ?>
                  <br/>
                  <a href="adminapplicationitem/download?id=<?php echo $cipherFile; ?>" ><?php echo $cvFile; ?></a>
                </div>

                <div class="form-group">
                  <label>
                    CV Link
                  </label>
                  <?php
                  if ($cvLink != '') {
                  ?>
                  <br/>
                  <a href="<?php echo $cvLink; ?>" ><?php echo $cvLink; ?></a>
                <?php } else {
                  echo "<br/>None";
                }?>
                </div>


                <div class="form-group">
                  <label>
                    Portfolio Link
                  </label>
                  <?php
                  if ($portfolioLink != '') {
                  ?>
                  <br/>
                  <a href="<?php echo $portfolioLink; ?>" ><?php echo $portfolioLink; ?></a>
                <?php }  else {
                  echo "<br/>None";
                }?>
                </div>

                <div class="form-group">
                  <label>
                    Avaialable to work on
                  </label>
                  <input type="text" class="form-control"  name="start_date" value="<?php echo $availableDate;?>"  disabled />
                </div>

                <div class="form-group">
                  <label>
                    I found Kantana from
                  </label>
                  <input type="text" class="form-control"  name="references" value="<?php echo $referencesFrom;?>"  disabled />
                </div>

                <input type="hidden" name="id" value="<?php echo $id ; ?>"/>
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status" id="status" >
                    <option value="0">New</option>
                    <option value="1">In Progress</option>
                    <option value="2">Passed</option>
                    <option value="3">Failed</option>
                  </select>
                </div>

                <script>
                $("#status").val(<?php echo $status;?>);
                </script>

              </div>
              <!-- /.box general Item -->
            </div>

            <input type="submit" class="btn btn-primary" value="Submit"/>
          </form>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
  <?php include 'common/footer.php' ?>

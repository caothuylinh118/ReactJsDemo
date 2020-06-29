<?php include 'common/header.php' ?>
<script src="<?php echo base_url(); ?>asset/js/admin/index.js"></script>
<?php include 'common/sidebar.php' ?>
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?php echo $result['title'];?>
            <small class="pull-right">Date: <?php echo $result['updated_date'];?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong><?php echo $result['first_name']." ".$result['last_name'];?></strong><br>
            Email: <?php echo $result['user_email'];?><br>
          </address>
        </div>
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Personal</th>
              <th>Point</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i <=5 ; $i++) {
              $point_i = "point_".($i+1);
              echo '<tr>';
              echo '<td>'.($i+1).'</td>';
              echo '<td>'.$personals[$i]['name'].'</td>';
              echo '<td>'.$result[$point_i].'</td>';
            }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- ============ detail =========== -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            QUESTION DETAIL
          </h2>
        </div>
        <!-- /.col -->
      </div>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Questions</th>
              <th>Answer</th>
              <th>Answer Point</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i <sizeof($answers) ; $i++) {
              echo '<tr>';
              echo '<td>'.($i+1).'</td>';
              echo '<td>'.$answers[$i]['question_title'].'</td>';
              echo '<td>'.$answers[$i]['answer_title'].'</td>';
              echo '<td>'.$answers[$i]['point'].'</td>';
              // echo '<td>'.$result[$point_i].'</td>';
              echo '</tr>';
            }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
  <?php include 'common/footer.php' ?>

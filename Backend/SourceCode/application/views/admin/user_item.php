<?php include 'common/header.php' ?>
<script src="<?php echo base_url(); ?>asset/js/admin/index.js"></script>
<?php include 'common/sidebar.php' ?>
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

              <h3 class="profile-username text-center"><?php echo $user['first_name']." ".$user['last_name']; ?></h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b><?php echo $user['email']; ?></b>
                </li>
                <li class="list-group-item">
                  <b>Register from: <?php echo $user['oauth_provider']; ?></b>
                </li>
                <li class="list-group-item">
                  <b>Register date: <?php echo $user['created']; ?></b>
                </li>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#Test" data-toggle="tab">Tests</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="Test">

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Name</th>
                      <th></th>
                      <th>Finish date</th>
                      <th></th>
                    </tr>
                    <?php
                    // print("<pre>".print_r($list_career,true)."</pre>");
                    foreach ($tests as $test) {
                      $cipherID = encrypted($test['id']);
                      echo "<tr>";
                      echo "<td>".$test['title']."</td>";
                      echo "<td></td>";
                      echo "<td>".$test['updated_date']."</td>";
                      echo "<td>";
                      echo "<div class='btn-group'>";
                      echo '<a href="'.base_url().'admin-test-results/detail?id='.$cipherID.'&&personal_type_id='.$test['type'].'"><button type="button" class="btn btn-info">View Result</button></a>';
                      echo "</div>";
                      echo "</td>";
                      echo "</tr>";
                    }
                    ?>

                  </table>
                </div>


              </div>
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
  <?php include 'common/footer.php' ?>

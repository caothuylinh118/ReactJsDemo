<?php include 'common/header.php' ?>
<?php include 'common/sidebar.php' ?>
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users List
      </h1>
    </section>

    <?php
      if(isset($mess) && $mess != ''){
        echo '<div class="callout callout-info">';
        echo $mess;
        echo "</div>";
      }
    ?>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->

            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th></th>
                  <th>User name</th>
                  <th>Register From</th>
                  <th></th>
                </tr>
                <?php
                // print("<pre>".print_r($list_career,true)."</pre>");
                foreach ($list_users as $users) {
                  $userName = isset($users['first_name']) ? $users['first_name'] : $users['email'];
                  $cipherID = encrypted($users['id']);
                  echo "<tr>";
                  echo "<td>".$users['id']."</td>";
                  echo "<td></td>";
                  echo "<td>".$userName."</td>";
                  echo "<td>".$users['oauth_provider']."</td>";
                  echo "<td>";
                  echo "<div class='btn-group'>";
                  echo '<a href="'.base_url().'admin-users/detail?id='.$cipherID.'"><button type="button" class="btn btn-info">View Profile</button></a>';
                  echo "</div>";
                  echo "</td>";
                  echo "</tr>";
                }
                ?>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include 'common/footer.php' ?>

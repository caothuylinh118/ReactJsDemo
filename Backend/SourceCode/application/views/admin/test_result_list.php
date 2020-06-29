<?php include 'common/header.php' ?>
<?php include 'common/sidebar.php' ?>
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tests List
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
            <div class="box-header">
              <h3 class="box-title">List </h3>
              <button style="margin-left: 100px" id="compare_result">Display</button>
            </div>
            <!-- /.box-header -->

            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th></th>
                  <th>Test name</th>
                  <th>Participant</th>
                  <th>Date</th>
                  <th></th>
                  <th></th>
                </tr>
                <?php
                // print("<pre>".print_r($list_career,true)."</pre>");
                foreach ($results as $result) {
                  $participant = isset($result['first_name']) ? $result['first_name'] :  $result['user_email'];
                  $cipherID = encrypted($result['id']);
                  echo "<tr>";
                  echo "<td>".$result['id']."</td>";
                  echo "<td></td>";
                  echo "<td>".$result['title']."</td>";
                  echo "<td>".$participant."</td>";
                  echo "<td>".$result['updated_date']."</td>";
                  echo "<td>";
                  echo "<div class='btn-group'>";
                  echo '<a href="'.base_url().'admin-test-results/detail?id='.$cipherID.'&&personal_type_id='.$result['type'].'"><button type="button" class="btn btn-info">View Result</button></a>';
                  echo "</div>";
                  echo "</td>";
                  echo "<td><input type='checkbox' data-resultid=".$result['id']." data-testid=".$result['test_id']." /></td>";
                  echo "</tr>";
                }
                ?>

              </table>
            </div>
            <!-- /.box-body -->
            <!-- Calculate Pages -->
            <?php
              // echo "Page COunt : " . $pagesCount . " -  limit : " . $limit;
              $totalPage  = ceil($pagesCount/$limit);
              $linkPre = $currentPage == 1 ? '#' : 'admin-test-results?page='.($currentPage - 1);
              $linkNext = $currentPage == $totalPage ? '#' : 'admin-test-results?page='.($currentPage + 1);
            ?>
            <div class="box-footer clearfix">
              <div class="col-md-3">
                Item per page: <br/>
                <select class="form-control" id="per_page">
                  <?php
                  for ($i = 1 ; $i <= 5; $i++) {
                    $selected = "";
                    if ($limit == $i*10)
                      $selected = 'selected';
                    echo '<option value="'.($i*10).'" '.$selected.'>'.($i*10).'</option>';
                  }
                  ?>
                </select>
              </div>
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="<?php echo $linkPre;?>">&laquo;</a></li>
                <?php
                for ($i = 1 ; $i <= $totalPage; $i++) {
                  $classActive = $i == $currentPage ? 'active' : '';
                  $urlPage = $i != $currentPage ? 'admin-test-results?per_page='.$limit.'&page='.$i : '#' ;
                  echo '<li><a href="'.$urlPage.'" class="'.$classActive.'">'.$i.'</a></li>';
                }
                ?>
                <li><a href="<?php echo $linkNext;?>">&raquo;</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
$( "#per_page" ).change(function() {
  // Check input( $( this ).val() ) for validity here
  window.location.replace('<?php echo base_url(); ?>admin-test-results?per_page='+$(this).val()+'&page=<?=$currentPage?>');
});
</script>

<!-- Check Box Display Script -->
<script>
var count_check = 0;
var result_id = [];
var test_id = '';
var limit = 10;
$("input[type='checkbox']").change(function() {
    // this will contain a reference to the checkbox
    var thisTestiD = $(this).data('testid');
    if (this.checked) {
        test_id = thisTestiD;
        count_check++;
        result_id.push($(this).data('resultid'));
        $("input[type='checkbox']").each(function( index ) {
          if (count_check >= limit) {
            // Check check 2 boxes, disable all other box
            if (!this.checked)
              $( this ).attr("disabled", true);
          }
          else {
            // If check first box, disable all other tests type
            // Just available the same type
            if ($(this).data('testid') == thisTestiD) {

            } else {
              $( this ).attr("disabled", true);
            }
          }

        });
    } else {
      count_check--;
      result_id.pop();
      $("input[type='checkbox']").each(function( index ) {
        if (count_check == 1) {
          if ($(this).data('testid') == thisTestiD) {
            $( this ).attr("disabled", false);
          } else {
            $( this ).attr("disabled", true);
          }
        } else {
          $( this ).removeAttr("disabled");
        }
      });
    }
});

$( "#compare_result" ).click(function() {
  if (result_id.length > 0) {
    var param = "?";
    var andOp = "";
    var param_test_id =test_id != null ? "&test=" + test_id : "";
    for (var i = 0 ; i < result_id.length; i ++) {
      param += andOp;
      param = param + "id_" + i + "=" + result_id[i];
      andOp = "&";
    }
    param = param + param_test_id;
    window.location.replace("<?php echo base_url(); ?>admin-test-results/display-graph?" + param);
  }

});

</script>
<?php include 'common/footer.php' ?>

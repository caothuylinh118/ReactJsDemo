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
            <div class="row">
              <div class="box-header col-xs-6" style="margin-left: 30px">
                <h3 class="box-title">List </h3>
                <a href="<?php echo base_url(); ?>admin-results/add-type"><button type="button" style="margin-left:50px"class="btn btn-primary">Add New Type</button></a>
                <a href="<?php echo base_url(); ?>admin-results/update-type?type_id=<?= $type_id;?>"><button type="button" style="margin-left:50px"class="btn btn-primary">Edit Type</button></a>
              </div>

              <div class="form-group col-xs-4">
                <label>Type</label>
                <select class="form-control" id="p_type">
                  <?php foreach($types as $type) { ?>
                    <option value="<?= $type['item_id'] ?>"><?= $type['type_name'] ?></option>
                <?php } ?>
                </select>
                <script>
                  $("#p_type").val(<?= $type_id;?>);
                </script>
              </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th></th>
                  <th>Result name</th>
                  <th>Result explanation</th>
                  <th>Color</th>
                  <th></th>
                </tr>
                <?php
                // print("<pre>".print_r($list_career,true)."</pre>");
                foreach ($list_results as $result) {
                  $cipherID = encrypted($result['item_id']);
                  echo "<tr>";
                  echo "<td>".$result['item_id']."</td>";
                  echo "<td></td>";
                  echo "<td>".$result['name'];
                  if ($result['character_id'] != 0) {
                    echo "<select class='change-character' data-itemid = '".$result['item_id']."' data-currentcolor = '".$result['color']."'>";
                    foreach ($list_character as $character) {
                      $selected = $result['character_id'] == $character['item_id'] ? 'selected' : '';
                      echo "<option value='".$character['item_id']."' ".$selected.">".$character['title']."</option>";
                    }
                    echo "</select>";
                  }
                  echo "</td>";
                  echo "<td>".$result['explanation']."</td>";
                  echo "<td style='background-color:".$result['color']."'></td>";
                  echo "<td>";
                  echo "<div class='btn-group'>";
                  echo '<a href="'.base_url().'admin-results/change?id='.$cipherID.'"><button type="button" class="btn btn-info">Update</button></a>';
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
<script>
$("#p_type").change(function() {
  // Check input( $( this ).val() ) for validity here
  window.location.href =  '<?=base_url()?>admin-results?type_id=' + $(this).val();
});

$(".change-character").change(function() {
  var item_id = $(this).data('itemid');
  var old_color = $(this).data('currentcolor');
  var character_id = $(this).val();
  console.log("item id : " + item_id + " -  characterId : " + character_id);
  $.ajax({
    url : "<?php echo base_url(); ?>AdminResultList/ajaxChangeCharacter",
    type : "POST",
    dataType : "json",
    data : {"item_id" : item_id, "character_id" :character_id, "old_color" : old_color},
    success : function(data) {
        // do something
        console.log(data.result);
        if (data.result ==  "success") {
          window.location.replace("<?php echo base_url(); ?>admin-results?type_id=" + <?= $type_id?> );
        }
    },
    error : function(data) {
        // do something
        // alert(data.result);
    }
  });
});

</script>
<?php include 'common/footer.php' ?>

<?php include 'common/header.php' ?>
  <div class="main-content">
    <div class="container">
      <section class="content01 chapter">
        <h2>Your record</h2>
        <button id="compare_result">Display</button><br><br>
        <table>
          <tr>
            <th></th>
            <th></th>
            <th colspan="4" class="gray">Score</th>
          </tr>
          <tr>
            <th class="gray">Test name</th>
            <th class="gray">Date</th>
            <th class="color01">Protector</th>
            <th class="color02">Adventure</th>
            <th class="color03">Idealist</th>
            <th class="color04">Warrior</th>
          </tr>
          <?php for($i = 0; $i < sizeof ($results); $i++) {?>
          <tr>
            <td><?php echo $results[$i]['title']; ?></td>
            <td><?php echo $results[$i]['updated_date']; ?></td>
            <td><?php echo $results[$i]['point_1']; ?></td>
            <td><?php echo $results[$i]['point_2']; ?></td>
            <td><?php echo $results[$i]['point_4']; ?></td>
            <td><?php echo $results[$i]['point_5']; ?></td>
            <td><input type="checkbox" data-resultid="<?=$results[$i]['id']?>" data-testid="<?=$results[$i]['test_id']?>" /></td>
          </tr>

          <?php } ?>
        </table>
      </section>
    </div>
  </div>
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
    window.location.replace("<?php echo base_url(); ?>result/compare?" + param);
  }

});

</script>
</body>
</html>

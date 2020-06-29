<?php include 'common/header.php' ?>
<?php include 'common/sidebar.php' ?>
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Display results
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
          <?php
          //print("<pre>".print_r($results,true)."</pre>");
          ?>
          <div>
          <!-- <div id="animatedshapes_div" style="width: 900px; height: 500px;"></div> -->
            <canvas id="myCanvas" width="1080" height="678"></canvas>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
  var margin_width = 180;
  var margin_height = 100;
  var space_width = 30;
  var space_height = 30;

  var canvas_width = $('#myCanvas').width();
  var canvas_height = $('#myCanvas').height();

  var point_root_X = canvas_width/2;
  var point_root_Y = canvas_height/2;

  var graph_width = canvas_width/2 - margin_width - space_width;
  var graph_height = canvas_height/2 - margin_height - space_height;

  var canvas = document.getElementById('myCanvas');
  var context = canvas.getContext('2d');

  // Axis value
  // horizontal
  h_x_from_line_1 = point_root_X - graph_width - space_width;
  h_y_from_line_1 = point_root_Y;
  h_x_to_line_1 = h_x_from_line_1 + graph_width;
  h_y_to_line_1 = point_root_Y;

  h_x_from_line_2 = point_root_X + space_width;
  h_y_from_line_2 = point_root_Y;
  h_x_to_line_2 = h_x_from_line_2 + graph_width;
  h_y_to_line_2 = point_root_Y;

  // vertical
  v_x_from_line_1 = point_root_X;
  v_y_from_line_1 = point_root_Y - space_height - graph_height;
  v_x_to_line_1 = point_root_X;
  v_y_to_line_1 = v_y_from_line_1 + graph_height;

  v_x_from_line_2 = point_root_X
  v_y_from_line_2 = point_root_Y + space_height;
  v_x_to_line_2 = point_root_X
  v_y_to_line_2 = v_y_from_line_2 + graph_height;

  var h_text_margin = 20;
  var v_text_margin = 10;
  var top_text_y = v_y_from_line_1 - h_text_margin;
  var top_text_x = point_root_X;
  var bot_text_y = v_y_to_line_2 + h_text_margin + 20;
  var bot_text_x = point_root_X;

  var left_text_y = point_root_Y;
  var left_text_x = 0 + 90;
  var right_text_y = point_root_Y;
  var right_text_x = h_x_to_line_2 + 60 + v_text_margin;

  var coordidates_X = [];
  var coordidates_Y = [];
  var finalColors = [];
  var updateDates = [];
  var final_point_X = [];
  var final_point_Y = [];
  var users = [];
  var maxDensity = <?=$max_density; ?>;

  function renderPoint (centerX, centerY, finalcolor, update_date) {
    var radius = 10;
    // Draw point 1
    context.beginPath();
    context.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
    context.fillStyle = finalcolor;
    context.fill();
    context.stroke();

    context.font = 'normal 10pt arial';
    context.textAlign = 'center';
    context.fillStyle = finalcolor;
    context.fillText(update_date, centerX, centerY + 25);

  }

  </script>
  <?php

    for ($i = 0; $i < sizeof($results); $i++) {
      // print("<pre>".print_r($results,true)."</pre>");
      $pointA_x = $results[$i][0]['point'];
      $pointA_y = $results[$i][1]['point'];
      $pointB_x = $results[$i][3]['point'];
      $pointB_y = $results[$i][4]['point'];
      $colorPointA = "";
      $colorPointB = "";

      // Set color point A
      if (($pointA_x + $pointA_y) > 0) {
        $colorPointA = $results[$i][0]['color'];
      } else if (($pointA_x + $pointA_y) < 0) {
        $colorPointA = $results[$i][1]['color'];
      } else  {
        $colorPointA = $results[$i][2]['color'];
      }

      // Set color point B
      if (($pointB_x + $pointB_y) > 0) {
        $colorPointB = $results[$i][3]['color'];
      } else if (($pointB_x + $pointB_y) < 0) {
        $colorPointB = $results[$i][4]['color'];
      } else  {
        $colorPointB = $results[$i][5]['color'];
      }

      $final_point_X = $pointA_x + $pointA_y;
      $final_point_Y = $pointB_x + $pointB_y;
      $final_color = $final_point_X >= $final_point_Y ? $colorPointA : $colorPointB;

    ?>

    <script>
      // Point 1
      var result_X = <?php echo $final_point_X;?>;
      var result_Y = <?php echo $final_point_Y;?>;
      var update_date = '<?php echo $results[$i]['updated_date'];?>';
      var this_user =  '<?php echo $results[$i]['user'];?>';
      var radius = 10;

      // Point 1 value
      var point_X_to = ((graph_width + space_width) / maxDensity) * Math.abs(result_X);
      var point_Y_to = ((graph_height + space_height) / maxDensity) * Math.abs(result_Y);
      var centerX = result_X >= 0 ? (point_root_X + point_X_to) : (point_root_X - point_X_to);
      var centerY = result_Y >= 0 ? (point_root_Y - point_Y_to) : (point_root_Y + point_Y_to);

      coordidates_X.push (centerX);
      coordidates_Y.push (centerY);
      finalColors.push ('<?=$final_color?>');
      updateDates.push (update_date);
      final_point_X.push (result_X);
      final_point_Y.push (result_Y);
      users.push (this_user);
      // Text Value



      renderPoint(centerX, centerY, '<?=$final_color?>', update_date);
    </script>

  <?php } ?>

  <script>

  function renderGraph () {
    // Begin Draw
    context.beginPath();
    // Draw Horizontal
    context.moveTo(h_x_from_line_1, h_y_from_line_1);
    context.lineTo(h_x_to_line_1, h_y_to_line_1);
    context.moveTo(h_x_from_line_2, h_y_from_line_2);
    context.lineTo(h_x_to_line_2, h_y_to_line_2);

    // Draw Vertical
    context.moveTo(v_x_from_line_1, v_y_from_line_1);
    context.lineTo(v_x_to_line_1, v_y_to_line_1);
    context.moveTo(v_x_from_line_2, v_y_from_line_2);
    context.lineTo(v_x_to_line_2, v_y_to_line_2);

    context.stroke();


    // Draw Text
    // Top
    context.font = 'normal 17pt arial';
    context.textAlign = 'center';
    context.fillStyle = '<?php echo $results[0][0]['color'];?>';
    context.fillText('<?php echo $results[0][0]['name'];?>', top_text_x, top_text_y);
    // Bot
    context.fillStyle = '<?php echo $results[0][1]['color'];?>';
    context.fillText('<?php echo $results[0][1]['name'];?>', bot_text_x, bot_text_y);
    // Left
    context.fillStyle = '<?php echo $results[0][4]['color'];?>';
    context.fillText('<?php echo $results[0][4]['name'];?>', left_text_x, left_text_y);
    // Right
    context.fillStyle = '<?php echo $results[0][3]['color'];?>';
    context.fillText('<?php echo $results[0][3]['name'];?>', right_text_x, right_text_y);
  }



  </script>

  <script>

    renderGraph ();
    renderNumbers ();


    // Point Hover
    canvas.onmousemove = function(e) {
      // Get the current mouse position
      var r = canvas.getBoundingClientRect(),
          x = e.clientX - r.left, y = e.clientY - r.top;
      hover = false;

      context.clearRect(0, 0, canvas.width, canvas.height);
      renderGraph ();
      renderNumbers ();

      <?php
      $index = 0;
      ?>

      for (var i = 0; i < coordidates_X.length; i++) {
        renderPoint(coordidates_X[i], coordidates_Y[i], finalColors[i], updateDates[i]);
        if(isInPoint(x, y, coordidates_X[i], coordidates_Y[i], 10)) {

            // The mouse honestly hits the rect

            var margin = 5;
            // context.fillStyle = "gray";
            // context.fillRect(centerX + margin, centerY - radius - margin, 50, -30);
            // draw font in red
            context.fillStyle = 'red';
            context.font = "10pt sans-serif";
            context.fillText(users[i] +  '(' + final_point_X[i] + ', ' + final_point_Y[i] + ')', coordidates_X[i] + margin + 25, coordidates_Y[i] - radius - margin - 10);
            <?php
            $index++;
            ?>
        }
      }
      // if(isInPoint(x, y, centerX, centerY, radius)) {
      //     // The mouse honestly hits the rect
      //     renderCoord (centerX, centerY, radius, 1) ;
      // }

    }

    function isInPoint (x, y, centerX, centerY, radius) {
      return Math.round(Math.sqrt(Math.pow(x - centerX, 2) + Math.pow(y - centerY, 2))) <= radius;
    }

    function renderNumbers () {
      // Graph Number Background
      var horizontal_root_X = point_root_X;
      var horizontal_root_Y = v_y_to_line_2;
      var vertical_root_X = h_x_from_line_1;
      var vertical_root_Y = point_root_Y;
      var count_num = maxDensity; // -15 ~ 0 ~ + 15
      var rate = maxDensity / 15;

      for (var i = 1; i <= count_num; i += 2*rate) {
        var this_num = i;

        context.font = 'normal 8pt arial';
        context.textAlign = 'center';
        context.fillStyle = 'gray';

        if (this_num != 0 && this_num != maxDensity) {
          context.fillText(this_num, horizontal_root_X + this_num * ((graph_width + space_width) / maxDensity), horizontal_root_Y + 10);
          context.fillText(this_num * -1, horizontal_root_X - this_num * ((graph_width + space_width) / maxDensity), horizontal_root_Y + 10);

          context.fillText(this_num * -1, vertical_root_X, vertical_root_Y + this_num * ((graph_height + space_width) / maxDensity) + 8);
          context.fillText(this_num, vertical_root_X, vertical_root_Y - this_num * ((graph_height + space_width) / maxDensity));
        }

      }

    }

</script>
<?php include 'common/footer.php' ?>

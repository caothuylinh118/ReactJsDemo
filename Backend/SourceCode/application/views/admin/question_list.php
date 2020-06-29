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
        Add New Questions
      </h1>

    </section>

    <?php

      $testNameEn = "";
      $testNameFr = "";
      $testNamevn = "";
      $position = "";
      if (isset($tests)) {
        $testNameEn = $tests[0]['title'];
        $testNameFr = $tests[1]['title'];
        $testNamevn = $tests[2]['title'];
        $position = $tests[0]['position'];
      }
    ?>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">

          <form action="" method="post">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" id="qeCount" name="qeCount" value="0">
            <input type="hidden" id="type_id" name="type_id" value="<?php echo $type_id; ?>">
            <select id="colorsResult" style="display:none" >
              <?php
              for ($i = 0; $i < sizeof($colors); $i++) {
                echo '<option value="'.$colors[$i]['color'].'">'.$colors[$i]['name'].'</option>';
              }
              ?>
            </select>
            <div class="form-group">
              <label>Test Name</label>
              <input type="text" class="form-control" placeholder="English ..." name="test_name_en" value="<?php echo $testNameEn; ?>" />
              <input type="text" class="form-control" placeholder="France ..." name="test_name_fr" value="<?php echo $testNameFr; ?>" />
              <input type="text" class="form-control" placeholder="Vietnamese ..." name="test_name_vn" value="<?php echo $testNamevn; ?>" />
            </div>

            <div class="form-group">
              <label>Status</label>
              <select class="form-control" name="status" id="status" >
                <option value="0">Published</option>
                <option value="1">Deactive</option>
              </select>
            </div>

            <div class="form-group">
              <label>Position</label>
              <input type="text" class="form-control" placeholder="Position ..." name="position" value="<?php echo $position; ?>" />
            </div>

            <!-- ==== QUESTIONS ITEM ====== -->
            <div class="box box-primary"  id="question_body">
              <div class="box-header with-border">
                <h3 class="box-title">List Questions</h3>
                <button id="add_question" type="button" style="margin-left:100px"class="btn btn-primary">Add New</button>
              </div>

              <?php
                $j = 0;
                if (isset($questions)) {

                  for ($i = 0; $i < sizeof($questions); $i++) {
                    $j++;
                    echo '<div class="box-body questions-group">';
                    echo '<div class="form-group">';
                    echo '<label class="question-count"></label>';
                    echo '<div class="row">';
                    echo '<div class="col-xs-4">';
                    echo '<input type="text" class="form-control question-txt-en" placeholder="English ..." name="questions_'.$i.'_en" value="'.$questions[$i]['en'].'" >';
                    echo '</div>';
                    echo '<div class="col-xs-4">';
                    echo '<input type="text" class="form-control question-txt-fr" placeholder="France ..." name="questions_'.$i.'_fr" value="'.$questions[$i]['fr'].'">';
                    echo '</div>';
                    echo '<div class="col-xs-4">';
                    echo '<input type="text" class="form-control question-txt-vn" placeholder="Vietnamese ..." name="questions_'.$i.'_vn" value="'.$questions[$i]['vi'].'">';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    // Answer 1
                    echo '<div class="form-group">';
                    echo '<label>Answer Positive: </label> <label class="question-axis-label" id="">+ X / + Y</label>';
                    echo '<div class="row">';
                    echo '<div class="col-xs-4">';
                    echo '<input type="text" class="form-control answer-txt-1-en" placeholder="English ..." name="answer_1_'.$i.'_en" value="'.$questions[$i]['answers'][0]['title'].'">';
                    echo '</div>';
                    echo '<div class="col-xs-4">';
                    echo '<input type="text" class="form-control answer-txt-1-fr" placeholder="France ..." name="answer_1_'.$i.'_fr" value="'.$questions[$i]['answers'][1]['title'].'">';
                    echo '</div>';
                    echo '<div class="col-xs-4">';
                    echo '<input type="text" class="form-control answer-txt-1-vn" placeholder="Vietnamese ..." name="answer_1_'.$i.'_vn" value="'.$questions[$i]['answers'][2]['title'].'">';
                    echo '</div>';
                    echo '</div>';
                    // Color Answer 1
                    echo '<div class="row">';
                		echo '<div class="col-xs-4">';
                		echo '<select class="select-answer-1" name="answer_color_1_'.$i.'">';

                    for ($j = 0; $j < sizeof($colors); $j++) {
                      $select = '';
                      if ($questions[$i]['answers'][0]['color']==$colors[$j]['color'])
                        $select = 'selected';

                      echo '<option value="'.$colors[$j]['color'].'" '.$select.'>'.$colors[$j]['name'].'</option>';
                    }

                    echo '</select>';
                		echo '</div>';
                		echo '</div>';
                		echo '</div>';

                    // Answer 2
                    echo '<div class="form-group">';
                    echo '<label>Answer Negative: </label> <label class="question-axis-label" id="">- X / - Y</label>';
                    echo '<div class="row">';
                    echo '<div class="col-xs-4">';
                    echo '<input type="text" class="form-control answer-txt-2-en" placeholder="English ..." name="answer_2_'.$i.'_en" value="'.$questions[$i]['answers'][3]['title'].'">';
                    echo '</div>';
                    echo '<div class="col-xs-4">';
                    echo '<input type="text" class="form-control answer-txt-2-fr" placeholder="France ..." name="answer_2_'.$i.'_fr" value="'.$questions[$i]['answers'][4]['title'].'">';
                    echo '</div>';
                    echo '<div class="col-xs-4">';
                    echo '<input type="text" class="form-control answer-txt-2-vn" placeholder="Vietnamese ..." name="answer_2_'.$i.'_vn" value="'.$questions[$i]['answers'][5]['title'].'">';
                    echo '</div>';
                    echo '</div>';
                    // Color Answer 2
                    echo '<div class="row">';
                		echo '<div class="col-xs-4">';
                    echo '<select class="select-answer-2" name="answer_color_2_'.$i.'">';

                    for ($j = 0; $j < sizeof($colors); $j++) {
                      $select = '';
                      if ($questions[$i]['answers'][3]['color']==$colors[$j]['color'])
                        $select = 'selected';

                      echo '<option value="'.$colors[$j]['color'].'" '.$select.'>'.$colors[$j]['name'].'</option>';
                    }

                    echo '</select>';
                		echo '</div>';
                		echo '</div>';
                    echo '</div>';

                    // Answer 3
                    // echo '<div class="form-group">';
                    // echo '<label>Answer Normal</label>';
                    // echo '<div class="row">';
                    // echo '<div class="col-xs-4">';
                    // echo '<input type="text" class="form-control answer-txt-3-en" placeholder="English ..." name="answer_3_'.$i.'_en" value="'.$questions[$i]['answers'][6]['title'].'">';
                    // echo '</div>';
                    // echo '<div class="col-xs-4">';
                    // echo '<input type="text" class="form-control answer-txt-3-fr" placeholder="France ..." name="answer_3_'.$i.'_fr" value="'.$questions[$i]['answers'][7]['title'].'">';
                    // echo '</div>';
                    // echo '<div class="col-xs-4">';
                    // echo '<input type="text" class="form-control answer-txt-3-vn" placeholder="Vietnamese ..." name="answer_3_'.$i.'_vn" value="'.$questions[$i]['answers'][8]['title'].'">';
                    // echo '</div>';
                    // echo '</div>';
                    // // Color Answer 3
                    // echo '<div class="row">';
                		// echo '<div class="col-xs-4">';
                    // echo '<select class="select-answer-3" name="answer_color_3_'.$i.'">';
                    //
                    // for ($j = 0; $j < sizeof($colors); $j++) {
                    //   $select = '';
                    //   if ($questions[$i]['answers'][6]['color']==$colors[$j]['color'])
                    //     $select = 'selected';
                    //
                    //   echo '<option value="'.$colors[$j]['color'].'" '.$select.'>'.$colors[$j]['name'].'</option>';
                    // }
                    //
                    // echo '</select>';
                		// echo '</div>';
                		// echo '</div>';
                    // echo '</div>';

                    // Remove Button
                    echo '<span class="input-group-btn">';
                    echo '<button type="button" class="btn btn-info btn-flat remove-line">Remove Q.'.($i+1).'</button>;';
                    echo '</span>';
                    echo '</div>';
                  }
                }
              ?>
              <script>
                $('#qeCount').val(<?php echo $j?>);
                sortQuestionOrder();
                $('.my-colorpicker2').colorpicker({
                  format: "hex"
                });
              </script>
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

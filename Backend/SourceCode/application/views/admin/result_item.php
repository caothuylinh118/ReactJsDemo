<?php include 'common/header.php' ?>
<script src="<?php echo base_url(); ?>asset/js/admin/index.js"></script>
<?php include 'common/sidebar.php' ?>
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Result Item
      </h1>

    </section>

    <?php
      $resultEn = $results[0];
      $resultFr = $results[1];
      $resultVi = $results[2];
    ?>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">

          <form action="<?php echo base_url(); ?>adminResultList/update" method="post">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" name="item_id" value="<?php echo $resultEn['item_id']; ?>">
            <input type="hidden" name="old_color" value="<?php echo $resultEn['color']; ?>">
            <div class="form-group">
              <label>Result Name</label>
              <div class="row">
                <div class="col-xs-4">
                  <input type="text" class="form-control" placeholder="English ..." name="result_name_en" value="<?php echo $resultEn['name']; ?>" />
                </div>
                <div class="col-xs-4">
                  <input type="text" class="form-control" placeholder="France ..." name="result_name_fr" value="<?php echo $resultFr['name']; ?>" />
                </div>
                <div class="col-xs-4">
                  <input type="text" class="form-control" placeholder="Vietnamese ..." name="result_name_vi" value="<?php echo $resultVi['name']; ?>" />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Result Explanation</label>
              <div class="row">
                <div class="col-xs-4">
                  <textarea class="form-control" rows="3" placeholder="English ..." name="result_expl_en"><?php echo $resultEn['explanation']; ?></textarea>
                  <!-- <input type="text" class="form-control" placeholder="English ..." name="result_expl_en" /> -->
                </div>
                <div class="col-xs-4">
                  <textarea class="form-control" rows="3" placeholder="France ..." name="result_expl_fr"><?php echo $resultFr['explanation']; ?></textarea>
                  <!-- <input type="text" class="form-control" placeholder="France ..." name="result_expl_fr" value="" /> -->
                </div>
                <div class="col-xs-4">
                  <textarea class="form-control" rows="3" placeholder="Vietnamese ..." name="result_expl_vi"><?php echo $resultVi['explanation']; ?></textarea>
                  <!-- <input type="text" class="form-control" placeholder="Vietnamese ..." name="result_expl_vi" value="" /> -->
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Color</label>
              <div class="row">
                <div class="col-xs-4">
                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control answer-color-2" placeholder="Choose color ..." name="color">
                    <div class="input-group-addon">
                      <i></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <script>
              $('.my-colorpicker2').colorpicker({
                color: '<?php echo $resultEn['color']; ?>',
                format: "hex"
              });
            </script>

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

<?php include 'common/header.php' ?>
<script src="<?php echo base_url(); ?>asset/js/admin/index.js"></script>
<?php include 'common/sidebar.php' ?>
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php if (isset($type)) {
          echo "Edit Personal Type";
        } else {
          echo "New Personals Type";
        }?>
      </h1>

    </section>

    <?php
      $form_controller = "";
      $name_en = "";
      $name_fr = "";
      $name_vi = "";
      $item_id = "";
      if (isset($type)) {
        $name_en = $type[0]['type_name'];
        $name_fr = $type[1]['type_name'];
        $name_vi = $type[2]['type_name'];
        $form_controller = "updateType";
        $item_id = $type[0]['item_id'];
      } else {
        $form_controller = "addType";
      }
    ?>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">

          <form action="<?php echo base_url(); ?>adminResultList/<?= $form_controller;?>" method="post">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
            <div class="form-group">
              <label>Personal Type Name</label>
              <div class="row">
                <div class="col-xs-4">
                  <input type="text" class="form-control" placeholder="English ..." name="personal_name_en" value="<?= $name_en;?>" />
                </div>
                <div class="col-xs-4">
                  <input type="text" class="form-control" placeholder="France ..." name="personal_name_fr" value="<?= $name_fr;?>" />
                </div>
                <div class="col-xs-4">
                  <input type="text" class="form-control" placeholder="Vietnamese ..." name="personal_name_vi" value="<?= $name_vi;?>" />
                </div>
              </div>
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

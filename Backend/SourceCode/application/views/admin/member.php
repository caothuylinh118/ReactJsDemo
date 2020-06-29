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
        Member
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">

          <?php
          $isUpdate = 0;
          $name = '';
          $position = '';
          $description = '';
          $image = '';
          $isActive = '';

          if(isset($member)){
            $isUpdate = 1;
            $name = $member['name'];
            $position = $member['position'];
            $description = $member['description'];
            $image = $member['image'];
            $isActive = $member['active'];
          }
          ?>

          <?php
            if ($isUpdate == 0)
              $action = "adminMemberMaster/add";
            else
              $action = "adminMemberMaster/update";
          ?>
          <form action="<?php echo $action;?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" id="tagCount" name="tagCount" value="0">
            <!-- ==== GENERAL ITEM ====== -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Create New Member</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <!-- text input -->
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" placeholder="Name ..." name="name" value="<?php echo $name;?>">
                </div>

                <div class="form-group">
                  <label>Position</label>
                  <input type="text" class="form-control" placeholder="Position ..." name="position" value="<?php echo $position;?>">
                </div>

                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description"><?php echo trim($description);?></textarea>
                </div>

                <div class="form-group">
                  <label>Avatar</label>
                  <input type="text" class="form-control" name="currentAvatar" value="<?php echo $image;?>" readonly/>
                  <input type="file" class="form-control" name="file" id="file" />
                </div>

                <div class="form-group">
                  <label>Active</label>
                  <label>
                    <input type="checkbox" name="active" class="minimal-red" value="1" checked>
                  </label>
                </div>

              </div>
              <!-- /.box general Item -->
            </div>


            <!-- ==== TAG ITEM ====== -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">TAG</h3>
                <button id="add_tag" type="button" style="margin-left:100px"class="btn btn-primary">Add New</button>
              </div>
              <!-- /.box-header -->
              <div class="box-body"  id="tag_body">
                <?php
                $i = 0;
                if (isset($tag)){
                  foreach ($tag as $item){
                    $i++;
                    echo '<div class="input-group margin">';
                    echo '<input type="text" name="tag_item_' . $i . '" class="form-control tag_item" placeholder="Tag ..." value="' . $item['content']  . '">';
                    echo '<span class="input-group-btn">';
                    echo '<button type="button" class="btn btn-info btn-flat remove-line_tm">X</button>';
                    echo '</span>';
                    echo '</div>';
                  }
                }
                ?>
                <script>
                $('#tagCount').val(<?php echo $i?>);
                sortTag();
                </script>
              </div>
              <!-- /.box DESCRIPTION Item -->
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

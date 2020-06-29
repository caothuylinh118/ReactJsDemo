<?php include 'common/header.php' ?>

<div class="container">
  <section class="content01 chapter">

    <div class="row">
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-12">
            <?php echo $this->lang->line('quick_access');?>
            <br/>
            <br/>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <center>
              <a href="<?php echo $authURL_FB;?>" class="fa fa-facebook"></a>
              <a href="<?php echo $authURL_Twitter;?>" class="fa fa-twitter"></a>
              <a href="<?php echo $authURL_google;?>" class="fa fa-google"></a>
              <a href="<?php echo $authURL_linkedin;?>" class="fa fa-linkedin"></a>
            </center>
          </div>
        </div>
        <br/>
        <br/>
        <?php echo $this->lang->line('user_personal_acc');?>
        <br/>
        <br/>
        <form action="<?php echo base_url(); ?>/register/doRegister" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('first_name');?></label>
            <input type="text" class="form-control" id=""  placeholder="<?php echo $this->lang->line('enter_first_name');?>" name="first-name">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('last_name');?></label>
            <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="<?php echo $this->lang->line('enter_last_name');?>" name="last-name">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('email');?></label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo $this->lang->line('enter_email');?>" name="email">
            <small id="emailHelp" class="form-text text-muted"><?php echo $this->lang->line('not_share');?></small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1"><?php echo $this->lang->line('password');?></label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="<?php echo $this->lang->line('password');?>" name="password">
          </div>
          <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('register');?></button>
        </form>
      </div>
    </div>
  </section>

</div>
</body>
</html>

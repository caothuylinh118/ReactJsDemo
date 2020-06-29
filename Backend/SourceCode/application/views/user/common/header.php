<!DOCTYPE html>
    <html lang="en">
    <head>
      <title><?php echo $title; ?></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="<?php echo base_url(); ?>asset/css/homepage/index.css" rel="stylesheet">

    </head>

    <body id="<?php echo $id_page; ?>">
      <header>
        <div class="container">

          <div class="row header">
            <div class="header_logo"><img src="<?php echo base_url(); ?>asset/img/home/logo.png" alt="logo" class="logo">Z</div>
            <div class="header_nav">
              <nav class="navbar">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('home');?></a></li>
                    <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $this->lang->line('take_test');?>
                      <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <?php
                        for ($i = 0; $i < sizeof($tests); $i++) {
                          $cipherID = encrypted($tests[$i]['item_id']);
                          echo '<li><a href="'.base_url().'tests?test_id='.$cipherID.'&&type_id='.$tests[$i]['type'].'">'.$tests[$i]['title'].'</a></li>';
                        }
                        ?>
                      </ul>
                    </li>
                    <?php if (isset($user)) {?>
                      <li class="active"><a href="<?php echo base_url()."history"; ?>"><?php echo $this->lang->line('my_score');?></a></li>
                      <li class="active"><a href="<?php echo base_url(); ?>logout"><?php echo $this->lang->line('logout');?></a></li>
                    <?php
                    } else {
                    ?>
                    <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $this->lang->line('login_register');?>
                      <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url(); ?>login"><?php echo $this->lang->line('login');?></a></li>
                        <li><a href="<?php echo base_url(); ?>register"><?php echo $this->lang->line('register');?></a></li>
                      </ul>
                    </li>
                    <li class="active"><a href="<?php echo base_url().'privacyPolicy'; ?>"><?php echo $this->lang->line('privacy_policy');?></a></li>
                    <?php
                    }?>


                  </ul>
                  <ul class="language">
                    <li><a href="<?php echo base_url(); ?>?lang=en"><img src="<?php echo base_url(); ?>asset/img/home/great-britain.png" alt=""></a></li>
                    <li><a href="<?php echo base_url(); ?>?lang=fr"><img src="<?php echo base_url(); ?>asset/img/home/france.png" alt=""></a></li>
                    <li><a href="<?php echo base_url(); ?>?lang=vi"><img src="<?php echo base_url(); ?>asset/img/home/vietnam.png" alt=""></a></li>
                  </ul>
              </nav>
            </div>
          </div>
        </div>
      </header>

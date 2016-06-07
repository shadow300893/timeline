<!DOCTYPE html>
<html>
<!--
#Author Name : Sahil Gheek
-->
<head>
	<title>Edit User Details</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
     
	body{
		background: url('<?= base_url() ?>../assets/img/web_bg.jpg');
	}
	.mode{
		margin-top : 75px;
    }
	.logo{
        color: darkgrey;
    }
    </style>
</head>
<body>
<div class="container">
     <div class="row">
          <div class="col-lg-6 col-sm-6">
               <h1 class="logo">Timeline.In</h1>
          </div>
          <div class="col-lg-6 col-sm-6">
               <ul class="nav nav-pills pull-right" style="margin-top:20px">
                    <li class="active"><a href="<?= base_url(); ?>home">Home</a></li>
               </ul>
          </div>
     </div>
</div>
<hr/>
<div class="container mode">
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Edit Profile</h4>
            </div>
            <div class="panel-body">
                <?php $attributes = array("name" => "editform");
                echo form_open("edit/edit_data", $attributes);
				$data = $this->edit_model->get_user($this->session->userdata['log_id']);
				?>
                <div class="form-group">
                    <label for="name">User Name</label>
                    <input class="form-control" name="username" placeholder="User Name" type="text" value="<?php echo $data['username']; ?>" />
                    <span class="text-danger"><?php echo form_error('username'); ?></span>
                </div>

                
                <div class="form-group">
                    <label for="email">Email ID</label>
                    <input class="form-control" name="email" placeholder="Email-ID" type="text" value="<?php echo $data['email']; ?>" />
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                </div>

                <div class="form-group">
                    <label for="subject">Password</label>
                    <input class="form-control" name="password" placeholder="Password" type="password" value="<?php echo $data['password']; ?>"/>
                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                </div>

                <div class="form-group">
                    <label for="subject">Confirm Password</label>
                    <input class="form-control" name="cpassword" placeholder="Confirm Password" type="password" value="<?php echo $data['password']; ?>"/>
                    <span class="text-danger"><?php echo form_error('cpassword'); ?></span>
                </div>

                <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-primary">Edit</button>
                    <button name="cancel" type="reset" class="btn btn-default">Cancel</button>
                </div>
                <?php echo form_close(); ?>
                <?php echo $this->session->flashdata('msg'); ?>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
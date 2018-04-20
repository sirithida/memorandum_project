<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>HR SYSTEM</title>

     <link href="<?php echo base_url("vendors/bootstrap/dist/css/bootstrap.min.css");?>" rel="stylesheet">
     <link href="<?php echo base_url("css/main.css");?>" rel="stylesheet">
</head>
<body>
<br/><br/>
  <div class="container">
          <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
              <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Login</div>
                </div>

                <div style="padding-top:30px" class="panel-body" >

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                      <?php echo form_open("form_controller", array("id"=>"loginform" ,"class"=>"form-horizontal")); ?>
                          <div style="margin-bottom: 20px" class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                              <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username">
                          </div>

                          <div style="margin-bottom: 20px" class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                              <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                          </div>

                          <div class="col-sm-6 col-sm-offset-3">
    												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Login">
    											</div>
                      </form>
                    </div>
                </div>
          </div>


<!--load jQuery library-->
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<!--load bootstrap.js-->
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
</body>
</html>

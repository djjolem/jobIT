<?php 
  session_start(); 
?>


<!-- Menu -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="container container-fluid">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header>"
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">
      ShList 
    </a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li class=""><a href="index.php"><strong>List Ads</strong></a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li><a href="newad.php"><strong>New Ad</strong></a></li>
        <?php 
          $signedIn = isset($_SESSION['signedin']) && $_SESSION['signedin'];
          if ($signedIn){
        ?>
        
        <li class="dropdown">
          <a data-toggle="dropdown"> 
            <?php echo $_SESSION['user_name']; ?> &nbsp;
            <img class="pull-right img-responsive img-circle" src="http://placehold.it/32x32" alt="User" />
          </a>
          
          <ul class="dropdown-menu"  data-no-collapse="true">
            <li>
              <a href="#" onclick="submitForm('user_settings')">Settings</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="#"  onclick="submitForm('user_signout');">Sign out</a>
            </li>
          </ul>  
        </li>

      <?php
        } else {
      ?>
      <li class="dropdown">
        <a class="btn btn-default btn-block" href="#signin" data-toggle="modal" data-target="#myModalMenu">
          Sign In/Sign up
        </a>
      </li>
      <?php } ?>
    </ul>
  </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>

<div class="">&nbsp;</div>
<div class="">&nbsp;</div>
<div class="">&nbsp;</div>
<div class="">&nbsp;</div>
<div class="">&nbsp;</div>


<!-- Modal -->
<div class="modal fade bs-modal-sm" id="myModalMenu" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <br>
      <div class="bs-example bs-example-tabs">
        <ul id="myTab" class="nav nav-tabs">
          <li class="active"><a href="#signin" data-toggle="tab">Sign In</a></li>
          <li class=""><a href="#pass" data-toggle="tab"> Forgot password </a></li>
          <li class=""><a href="#signup" data-toggle="tab">Sign up</a></li>
          <li class=""><a href="#why" data-toggle="tab">Why?</a></li>
        </ul>
      </div>

      <div class="modal-body">
        <div id="myTabContent" class="tab-content">
          
          
          <div class="tab-pane fade active in" id="signin">  
            <form class="form-horizontal" role="from" id="sign_in" name="sign_in" action="signinup.php" method="post">
              <fieldset>
                <!-- Sign In Form -->
                <!-- Text input-->
                <div class="control-group">
                  <label class="control-label" for="userid">Alias</label>
                  <div class="controls">
                    <input required="" id="userid" name="userid" type="text" class="form-control" placeholder="Username or email" class="input-medium" required="">
                  </div>
                </div>
                <!-- Password input-->
                <div class="control-group">
                  <label class="control-label" for="passwordinput">Password</label>
                  <div class="controls">
                    <input required="" id="passwordinput" name="passwordinput" class="form-control" type="password" placeholder="********" class="input-medium">
                  </div>
                </div>

                <!-- Multiple Checkboxes (inline) -->
                <div class="control-group">
                  <div class="controls">
                    <label class="checkbox inline" for="rememberme-0">
                      <input type="checkbox" name="rememberme" id="rememberme-0" value="Remember me">
                        Remember me
                    </label>
                  </div>
                </div>
                <!-- Button -->
                <div class="control-group">
                  <label class="control-label" for="signin"></label>
                  <div class="controls">
                    <button id="signin" name="signin" value="signin" class="btn btn-success">Sign In</button>
                  </div>
                  <a href="recover.php">Forgot you password</a>
                </div>
              </fieldset>
            </form>
          </div>

          <div class="tab-pane fade" id="signup">
            <form class="form-horizontal" role="form" id="new_user" name="new_user" action="signinup.php" method="post">
              <fieldset>
                <!-- Sign Up Form -->
                <!-- Text input-->
                <div class="control-group">
                  <label class="control-label" for="email">Email</label>
                  <div class="controls">
                    <input id="email" name="email" class="form-control" type="text" placeholder="Email" class="input-large" required="">
                  </div>
                </div>
                
                <!-- Text input-->
                <div class="control-group">
                  <label class="control-label" for="userid">Alias</label>
                  <div class="controls"> 
                    <input id="userid" name="userid" class="form-control" type="text" placeholder="Username" class="input-large" required="">
                  </div>
                </div>
                
                <!-- Password input-->
                <div class="control-group">
                  <label class="control-label" for="password">Password</label>
                  <div class="controls">
                    <input id="password" name="password" class="form-control" type="password" placeholder="********" class="input-large" required="">
                      <small><em>1-8 Characters</em></small>
                  </div>
                </div>
                
                <!-- Text input-->
                <div class="control-group">
                  <label class="control-label" for="reenterpassword">Confirm password</label>
                  <div class="controls">
                    <input id="reenterpassword" class="form-control" name="reenterpassword" type="password" placeholder="********" class="input-large" required="">
                  </div>
                </div>
                    
                <!-- Button -->
                <div class="control-group">
                  <label class="control-label" for="signup"></label>
                  <div class="controls">
                    <button id="signup" name="signup" value="signup" class="btn btn-success">Sign Up</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>

          <div class="tab-pane fade" id="pass">
            <form class="form-horizontal" role="from" id="forgot_pass" name="forgot_pass" action="recover.php" method="post" >
              <fieldset>
                <!-- Text input-->
                <div class="control-group">
                  <label class="control-label" for="email"> Email </label>
                  <div class="controls">
                    <input id="email" name="email" class="form-control" type="text" placeholder="Email" class="input-large" required="">
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label"> Or </label>
                </div>

                <!-- Text input-->
                <div class="control-group">
                  <label class="control-label" for="email"> Alias </label>
                  <div class="controls">
                    <input id="alias" name="alias" class="form-control" type="text" placeholder="Alias" class="input-large" required="">
                  </div>
                </div>

                <!-- Button -->
                <div class="control-group">
                  <label class="control-label" for="signup"></label>
                  <div class="controls">
                    <button id="signup" name="signup" value="signup" class="btn btn-success">Submit</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>

          <div class="tab-pane fade in" id="why">
            <p>We need this information so that you can receive access to the site and its content. Rest assured your information will not be sold, traded, or given to anyone.</p>
            <p></p><br> Please contact us at <a href="mailto:example@djole.com">email</a> for any other inquiries.</p>
          </div>

        </div>
      </div>

      <div class="modal-footer">
        <center>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </center>
      </div>

    </div>
  </div>
</div>

<form class="form-horizontal" role="form" id="user_settings" name="user_settings" action="settings.php" method="post">
  <input type="hidden" name="settings" value="settings"/>
</form>
<form class="form-horizontal" role="form" id="user_signout" name="user_signout" action="signinup.php" method="post">
  <input type="hidden" name="signout" value="signout" />
</form>

<script type="text/javascript">

  var submitForm = function(formName){
    document.getElementById(formName).submit();
  }

</script>


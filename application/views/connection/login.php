<!--
   This page for form login .
   This page can see user and administrator.
-->
<script type="text/javascript">
    (function () {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = 'https://plus.google.com/js/client:plusone.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
    })();
</script>
<p class="clearfix"></p>
<p class="clearfix"></p>
<p class="clearfix"></p>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <img src="<?php echo base_url(); ?>assets/images/logo.png" class="center-block"
             style="width: 225px; height: 100px;"
             alt="PNC Library"> 
    </div>
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default" style="margin-top: 5%;">   
            <div class="panel-heading">
                <?php if ($classic_form_enabled === TRUE) { ?>
                    <h3 class="panel-title">Please Sign In or <a href="<?php echo base_url(); ?>connection/register">register here</a></h3>
                <?php } else { ?>         
                    <h3 class="panel-title">Please login with your Google Account</h3>
                <?php } ?>    
            </div>
            <div class="panel-body">
                <?php echo $flash_partial_view; ?>
                <!-- Display the 'normal' login system only if the OAUTH mechanism is not activated in config -->
                <?php if ($classic_form_enabled === TRUE) { ?>		  
                    <?php echo validation_errors(); ?>
                    <?php
                    $attributes = array('id' => 'loginFrom', 'class' => '');
                    echo form_open('connection/login', $attributes);
                    ?>
                    <input type="hidden" name="last_page" value="connection/login" />
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Login" autofocus="" name="login" id="login" value="<?php echo set_value('login'); ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" id="password" value="" type="password">
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <button id="send" class="btn btn-lg btn-success btn-block">Login</button>  
<?php } if ($oauth2_enabled === TRUE) { ?>         
                        <a href="<?php echo base_url(); ?>connection/googleLogin" class="btn btn-lg btn-block btn-social btn-google">
                            <i class="fa fa-google"></i> Sign in with Google
                        </a>    
<?php } ?>                                
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
<script type="text/javascript">
      $(function () {
          //If the user has forgotten his password, send an e-mail
          $('#cmdForgetPassword').click(function () {
              if ($('#login').val() == "") {
                  bootbox.alert("Please fill the login field");
              } else {
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>connection/forgetpassword",
                      data: {login: $('#login').val()}
                  })
                          .done(function (msg) {
                              switch (msg) {
                                  case "OK":
                                      bootbox.alert("The password has been sent to your e-mail adress.");
                                      break;
                                  case "UNKNOWN":
                                      bootbox.alert("Invalid login id or password");
                                      break;
                              }
                          });
              }
          });
          //Validate the form if the user press enter key in password field
          $('#password').keypress(function (e) {
              if (e.keyCode == 13)
                  $('#loginFrom').submit();
          });
      });
</script>
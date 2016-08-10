<?php
/**
 * This view contains a form to create a new user
 * @copyright  Copyright (c) 2016 Benoit Pitet
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>

<div class="container-fluid" id="wrap">

<div class="row-fluid">
    <div class="col-md-12">

<h1>Create your account</h1>

<?php echo validation_errors(); ?>

<?php
$attributes = array('id' => 'target', 'class' => 'form-horizontal');

echo form_open('connection/register', $attributes); ?>
    
       <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="firstname" id="firstname" required />
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="lastname" id="lastname" required />
            </div>
        </div>

        <div class="form-group">
            <label for="login" class="col-sm-2 control-label">Login</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="login" id="login" required />
                <div class="alert alert-info" role="alert" id="lblLoginAlert">
                    <button type="button" class="close" onclick="$('#lblLoginAlert').hide();">&times;</button>
                    This username is not available.
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" required />
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-8">
                    <input class="form-control" type="password" name="password" id="password" required />
            </div>
        </div>
        
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Retype password</label>
            <div class="col-sm-8">
                    <input class="form-control" type="password" name="password2" id="password2" required />
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="send" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;Create</button>
                &nbsp;
                <a href="<?php echo base_url(); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</a>
             </div>
        </div>
    </form>
    </div>
</div>

</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
<script type="text/javascript">

    function validate_form() {
        result = false;
        var fieldname = "";
        if ($('#firstname').val() == "") fieldname = "firstname";
        if ($('#lastname').val() == "") fieldname = "lastname";
        if ($('#login').val() == "") fieldname = "login";
        if ($('#email').val() == "") fieldname = "email";
        if ($('#password').val() == "") fieldname = "password";
         if ($('#password2').val() == "") fieldname = "password2";
        if (fieldname == "") {
            return true;
        } else {
            bootbox.alert("The field " + fieldname + " is mandatory.");
            return false;
        }
    }
    
    
    $(function () {
        $("#lblLoginAlert").hide();
        
        
        
        //Check if the login already exists
        $("#login").change(function() {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>connection/check/login",
                data: { login: $("#login").val() }
                })
                .done(function( msg ) {
                    if (msg == "true") {
                        $("#lblLoginAlert").hide();
                    } else {
                        $("#lblLoginAlert").show();
                    }
                });
        });
        
        $('#send').click(function() {
            if (validate_form() == false) {
                //Error of validation
            } else {
                $("#target").submit();
            }
        });
    });
</script>

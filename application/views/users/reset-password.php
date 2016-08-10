<!--
   This page for reset password .
   This page can see only administrator.
-->
<div class="container-fluid" id="wrap">
	<!-- Form info -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"> Reset password of user :  <?php echo $users_item['login'];?>
						</div>
				<div class="panel-body">
					<div class="col-lg-12">
						 <?php echo validation_errors(); ?>
                        <?php 
                        $attributes = array('id' => 'frmUserForm', 'class' => 'form-horizontal');
                        echo form_open('users/resetpassword/'. $target_user_id , $attributes);?>
							<input type="hidden" name="id" value="<?php echo $target_user_id; ?>" required />
                            <input type="password" autocomplete="off" placeholder="New Password" id="password1" name="password1" class="input-lg form-control">
                            <input type="password" autocomplete="off" placeholder="Repeat New Password" id="password2" name="password2" class="input-lg form-control">
                            <input id="btn-submit" type="submit" value="Change Password" data-loading-text="Changing Password..." class="col-xs-12 btn btn-primary btn-load btn-lg">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
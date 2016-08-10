<!--
   This page for show form .
   This page can see only administrator.
-->
<div class="row">       
        <input type="hidden" name="id" value="<?php echo $users_item['id']; ?>" required />
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">Firstname</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="firstname" value="<?php echo $users_item['firstname']; ?>" readonly />
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">Lastname</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="lastname" value="<?php echo $users_item['lastname']; ?>" readonly />
            </div>
        </div>
        <div class="form-group">
            <label for="login" class="col-sm-2 control-label">Login</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="login" name="login" value="<?php echo $users_item['login']; ?>" readonly />
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">E-mail</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $users_item['email']; ?>" readonly />
            </div>
        </div>
</div>
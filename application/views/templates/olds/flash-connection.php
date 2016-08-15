<?php 
/**
 * This partial view displays an alert message
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/karthanea
 * @since      0.1.0
 */
?>
<?php if($this->session->flashdata('msg')){ ?>
<div class="alert alert-info" role="alert" id="flashbox">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
  <?php echo $this->session->flashdata('msg'); ?>
</div>
<script type="text/javascript">
//Flash message
$(function () {
    $("#flashbox").alert();
});
</script>
<?php 
} 
?>

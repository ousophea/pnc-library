<!--
   This page for show form add new book .
   This page can see only administrator.
-->
<div class="container-fluid" id="wrap">
	<div class="col-lg-12  ">
		<h3 class="page-header text-danger">
			<a href="#" data-toggle="popover" 
				title="Books" 
				data-trigger="hover"
				data-content="You can add new book by form below.">
				<i class="fa fa-book"></i>&nbsp;Resquest New Books
			</a>
		</h3>
            
		<a href="<?php echo base_url();?>request/showAllrequest" data-content="you want to see list all new books request." data-trigger="hover" data-toggle="popover" title="List all new books request" class="btn btn-info">
			<span class="badge"><?php echo $numberRequest; ?></span>&nbsp;New books request
		</a>
	</div>
    <p class="clearfix"></p>
	<!-- Form info -->
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-solid box-default panel-sm">
				<div class="box-header text-center"> Book Resquest </div>
				<div class="box-body">
				   <?php 
				   // for form open form
                        $attributes = array('id' => 'frmAddBookForm', 'class' => 'form-horizontal');
                        echo form_open('Request/requestBook', $attributes);?>
					<div class="col-xs-6 panel-spacing">
					<!-- for Khmer title -->
							<div class="form-group">
								<label>Title (EN)</label>			
								<input name="title_en" class="form-control" placeholder="English title" value="<?php echo set_value('title_en'); ?>"/>
							</div>
					<!-- for English title -->
							<div class="form-group">
								<label>Title (KH)</label>			
								<input name="title_kh" class="form-control" placeholder="Khmer title" value="<?php echo set_value('title_kh'); ?>"/>
							</div>
					</div>
					<div class="col-xs-6 panel-spacing">
							<div class="form-group">
								<label>Author(s)</label>
								<input name="authors" class="form-control" placeholder="Authors" value="<?php echo set_value('authors'); ?>">
							</div>
					<!-- for choosing language -->
							<div class="form-group">
								<label>Language</label>
								<select name="language" class="form-control" value="<?php echo set_value('language'); ?>">
										<option value="English">English</option>
										<option value="Khmer">Khmer</option>                           
								</select>
							</div>
                    </div>
                    <div class="col-xs-12">
							<!-- for description -->
							<div class="form-group">
								<label>Description<i class="text-danger">*</i></label>
								<textarea name="description_en" class="form-control" placeholder="English description" required><?php echo set_value('description_en'); ?></textarea>
								<span class="text-danger">
									<?php echo form_error('description_en'); ?>
								</span>
							</div>
					</div>
				</div>
				<div class="box-footer">
					<!-- for sending or cancel buttons -->
                    <div class="form-group">
                        <button id="send" type="submit" class="btn btn-primary">Request now</button> 
						<button onclick="window.history.back();" type="button" class="pull-right btn btn-warning"><i class="fa fa-undo" aria-hidden="true"></i>&nbsp;Cancel</button>
                    </div>
				</div>
				<?php 
					// close form
					echo form_close();
				?>
			</div>
		</div>
	</div>
</div>
<!-- form style of form -->
<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>
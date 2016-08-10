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
				<i class="fa fa-book"></i>&nbsp;Add new book
			</a>
		</h3>
	</div>
    <p class="clearfix"></p>
	<!-- Form info -->
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-solid box-info panel-md">
				<div class="box-header text-center"> Book information </div>
				<div class="box-body">
				   <?php 
				   // for form open form
                        $attributes = array('id' => 'frmAddBookForm', 'class' => 'form-horizontal');
                        echo form_open('books/add', $attributes);?>
					<div class="col-xs-4 panel-spacing">
					<div class="form-group">
								<label>Book Type<i class="text-danger">*</i></label>
								<select name="bookTYpe" id="booktype_id" class="form-control" value="<?php echo set_value('bookTYpe'); ?>">
									<option value="1" id="simple-book">Simple Book</option>	
									<option value="2" id="E-book">E-Book</option>	
                                </select>
								
					</div>
					
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
							<!-- for form Pulisher -->
							<div class="form-group" id="publisher">
								<label>Publisher<i class="text-danger">*</i></label>
								<input name="publisher"  class="form-control" placeholder="Publisher" value="<?php echo set_value('publisher'); ?>"  />
								<span class="text-danger">
								<?php echo form_error('publisher'); ?>
								</span>
							</div>
							<!-- for form condition -->
							<div class="form-group" id="condition" >
								<label>Condition<i class="text-danger">*</i></label>
								<select name="condition_id" class="form-control" value="<?php echo set_value('condition_id'); ?>" >
									<?php 
                                        foreach ($condition as $value) {
                                    ?>
                                    <option value="<?php echo $value->con_id; ?>">
                                        <?php echo $value->con_name; ?>
                                    </option>
                                    <?php
                                        }
                                    ?>                          
								</select>
							</div>
							<div class="form-group" id="author">
								<label>Author(s)<i class="text-danger">*</i></label>
								<input name="authors" class="form-control"  placeholder="Authors" value="<?php echo set_value('authors'); ?>" >
								<span class="text-danger">
									<?php echo form_error('authors'); ?>
								</span>
							</div>
					
					</div>
					<div class="col-xs-4 panel-spacing">
					<!-- for category -->
							<div class="form-group">
								<label>Category<i class="text-danger">*</i></label>
								<select name="categ_id" class="form-control" value="<?php echo set_value('categ_id'); ?>">
									<?php 
                                        foreach ($cate_label as $value) {
                                    ?>
                                        <option value="<?php echo $value->cat_id; ?>">
                                            <?php echo $value->cat_name; ?>
                                        </option>
                                    <?php
                                        }
                                    ?>
								</select>
							</div>
					<div class="form-group" id="label">
							<label><a href="#" data-toggle="popover" 
								title="ENG: first 3 letters of author" 
								data-trigger="hover"
								data-content="KH: fill family name of author.">
								&nbsp;Label Input
							</a><i class="text-danger">*</i></label>
								<input name="label" class="form-control"  placeholder="EN: 3 letters/KH: family name" value="<?php echo set_value('label'); ?>"  />
								<span class="text-danger">
								<?php echo form_error('label'); ?>
								</span>
							</div>
							
							<div class="form-group" id="sta_id">
							   <label>Status<i class="text-danger">*</i></label>
							  <select name="status_id" class="form-control" value="<?php echo set_value('status_id'); ?>">
							   <?php 
									foreach ($status as $value) {
								?>
									<option value="<?php echo $value->sta_id; ?>">
									    <?php echo $value->sta_name; ?>
									</option>
									<?php
									}
									?>
								</select>
						   </div>
							<!-- for year form -->
							<div class="form-group" id="year">
								<label>Year</label>
								<input name="year" class="form-control"  placeholder="Year" value="<?php echo set_value('year'); ?>"  >
								<span class="text-danger">
									<?php echo form_error('year'); ?>
								</span>
							</div>
							<!-- for description -->
							<div class="form-group">
								<label>Description (EN)</label>
								<textarea name="description_en" class="form-control" placeholder="English description"><?php echo set_value('description_en'); ?></textarea>
							</div>
                    </div>
					<div class="col-xs-4 panel-spacing" id="col-3">
							<!-- for choosing language -->
							<div class="form-group">
								<label>Language</label>
								<select name="language" class="form-control" value="<?php echo set_value('language'); ?>">
										<option value="English">English</option>
										<option value="Khmer">Khmer</option>                           
								</select>
							</div>
						    <div class="form-group" id="keyword">
								<label>Keyword</label>
								<input name="keyword" class="form-control"  placeholder="Keyword" value="<?php echo set_value('keyword'); ?>"  />
								<span class="text-danger">
								<?php echo form_error('keyword'); ?>
								</span>
							</div>
					
					<!-- for form ISBN -->
							<div class="form-group" id="isbn">
								<label>ISBN</label>			
								<input name="isbn" class="form-control" placeholder="ISBN-13: 978-1-56619-909-4 OR ISBN-10: 1-56619-909-3" value="<?php echo set_value('isbn'); ?>"/>
							</div>
					<!-- for form Barcode -->
                            <div class="form-group" id="barcode">
								<label>Barcode<i class="text-danger">*</i></label>			
								<input name="barcode" class="form-control"  placeholder="01234567890123" value="<?php echo set_value('barcode'); ?>" />
								<span class="text-danger">
									<?php echo form_error('barcode'); ?>
								</span>
							</div>
							<div class="form-group">
								<label>Comment (EN)</label>
								<textarea name="comment" class="form-control" placeholder="English Comment"><?php echo set_value('comment'); ?></textarea>
							</div>
                        </div>   
					</div>
				<div class="box-footer">
					<!-- for sending or cancel buttons -->
                    <div class="form-group">
                        <button id="send" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;Record book</button> 
						<button onclick="window.history.back();" type="button" class="pull-right btn btn-warning"><span class="glyphicon glyphicon-floppy-remove">&nbsp;Cancel</span></button>
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
	</div>
</div>
<!-- form style of form -->
<script type="text/javascript">
$(document).ready(function(){
	$('#booktype_id').change(function(){
		
		
		function displayVals() {
		  var books = $( "#booktype_id" ).val();
		  if(books == 1){
			$('#barcode').show();
			$('#barcode').attr("required", "true");
			$('#condition').show();
			$('#condition').attr("required", "true");
			$('#publisher').show();
			$('#publisher').attr("required", "true");
			$('#author').show();
			$('#author').attr("required", "true");
			$('#label').show();
			$('#label').attr("required", "true");
			$('#isbn').show();
			$('#isbn').attr("required", "true");
			$('#sta_id').show();
			$('#sta_id').attr("required", "true");
		}else if(books == 2){
			$('#barcode').hide();
			$('#barcode').removeAttr('required');
			$('#condition').hide();
			$('#condition').removeAttr('required');
			$('#publisher').hide();
			$('#publisher').removeAttr('required');
			$('#author').hide();
			$('#author').removeAttr('required');
			$('#label').hide();
			$('#label').removeAttr('required');
			$('#isbn').hide();	
			$('#isbn').removeAttr('required');
			$('#sta_id').hide();	
			$('#sta_id').removeAttr('required');
		}
		}
		$( "select" ).change( displayVals );
		displayVals();
	});
	
	$('[data-toggle="popover"]').popover();   
});
 
</script>

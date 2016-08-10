<!--
   This page for show form edit book .
   This page can see only administrator.
-->
<div class="container-fluid" id="wrap">
	<div class="col-lg-12  ">
		      <h3 class="page-header text-danger">
			  <a href="#" data-toggle="popover" 
				title="Books" 
				data-trigger="hover"
				data-content="You can edit book by form below.">
				<i class="fa fa-book"></i>&nbsp;Edit Book
				</a>
			 </h3>
	</div>
</div>
	<p class="clearfix"></p>
	<!-- Form info -->
<div class="container-fluid" id="wrap">
	<div class="box box-solid box-default panel-md  " id="edit" >
		<div class="box-header text-center"> Book information </div>
			<div class="box-body">
			 <div class="row">
				<div class="col-xs-4">
					<!-- for set oepen form and fetch array -->
						<?php echo validation_errors(); ?>
						<?php 
						foreach ($edit_books->result() as $edit)
						{
						?>
                        <?php 
							$attributes = array('id' => 'frmAddBookForm', 'class' => 'form-horizontal');
							echo form_open("books/update/".$edit->b_id, $attributes);
						?>
							<div class="form-group">
								<label>Category</label>
								<select onChange="changeCat()" name="categ_id" class="form-control" id="catId">
								<?php foreach($category as $value) {?>  
									<option value="<?php echo $value->cat_id.' '.$value->categoryId;?>"><?php echo $value->cat_name;?></option>    
								<?php }?>
								</select>
							</div>
							<div class="form-group">
								<label>Title (EN)</label>			
								<input name="title_en" class="form-control" placeholder="English title" value="<?php echo $edit->b_title_en; ?>"/>
							</div>
							<div class="form-group">
								<label>Title (KH)</label>			
								<input name="title_kh" class="form-control" placeholder="Khmer title" value="<?php echo $edit->b_title_kh; ?>" />
							</div>
							<div class="form-group">
								<label>keyword</label>
								<input name="keyword" class="form-control" value="<?php echo $edit->b_keyword; ?>" placeholder="Keyword" required  />
							</div>
						<div class="form-group">
							<label>Publisher</label>
							<input name="publisher" class="form-control" value="<?php echo $edit->b_publisher; ?>" placeholder="Publisher" required  />
						</div>
					</div>
					<div class="col-xs-4">
						<div class="form-group">
								<label>Category ID</label>
								<input id="categoryId" name="categoryId" class="form-control" placeholder="Category ID" value="<?php echo $edit->categoryId; ?>" required disabled/>
							</div>
							<div class="form-group">
								<label>Label</label>
								<input id="la" name="la" class="form-control" placeholder="Label" value="<?php echo $edit->categoryId."-".$edit->b_label; ?>" required disabled/>
							</div>
							<div class="form-group">
								<label>Year</label>
								<input name="years" class="form-control" value="<?php echo $edit->b_year;?>" placeholder="Year" required/>
							</div>
							<div class="form-group">
								<label>Language</label>
								<select name="language" class="form-control" required>
									<option value="en">English</option>
									<option value="kh">Khmer</option>                    
								</select>
							</div>
								<div class="form-group">
								<label>Author(s)</label>
								<input name="authors" class="form-control" value="<?php echo $edit->b_author; ?>" placeholder="Authors" required/>
							</div>	
					</div>
				<div class="col-xs-4">
					<div class="form-group">
						<label><a href="#" data-toggle="popover" 
									title="English: First 3 letters of Author" 
									data-trigger="hover"
									data-content="Khmer: fill Family Name of Author.">
									&nbsp;Label Input
							</a></label>
						<input onkeyup="showLabel()" id="label" name="label" class="form-control" placeholder="ENG:3 letters/KH:family name" value="<?php echo $edit->b_label; ?>" required />
					</div>
					<div class="form-group">
						<label>Status</label>
						<select name="status_id" class="form-control" required  >
							<?php foreach($status as $status_value){?>
								<option value="<?php echo $status_value->sta_id;?>"><?php echo $status_value->sta_name;?></option> 
							<?php } ?>                                                   
						</select>
					</div>		
				<div class="form-group">
					<label>Condition</label>
					<select name="condition_id" class="form-control" >
						<?php foreach($condition as $condit_value){?>
							<option value="<?php echo $condit_value->con_id;?>"><?php echo $condit_value->con_name;?></option> 
									<?php } ?>
					</select>
				</div>							
				<div class="form-group">
					<label>ISBN</label>			
						<input name="isbn" class="form-control" placeholder="ISBN-13: 978-1-56619-909-4 OR ISBN-10: 1-56619-909-3" value="<?php echo $edit->b_isbn; ?>"/>
				</div>
                <div class="form-group">
					<label>Barcode</label>			
					<input name="barcode" class="form-control" placeholder="01234567890123"  value="<?php echo $edit->b_barcode; ?>" required />
				</div>
			</div>
		</div>
		<div class="row">
			   <div class="col-xs-6">
					<div class="form-group">
						<label>Description </label>
						<textarea name="description" class="form-control " id="textarea-h" rows="5" placeholder="description"><?php echo $edit->b_description;?></textarea>
					</div>
			   </div>
			<div class="col-xs-6">
				<div class="form-group">
					<label>Comment </label>
					<textarea name="comment" class="form-control " id="textarea-h" rows="5" placeholder="English Comment"><?php echo $edit->b_comment; ?></textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<div class="form-group "> 
			<button id="send" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;Save changes</button>
			<button onclick="window.history.back()"  class="btn btn-info pull-right"><span class="glyphicon glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</button>			
		</div>
	</div>
</div>
		<?php
			}// end loop
			echo form_close();//close form
		?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
	function changeCat(){
		var catid = document.getElementById('catId').value;
		var result = catid.substr(catid.indexOf(" ") + 1);
		document.getElementById('categoryId').value=result;
	}
	function showLabel(){
		var label = document.getElementById('label').value;
		var catid = document.getElementById('categoryId').value;
		document.getElementById('la').value=catid+'-'+label;
	}
</script>
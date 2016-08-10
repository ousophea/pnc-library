<!-- for form alert modal -->
					<div id="return_book" class="modal fade" role="dialog">
					  <div class="modal-dialog modal-md">
						<!-- Modal content-->
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title text-center">Return Book</h4>
						  </div>
						  <div class="modal-body">
							<form action="">
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
										<label for="">Borrower<i class="text-danger">*</i></label>
										<input type="text" class="form-control" placeholder="borrower name" />
									</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
										<label for="">Book name<i class="text-danger">*</i></label>
										<input type="text" class="form-control" placeholder="book name" />
									</div>
									</div>
								</div>
								<div class="row">
								  <div class="col-xs-12">
									<div class="form-group">
										<label>Condition<i class="text-danger">*</i></label>
										<select name="return" class="form-control" required  >								
											<option value="<?php echo "some"?>">
												<?php echo "value1";?>
											</option>
											<option value="<?php echo "some"?>">
												<?php echo "value2";?>
											</option>  									
										</select>
									</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<!-- for description -->
										<div class="form-group">
										<label>Comment<i class="text-danger">*</i></label>
											<textarea name="comment" class="form-control" placeholder="comment" required></textarea>
										</div>
									</div>
								</div>
							</div>
								  <div class="modal-footer">
									<button type="submit" class="btn btn-warning pull-left"><i class="fa fa-wrench"></i>&nbsp;<i class="fa fa-cog fa-spin"></i>&nbsp;Return now</button>
									<button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel</button>
								  </div>
							</form>
						</div>
					  </div>
					</div>
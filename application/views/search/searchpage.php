<!--
   This page for show list all book that search and can borrow .
   This page can see user and administrator.
-->
<br>
<div class="row">
  <div class="col-xs-12">
    <h2 class="text-center">Search All Book</h2>
  </div>
</div>
<br>
 <div class="row" id="search">
    <div class="col-xs-12">
      <form class="form-inline" action="<?php echo base_url('Search/index');?>" method = "post">
         <div class="form-group">
              <select class="form-control input-sm" name="category" value="" placeholder="Field">
                  <option value="-1">All Category</option>
                  <?php foreach ($category as  $value) {?>
                    <option <?php echo isset($categories) && $categories==$value->cat_id?'selected':""; ?> value="<?php echo $value->cat_id; ?>"><?php echo $value->cat_name; ?></option>
                    <?php
                  } ?>
              </select>
        </div>
          <div class="form-group">
                <label class="sr-only" for="khmer">Title Khmer/English</label>
                <input type="text" id="khmer" name="title" class="form-control input-sm" value="<?php echo isset($title)?$title:'';?>" placeholder="Title Khmer or English"/>
              </div>
          <div class="form-group">
            <label class="sr-only" for="keyword">keyWord</label>
              <input type="text" id="keyword" name="keyword" value="<?php echo isset($keyword)?$keyword:'';?>" class="form-control input-sm" placeholder="Keyword or Label" value="<?php set_value('keyword'); ?>"/>
            </div>
          <div class="form-group">
            <label class="sr-only" for="barcode">Barcode</label>
              <input type="text" id="barcode" name="barcode" value="<?php echo isset($barcode)?$barcode:'';?>" class="form-control input-sm" placeholder="Barcode" value="<?php set_value('barcode'); ?>"/>
            </div>
             <div class="form-group">
              <select class="form-control input-sm" name="status" value="" placeholder="status">
                <option value="" disabled selected style="display: none;">Choose Status</option>
                  <?php foreach ($datastatus as  $key) {?>
                    <option <?php echo isset($datastatus) && $datastatus==$key->sta_id?'selected':""; ?> value="<?php echo $key->sta_id; ?>"><?php echo $key->sta_name; ?></option>
                    <?php
                  } ?>
              </select>
        </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>&nbsp;Search</button></div>
      </form>
    </div>
   </div>
<p class="clearfix"></p>
<p class="clearfix"></p>
<div class="row">
  <div class="col-xs-12 table-responsive ">
      <table class="table table-striped table-bordered table-hover ui-shadow">
      <thead>
        <tr class="table-row">
          <th>Barcode</th>
          <th>Book Name</th>
          <th>Keyword</th>
          <th>Author</th>
          <th>Category</th>
          <th>Label</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      <thead> 
      <tbody>
      <!--show list books-->
       <?php foreach ($search as $value) { ?>
          <tr>
            <td class="text-center">
				<?php if($value->b_barcode==""){
					echo "<i class='text-danger fa fa-ban'></i>";
					}else{echo $value->b_barcode;} 
				?>
			</td>
            <td>
              <a href="#" data-toggle="modal" data-target="#Modal" class="detial" id="<?php echo $value->b_id; ?>">
                  &nbsp;<?php echo $value->b_title_en.' '.$value->b_title_kh;?></a>
            </td>
            <td><?php echo $value->b_keyword;?></td>
            <td><?php echo $value->b_author;?></td>
            <td><?php echo $value->cat_name;?></td>
            <td class="text-center">
				<?php if($value->b_barcode==""){
					echo "<i class='text-danger fa fa-times'></i>";
					}else{echo $value->categoryId."-".$value->b_label;} 
				?>
			</td>
            <td><?php echo $value->b_year;?></td>
            <td>
				<?php if($value->b_barcode==""){
					echo "<i class='text-danger fa fa-file-pdf-o'></i>&nbsp;<i class='text-danger'>(E-books)</i>";
				}else{
				 echo $value->sta_name;	
				}
				?>
			</br>
              &nbsp;
              <?php
				 $booking = $value->sta_name;
				 if($value->b_barcode==""){
				    echo "";
				 }
				 else if ($booking == 'Vacant'){
				?>
                  <a href="<?php echo base_url('BorrowBook/borrowById/'.$value->b_id);?>" >
                    <span class="label label-success" ><i class="fa fa-cog"></i>&nbsp;Borrow</span>
                  </a>
              <?php
               }
              ?>
            </td>
          </tr>
        <?php } 
        echo isset($search_index)?"<tr><td>".$search_index."</td></tr>":"";
        ?>
      </tbody>
      </table>
  </div>
</div>
<!-- Modoa dialog -->
 <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel"><label>Book Detial</label></h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  <p><label>Title(s):&nbsp;</label><span id="ten"></span><span id="tkh"></span></p>
                  <p><label>Author(s):&nbsp;</label><span id="author"></span></p>
                  <p><label>Category:&nbsp;</label><span id="category"></span></p>
                  <p><label>Language:&nbsp;</label><span id="language"></span></p>
                  <p><label>ISBN:&nbsp;</label><span id="isbn"></span></p>
                </div>
                <div class="col-sm-6">
                  <p><label>Label:&nbsp;</label><span id="labelc"></span><span>-</span><span id="label"></span></p>
                  <p><label>Status:&nbsp;</label><span id="status"></span></p>
                  <p><label>Condition:&nbsp;</label><span id="condition"></span></p>
                  <p><label>Year:&nbsp;</label><span id="year"></span></p>
                  <p><label>Barcode:&nbsp;</label><span id="code"></span></p>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <p><label>Comment:&nbsp;</label><span id="comment"></span></p>
                  <p><label>Description:&nbsp;</label><span id="description"></span></p>
                </div>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
 <script type="text/javascript">
// get data to popup to detial the book
 $(".detial").click(function(){
        var id = $(this).attr("id");
        // send id to CI controller to get detail from database
        $.ajax({
             type: "POST",
             url: "<?php echo base_url('Books/detail_book');?>",
             data: {'id': id} , 
             dataType: "json",
             success: function(data){
              // set data to dialog
                $("#tkh").html(data[0].b_title_kh);
                $("#ten").html(data[0].b_title_en);
                $("#author").html(data[0].b_author);
                $("#labelc").html(data[0].categoryId);
                $("#label").html(data[0].b_label);
                $("#category").html(data[0].cat_name);
                $("#language").html(data[0].b_language);
                $("#status").html(data[0].sta_name);
                $("#isbn").html(data[0].b_isbn);
                $("#code").html(data[0].b_barcode);
                $("#condition").html(data[0].con_name);
                $("#year").html(data[0].b_year);
                $("#comment").html(data[0].b_comment);
                $("#description").html(data[0].b_description);
            }
        });
    });
</script>


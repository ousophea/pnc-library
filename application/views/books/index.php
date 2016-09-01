<!--
   This page for show list of book .
   This page can see only administrator.
-->
<div class="container-fluid" id="wrap">
    <div class="col-xs-12  ">
        <h3 class="page-header text-danger">
            <a href="#" data-toggle="popover" 
               title="Books" 
               data-trigger="hover"
               data-content="List all the books in library in table.">
                <i class="fa fa-book"></i>&nbsp;All books
            </a>
        </h3>
    </div>
    <p class="clearfix"></p>
    <div class="row-fluid">
        <div class="row">
            <div class="col-xs-12"> 
                <a href="<?php echo base_url(); ?>books/add" 
                   data-content="you want to add more book." 
                   data-trigger="hover" data-toggle="popover" title="add more books" class="btn btn-primary pull-left col-sm">
                    <i class="fa fa-plus-circle"></i>
                    &nbsp;Add New
                </a>
                <!--<span class="col-sm-1"></span>-->
                <a href="<?php echo base_url(); ?>books/import_book" data-content="Import list of book from excel file." data-trigger="hover" data-toggle="popover" title="Add more books" class="btn btn-primary pull-left col-sm">
                    <i class="glyphicon glyphicon-import"></i>
                    &nbsp;Import Book From Excel
                </a>

                <a href="<?php echo base_url(); ?>books/exportExcel" data-content="Export list of book to excel file." data-trigger="hover" data-toggle="popover" title="Add more books" class="btn btn-primary pull-right col-sm">
                    <i class="glyphicon glyphicon-export"></i>
                    &nbsp;Export Book To Excel
                </a>
                <?php if (!$is_admin) { ?>
                    <a href="<?php echo base_url(); ?>request/showAllrequest"  class="btn btn-primary pull-right">
                        <span class="badge"></span>
                        &nbsp;New books request
                    </a>
                <?php } ?>
            </div>
            <p class="clearfix"></p>
        </div>
        <div class="row">
            <!-- /.panel-heading -->
            <div class=" table-responsive dataTable_wrapper" >
                <table id="dataTables-books" class="table table-striped table-bordered table-hover nowrap compact ui-shadow" >
                    <thead>
                        <tr class="table-row">
                            <th>Barcode</th>
                            <th>Title EN/KH</th>
                            <!--<th>Keyword</th>-->
                            <th>Category</th>
                            <th>Label</th>
                            <th>status</th>
                           
                            <th>Comment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($book_info as $books) {
                            ?>
                            <tr class="">
                                <td class="text-center">
                                    <?php
                                    if ($books->b_barcode == "") {
                                        echo "<i class='text-danger fa fa-times'></i>";
                                    } else {
                                        echo $books->b_barcode;
                                    }
                                    ?>
                                </td>	
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#Modal" class="detial" id="<?php echo $books->b_id; ?>"> &nbsp;<?php echo $books->b_title_en . ' ' . $books->b_title_kh; ?>
                                </td>
                                <!--<td><?php echo $books->b_keyword; ?></td>-->								
                                <td><?php echo $books->cat_name; ?></td>															
                                <td>
                                    <?php
                                    if ($books->b_barcode == "") {
                                        echo "<i class='text-danger fa fa-times'></i>";
                                    } else {
                                        echo $books->categoryId . "-" . $books->b_label;
                                    }
                                    ?>
                                </td>															
                                <td class="text-center"> 
                                    <?php
                                    if ($books->b_barcode == "") {
                                        echo "<i class='text-danger fa fa-file-pdf-o'></i>&nbsp;<i class='text-danger'>(E-books)</i>";
                                    } else {
                                        echo $books->sta_name;
                                    }
                                    ?>
                                </td>  
                                <td><?php echo $books->b_comment; ?></td>  														
                                <td data-order="1">
                                    <div class="pull-right text-danger">
                                        <a href="<?php echo base_url(); ?>books/edit/<?php echo $books->b_id; ?>" data-placement="left"  data-content="you want to edit book now" data-trigger="hover" title="Edit book" data-toggle="popover" ><span class="glyphicon glyphicon-pencil text-success"></span></a>
                                        &nbsp;
                                        <a href="<?php echo base_url() ?>books/delete/<?php echo $books->b_id; ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="confirm-delete"  title="Delete book" data-placement="left"  data-content="you want to delete book now" data-trigger="hover"  data-toggle="popover" ><span class="glyphicon glyphicon-trash text-danger"></span></a>

                                    </div>                     
                                </td>    
                            </tr>  
                            <?php
                        }
                        ?>
                    </tbody>            
                </table>
            </div><!-- /.table-responsive -->               
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
                                    <p><label>Key work:&nbsp;</label><span id="key_word"></span></p>
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

        $(document).ready(function () {
            //Transform the HTML table in a fancy datatable
            $('#dataTables-books').dataTable({
                "order": [[4, "desc"]]
            });
            $('[data-toggle="popover"]').popover();
        });
        // get data to popup to detial the book
        $(".detial").click(function () {
            var id = $(this).attr("id");
            // send id to CI controller to get detail from database
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Books/detail_book'); ?>",
                data: {'id': id},
                dataType: "json",
                success: function (data) {
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
                    $("#key_word").html(data[0].b_keyword);
                    $("#code").html(data[0].b_barcode);
                    $("#condition").html(data[0].con_name);
                    $("#year").html(data[0].b_year);
                    $("#comment").html(data[0].b_comment);
                    $("#description").html(data[0].b_description);

                }
            });
        });
    </script>
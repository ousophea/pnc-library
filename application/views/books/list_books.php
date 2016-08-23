<!--
   This page for show list of book .
   This page can see only administrator.
-->
<div class="container-fluid" id="wrap">
    <div class="row">
        <div class="col-xs-12  ">
            <h3 class="page-header text-danger">
                <a href="#">
                    <i class="fa fa-book"></i>&nbsp;List all books
                </a>
            </h3>
        </div>
    </div>
    <p class="clearfix"></p>
    <div class="row-fluid">
        <div class="row">
            <!-- /.panel-heading -->
            <div class=" table-responsive dataTable_wrapper" >
                <table id="dataTables-books" class="table table-striped table-bordered table-hover nowrap compact  ui-shadow" >
                    <thead>
                        <tr class="table-row">
                            <th>Barcode</th>
                            <th>Book Name</th>
                            <!--<th>keyword</th>-->
                            <th>Category</th>
                            <th>Label</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($book_info as $books) {
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?php
                                    if ($books->b_barcode == "") {
                                        echo "<i class='text-danger fa fa-ban'></i>";
                                    } else {
                                        echo $books->b_barcode;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#Modal" class="detial" id="<?php echo $books->b_id; ?>">
                                        &nbsp;<?php echo $books->b_title_en . $books->b_title_kh; ?>
                                    </a>
                                </td>
                                <!--<td><?php echo $books->b_keyword; ?></td>-->								
                                <td><?php echo $books->cat_name; ?></td>														
                                <td class="text-center">
                                    <?php
                                    if ($books->b_barcode == "") {
                                        echo "<i class='text-danger fa fa-times'></i>";
                                    } else {
                                        echo $books->categoryId . "-" . $books->b_label;
                                    }
                                    ?>
                                </td>																											
                                <td>
    <?php
    if ($books->b_barcode == "") {
        echo "<i class='text-danger fa fa-file-pdf-o'></i>&nbsp;<i class='text-danger'>(E-books)</i>";
    } else {
        echo $books->sta_name;
    }
    ?>
                                    </br>
                                    &nbsp;
    <?php
    $booking = $books->sta_name;
    if ($books->b_barcode == "") {
        echo "";
    } else if ($booking == 'Vacant') {
        ?>
                                        <a href="<?php echo base_url('BorrowBook/borrowById/' . $books->b_id); ?>" >
                                            <span class="label label-success" ><i class="fa fa-cog"></i>&nbsp;Borrow</span>
                                        </a>
                                <?php
                            }
                            ?>
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
                stateSave: true,
                "pageLength": 10,
                //"scrollX": true,
                "columnDefs": [
                    {targets: [0, 0], dataTable: true, "width": "60px"},
                    {targets: [1, 1], dataTable: true}
                ],
                "order": [[3, "asc"]]
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
                    $("#code").html(data[0].b_barcode);
                    $("#condition").html(data[0].con_name);
                    $("#year").html(data[0].b_year);
                    $("#comment").html(data[0].b_comment);
                    $("#description").html(data[0].b_description);

                }
            });
        });
    </script>

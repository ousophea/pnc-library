<!--
   This page for return book .
   This page can see only administrator.
-->

<p class="clearfix"></p>
<p class="clearfix"></p>
<div class="row">
    <div class="col-xs-12  ">
        <h3 class="page-header text-danger">
            <a href="#" data-toggle="popover" 
               title="Books" 
               data-trigger="hover"
               data-content="Return books here.">
                <i class="fa fa-share"></i>&nbsp;<i class="fa fa-bank"></i>&nbsp;Return books
            </a>
        </h3>
    </div>
</div>
<div class="row">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover nowrap compact ui-shadow" id="table-borrow">
            <thead>
                <tr class="table-row">
                    <th>Barcode</th>
                    <th>Borrower</th>
                    <th>Book Name</th>
                    <th>Borrow date</th>
                    <th>Return Date</th>
                    <th>Return</th>
                    <th>Late</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($borrowing as $value) { ?>

                    <tr>
                        <td><?php echo $value->b_barcode; ?></td>
                        <td><?php echo $value->firstname . ' ' . $value->lastname; ?></td>
                        <td><?php echo $value->b_title_en; ?></td>
                        <td>
                            <?php echo $value->bor_borrow_date; ?>
                        </td>
                        <td>
                            <?php echo $value->bor_return_date; ?>
                        </td>
                        <td>
                            <input type="button" class="btn btn-success btn-xs mybtn" id=" <?php echo $value->bor_id; ?> " value="Return" data-toggle="modal" data-target="#Modal"/>
                        </td>
                        <td>
                            <?php
                            $deatline = $value->bor_return_date;
                            $checkin = $value->bor_chechin_date;
                            $now = date('Y-m-d');
                            if ($deatline < $now && $checkin == NUll) {
                                ?>
                                <a href="<?php echo base_url('Returnbook/send_mail/' . $value->bor_id);
                        ; ?>" >
                                    <span class="label label-success" ><i class="fa fa-mail"></i>&nbsp;Send Mail</span>
                                </a>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
<?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Return a Book</h4>
            </div>
            <form id="myForm" action="<?php echo base_url('Returnbook/doUpdate'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <div>
                            Borrower:&nbsp;<span id="borrower"></span>&nbsp;<span id="borrower1"></span>
                        </div>
                        <div >
                            Title:&nbsp;<span id="title_en"></span>
                            &nbsp;<span id="title_kh"></span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label>Recieve Condition:</label>
                            <?php $data = $this->db->get('conditions'); ?>
                        <select class="form-control" id="restatus" name="restatus">
                            <?php foreach ($data->result() as $conditions) { ?>
                                <option><?php echo $conditions->con_name; ?></option>
<?php } ?>
                        </select>
                    </div>
                    <input type="hidden" name="bookId" id="bookId">
                    <input type="hidden" name="borrowId" id="borrowId">
                    <br>
                    <div class="form-group">
                        <label>Comment:</label><br>
                        <textarea id="comment" name="comment" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary return" id="submit">Return</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        //Transform the HTML table in a fancy datatable
        $('#table-borrow').dataTable({
            stateSave: true,
            "pageLength": 10,
            //"scrollX": true,
            "columnDefs": [
                {targets: [0, 0], dataTable: true, "width": "60px"},
                {targets: [1, 1], dataTable: true},
                {targets: [5, 5], dataTable: false}
            ]
        });
        $('[data-toggle="popover"]').popover();
    });
// get data to popup return book form
    $(".mybtn").click(function () {
        var id = $(this).attr("id");
        // send id to CI controller to get detail date from database
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Returnbook/getUpdate'); ?>",
            data: {'id': id},
            dataType: "json",
            success: function (data) {
                $("#borrower").html(data[0].firstname);
                $("#borrower1").html(data[0].lastname);
                $("#title_en").html(data[0].b_title_en);
                $("#title_kh").html(data[0].b_title_kh);
                $("#bookId").attr('value', data[0].books_b_id);
                $("#borrowId").attr('value', data[0].bor_id);
            }
        });
    });

</script>
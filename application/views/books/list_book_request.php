<!--
   This page for show list of book .
   This page can see only administrator.
-->
<div class="container-fluid" id="wrap">
    <div class="row">
        <div class="col-xs-12  ">
            <h3 class="page-header text-danger">
                <a href="#">
                    <i class="fa fa-book"></i>&nbsp;New Books Request
                </a>
                <a href="#" title="Back" 
                   onclick="window.history.back()" class="pull-right" ><i class="fa fa-reply"></i></a>
            </h3>

<!--<button onclick="window.history.back();" type="button" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-chevron-left">Back</span></button>-->
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
                            <th>Book Name</th>
                            <th>Author</th>
                            <th>Language</th>
                            <th>Description</th>
                            <th>Comment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($request as $key) { ?>
                            <tr>
                                <td><?php echo $key->re_title_en . $key->re_title_kh; ?></td>
                                <td><?php echo $key->re_author; ?></td>
                                <td><?php echo $key->re_language; ?></td>
                                <td><?php echo $key->re_description; ?></td>
                                <td><?php echo $key->re_comment; ?></td>
                                <td>
                                    <p><?php echo $key->status_re_name; ?></p>
                                    <?php if ($is_admin === TRUE) { ?>	
                                        <input type="button" class="btn btn-success btn-xs mybtn" id=" <?php echo $key->re_id; ?> " data-type="2" value="Agree" />
                                        &nbsp;
                                        <input type="button" class="btn btn-danger btn-xs mybtn" id=" <?php echo $key->re_id; ?> " data-type="3" value="Disagree" />

                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>            
                </table>
            </div><!-- /.table-responsive -->               
        </div>	
    </div>
    <!-- Modoa dialog -->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Request Comment</h4>
                </div>
                <form id="myForm" action="<?php echo base_url('Request/updateagreeBook'); ?>" method="post">
                    <div class="modal-body">

                        <input type="hidden" name="requestId" id="requestId"/>
                        <input type="hidden" name="requestType" id="requestType"/>
                        <br>
                        <div class="form-group">
                            <label>Comment:</label><br>
                            <textarea id="comment" name="comment" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary return" id="submit">Submit</button>
                    </div>
                </form>
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

        // get data to popup return book form
        $(".mybtn").click(function () {
            var id = $(this).attr("id");
            var type = $(this).data('type');
            $('#Modal').modal('show');
            $('#requestId').val(id);
            $('#requestType').val(type);

        });
    </script>
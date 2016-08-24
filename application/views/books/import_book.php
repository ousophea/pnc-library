<!--
   This page for show form add new book .
   This page can see only administrator.
-->
<div class="container-fluid" id="wrap">
    <div class="col-lg-12  ">
        <h3 class="page-header text-danger">

            <i class="fa fa-book"></i>&nbsp;Import Book From Excel
            <a href="#" title="Back" 
                onclick="window.history.back()" class="pull-right" ><i class="fa fa-reply"></i></a>

        </h3>
    </div>
    <p class="clearfix"></p>
    <!-- Form info -->
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-solid box-info panel">

                <span class="box-header text-center"> Upload Excel File of Books: </span>
                <div class="box-body">

                    <div class="col-md-6 text-left">

                        <h3>File requirements:</h3>
                        <ul>
                            <li>Must have 'xlsx' or 'xls' extension</li>
                            <li>Fields should be follow the method design. </li>
                            <li>Fields:</li>
                            <ul>
                                <li>Book Title (required)</li>
                                <li>Titles in Khmer</li>
                                <li>Author</li>
                                <li>Author in Khmer</li>
                                <li>Publisher</li>
                                <li>Year</li>
                                <li>Language</li>
                                <li>ISBN (optional -- must be numeric.)</li>
                                <li>Condition (required - New, Correct...)</li>
                                <li>Key words (required - Separated by ;)</li>
                                <li>Category name (required)</li>
                                <li>Category ID</li>
                                <li>Label (required)</li>
                                <li>Barcode (optional -- must be numeric. Random number value assigned if not included)</li>
                                <li>Comment (optional)</li>
                                <li>Edition (optional)</li>



                                <!--                                <li>ZipGrade ID (optional -- must be numeric. Random ID value assigned if not included)</li>
                                                                <li>External ID (optional -- can be letters and numbers.  Included in all CSV exports)</li>
                                                                <li>Class Name (optional -- class will be created on import if it doesn't exist)</li>-->
                            </ul>
                            <!--<li>If your file has a header row, please check 'Has header row' so first row will be ignored on import.</li>-->
                            <!--<li>Submit this page and you will be prompted to map the fields in your file to the fields above to complete the import.</li>-->
                            <li><a href="download_file">Sample file</a></li>
                        </ul>

                    </div>
                    <div class="col-md-6 text-center well">
                        <div class="">

                            <?php
                            // for form open form
                            $attributes = array('id' => 'frmAddBookForm', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal');
                            echo form_open('books/import_book', $attributes);
                            ?>
                            <!--<form enctype="multipart/form-data" method="post" action="">-->


                            <h3>Browse Excel file: </h3>

                            <input type="file" name="excelFile" required="required" class=""  placeholder="Year" value=""  >
                            <!--<input type="submit" name="btnImport" class="form-control"  placeholder="Year" value="Import Data from Excel"  >-->

                            <span class="text-danger">
                                <?php echo form_error('excelFile'); ?>
                            </span>


                            <button name="btnImport" type="submit">Upload</button>

                            <?php
//                                 close form
                            echo form_close();
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
     <!--<a href="#" onclick="window.history.back()" class="pull-left" ><i class="fa fa-reply"></i></a>-->
    <!--<button onclick="window.history.back()"  class="btn btn-info pull-left"><span class="glyphicon glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Back</button>-->	

</div>
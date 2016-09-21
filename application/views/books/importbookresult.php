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

                    <div class="col-md-12 text-left">

                        <h3>The book import was completed successfully</h3>
                        <ul>
                            <li>
                                <?php
                                $dataInsert = $this->session->userdata('dataInserted');
                                $dataDuplicate = $this->session->userdata('dataDuplicat');
                                echo count($dataInsert) . " books have import successfully.<br/></li><li>";
                                echo count($dataDuplicate) . " dupblicate books were not imported.<br/>";
                                ?> 
                            </li>
                            <li>Duplicate Book List:</li>

                        </ul>

                    </div>
                    <div class="col-md-12 text-left">

                        <table id="dataTables-books" class="table table-striped table-bordered table-hover nowrap compact ui-shadow" >
                            <thead>
                                <tr class="table-row">
                                    <th>Title EN</th>
                                    <th>Title KH</th>
                                    <th>Barcode</th>
                                    <th>Keyword</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                                                var_dump($dataDuplicate);exit();
                                foreach ($dataDuplicate as $books) {
                                    ?>
                                    <tr class="">
                                        <td class="text-center"> <?php echo $books['b_title_en'] ?> </td>
                                         <td class="text-center"><?php echo $books['b_title_kh'] ?></td>	
                                        <td class="text-center"> <?php echo $books['b_barcode'] ?></td>	
                                        <td class="text-center"><?php echo $books['b_keyword'] ?></td>	
                                       
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <button onclick="window.history.back()"  class="btn btn-info pull-left"><span class="glyphicon glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Back</button>	
</div>
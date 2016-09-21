<!--
   This page for show form borrow book .
   This page can see user and administrator.
-->
<p class="clearfix"></p>
<p class="clearfix"></p>
<div class="row">
    <div class="col-xs-12  ">
        <h3 class="page-header text-danger">
            <a href="#" data-toggle="popover" 
               title="Books" 
               data-trigger="hover"
               data-content="you want to borrow book.">
                <i class="fa fa-reply"></i>&nbsp;<i class="fa fa-bank"></i>&nbsp;Borrow book
            </a>
        </h3>
    </div>
</div>
<div class="row">
    <div class="box box-solid box-default panel-sm ui-shadow">
        <div class="box-header">
            <div class="box-title text-center"><i class="fa fa-reply"></i>&nbsp;<i class="fa fa-bank"></i>&nbsp;Borrow book</div>
        </div>
        <div class="box-body">
            <form action="<?php echo base_url('Borrowbook/index'); ?>" method = "post">
                <label for="">Barcode</label>
                <input type="text" name="com_barcode" id="com_barcode" class="form-control" placeholder="1234567" value="<?php echo set_value('com_barcode'); ?>"/>
            </form>
            <p class="clearfix"></p>
            <form action="<?php echo base_url('Borrowbook/insert_borrow'); ?>" method="post">
                <?php
                if (!empty($rule)) {
                    foreach ($rule as $key) {
                        $this->session->set_userdata('num_day', $key->rul_num_day);
                        ?>
                        <input type="hidden" name="ruleId" value="<?php echo $key->rul_id; ?>">
                        <input type="hidden" name="numDay" value="<?php echo $key->rul_num_day; ?>">
                    <?php
                    }
                }
                ?>
                <?php
//                echo $gbarcode;
                if (!empty($gbarcode)) {
                    foreach ($gbarcode as $value) {
                        $this->session->set_userdata('barcode', $value->b_barcode);
                        $num_day = $this->session->userdata('num_day');
                        ?>
                        <input type="hidden" name="bar_id" value="<?php echo $value->b_id ?>">
                        <div class="row">
                            <div class="col-xs-6">
                                <p><i class="fa fa-book"></i>&nbsp;Title Khmer:<?php echo $value->b_title_kh; ?></p>
                            </div>
                            <div class="col-xs-6">
                                <p class="text-left"><i class="fa fa-book"></i>&nbsp;Title English:<?php echo $value->b_title_en; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <p><i class="fa fa-briefcase"></i>&nbsp;Category:<?php echo $value->cat_name; ?></p>
                            </div>
                            <div class="col-xs-6">
                                <p class="text-left"><i class="fa fa-tags"></i>&nbsp;Status:<?php echo $value->sta_name; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <p><i class="fa fa-calendar"></i>&nbsp;Borrow Date:<?php echo date('Y-m-d'); ?></p>
                            </div>
                            <div class="col-xs-6">
                                <p class="text-left"><i class="fa fa-calendar"></i>&nbsp;Return Date:<?php echo date('Y-m-d', strtotime(date('Y-m-d') . " + $num_day days")); ?></p>
                            </div>
                        </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-warning">Borrow now</button>
                    <button type="button" class="btn btn-success pull-right" >Cancel</button>
                </div>
                <?php
            }
        }else{
            echo '<p class="text-danger">Please enter valid barcode.</p>';
        }
//        echo isset($gbarcode_index) ? "<tr><td>" . $gbarcode_index . "</td></tr>" : "";
        ?>
        </form>
    </div>
</div>
<!--This script to show popup-->
<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();
    });
</script>
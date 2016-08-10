
 <!--
   This page for show information all application (user and book).
   This page can see only administrator.
-->

<p class="clearfix"></p>
<p class="clearfix"></p>
    <!--panel-->
	<h3 class="text-danger">
		<a href="#">
			<i class="fa fa-dashboard"></i>&nbsp;Dashboard
		</a>
	</h3>
<div class="row">
	<div class="box box-warning"></div>
</div>
<p class="clearfix"></p>
<div class="row">
	<div class="col-xs-4">
		<a href="<?php echo base_url();?>Dashboard/allBookInLibrary">
			<div class="info-box bg-aqua">
			  <span class="info-box-icon"><i class="fa fa-book"></i></span>
			  <div class="info-box-content">
				<span class="info-box-text">Books</span>
				<?php foreach($count_books as $books){?>
				<span class="info-box-number"><?php echo $books->book;?></span>
				<?php }?>
					All Books in Library.
				<div class="progress">
				  <div class="progress-bar" style="width: 40%"></div>
				</div>
			  </div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</a>
	</div>
    <div class="col-xs-4 ">
		<a href="<?php echo base_url();?>Dashboard/usersInLibrary">
			<div class="info-box bg-orange">
			  <span class="info-box-icon"><i class="fa fa-users"></i></span>
			  <div class="info-box-content">
				<span class="info-box-text">Users</span>
				<?php foreach($count_users as $rows){?>
					<span class="info-box-number"><?php echo $rows->user; ?></span>
				<?php }?>
					All users in Library
				<div class="progress">
				  <div class="progress-bar" style="width: 70%"></div>
				</div>
			  </div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</a>
	</div>
	 <div class="col-xs-4">
		<a href="<?php echo base_url();?>dashboard/borrowing">
			<div class="info-box bg-maroon">
			  <span class="info-box-icon"><i class="fa fa-book"></i></span>
			  <div class="info-box-content">
				<span class="info-box-text">Borrowing</span>
					<span class="info-box-number"><?php echo $count_borrowing; ?></span>
					All Borrowing in Library
				<div class="progress">
				  <div class="progress-bar" style="width: 20%"></div>
				</div>
			  </div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</a>
	</div>
</div>
<p class="clearfix"></p>
<div class="row">
	<div class="col-xs-4">
		<a href="<?php echo base_url();?>dashboard/bookVacant">
			<div class="info-box bg-red">
			  <span class="info-box-icon"><i class="fa fa-book"></i></span>
			  <div class="info-box-content">
				<span class="info-box-text">Books Vacant</span>
				<span class="info-box-number"><?php echo $vacant; ?></span>
				  All books in PNC library
				<div class="progress">
				  <div class="progress-bar" style="width: 20%"></div>

				</div>
			  </div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</a>
	</div>
	<div class="col-xs-4">
		<a href="<?php echo base_url();?>dashboard/bookInStore">
			<div class="info-box bg-blue">
			  <span class="info-box-icon"><i class="fa fa-book"></i></span>
			  <div class="info-box-content">
				<span class="info-box-text">Books in store</span>
				<?php foreach ($count_books as $value) {?>
				<span class="info-box-number"><?php echo $value->book - $count_borrowing; ?></span>
				<?php } ?>
				  All books in PNC library
				<div class="progress">
				  <div class="progress-bar" style="width: 20%"></div>
				</div>
			  </div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</a>
	</div>
	<div class="col-xs-4">
		<a href="<?php echo base_url();?>dashboard/bookBroken">
			<div class="info-box bg-olive">
			  <span class="info-box-icon"><i class="fa fa-book"></i></span>
			  <div class="info-box-content">
				<span class="info-box-text">Books Broken</span>
				<span class="info-box-number"><?php echo $book_broken; ?></span>
				  All books broken in library
				<div class="progress">
				  <div class="progress-bar" style="width: 20%"></div>
				</div>
			  </div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</a>
	</div>
</div>
    <div class="row">
        <div class="col-md-12">
            <div id="Month" style="height: 300px; width: 100%;"></div>
        </div>
    </div>
    <br>
    <div class="row">
    	<div class="col-md-12">
        	<div id="mostborrow" style="height: 300px; width: 100%;"></div>	
        </div>
    </div>
    <br>
    <div class="row">
    	<div class="col-md-12">
    		<select onchange="eachMonth()" class="input-sm" id="eachMonthCat">
        		<option value="1">January</option>
        		<option value="2">February</option>
        		<option value="3">Mach</option>
        		<option value="4">April</option>
        		<option value="5">May</option>
        		<option value="6">June</option>
        		<option value="7">July</option>
        		<option value="8">August</option>
        		<option value="9">September</option>
        		<option value="10">October</option>
        		<option value="11">November</option>
        		<option value="12">December</option>
        	</select>
    		<div id="category1" style="display:none; height: 300px; width: 100%;"></div>
    		<div id="category2" style="display:none; height: 300px; width: 100%;"></div>
    		<div id="category3" style="display:none; height: 300px; width: 100%;"></div>
    		<div id="category4" style="display:none; height: 300px; width: 100%;"></div>
    		<div id="category5" style="display:none; height: 300px; width: 100%;"></div>
    		<div id="category6" style="height: 300px; width: 100%;"></div>
    		<div id="category7" style="display:none; height: 300px; width: 100%;"></div>
    		<div id="category8" style="display:none; height: 300px; width: 100%;"></div>
    		<div id="category9" style="display:none; height: 300px; width: 100%;"></div>
    		<div id="category10" style="display:none; height: 300px; width: 100%;"></div>
    		<div id="category11" style="display:none; height: 300px; width: 100%;"></div>
    		<div id="category12" style="display:none; height: 300px; width: 100%;"></div>
    	</div>
    </div>
	<p class="clearfix"></p>
	<p class="clearfix"></p>
	<div class="row">
	   <div class="col-md-12">
    		<select onchange="perMonthOrYear()" class="input-sm" id="per_m_y">
        		<option value="1">Per month</option>
        		<option value="2">Per year</option>
        	</select>
            <div id="duration_m" style="height: 270px; width: 100%;"></div>
            <div id="duration_y" style="display:none; height: 270px; width: 100%;"></div>
	   </div>
	</div>
    <!-- /.row -->
	<p class="clearfix"></p>
	<p class="clearfix"></p>
<!-- this for contain value of statistic feature -->
<!-- books for each month -->
<input type="hidden" name="eachmonth" id="jan" value="<?php echo $month1; ?>">
<input type="hidden" name="eachmonth" id="feb" value="<?php echo $month2; ?>">
<input type="hidden" name="eachmonth" id="mar" value="<?php echo $month3; ?>">
<input type="hidden" name="eachmonth" id="apr" value="<?php echo $month4; ?>">
<input type="hidden" name="eachmonth" id="may" value="<?php echo $month5; ?>">
<input type="hidden" name="eachmonth" id="jun" value="<?php echo $month6; ?>">
<input type="hidden" name="eachmonth" id="jul" value="<?php echo $month7; ?>">
<input type="hidden" name="eachmonth" id="aug" value="<?php echo $month8; ?>">
<input type="hidden" name="eachmonth" id="sep" value="<?php echo $month9; ?>">
<input type="hidden" name="eachmonth" id="oct" value="<?php echo $month10; ?>">
<input type="hidden" name="eachmonth" id="nov" value="<?php echo $month11; ?>">
<input type="hidden" name="eachmonth" id="dec" value="<?php echo $month12; ?>">
<!-- end book each month -->
<!-- returning the book -->
		<!-- in a month -->
<input type="hidden" name="intime_m" id="intime_m" value="<?php echo $intime_m->intime; ?>">
<input type="hidden" name="ontime_m" id="ontime_m" value="<?php echo $ontime_m->ontime; ?>">
<input type="hidden" name="late_m" id="late_m" value="<?php echo $late_m->late; ?>">
		<!-- in a year -->
<input type="hidden" name="intime_y" id="intime_y" value="<?php echo $intime_y->intimey; ?>">
<input type="hidden" name="ontime_y" id="ontime_y" value="<?php echo $ontime_y->ontimey; ?>">
<input type="hidden" name="late_y" id="late_y" value="<?php echo $late_y->latey;  ?>">
<!-- ============================================== -->
<!-- statistic -->
<script type="text/javascript" src="<?php echo base_url('assets/js/canvasjs.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
window.onload = function () {
	// for each month
	var month1 = document.getElementById('jan').value;
	var month2 = document.getElementById('feb').value;
	var month3 = document.getElementById('mar').value;
	var month4 = document.getElementById('apr').value;
	var month5 = document.getElementById('may').value;
	var month6 = document.getElementById('jun').value;
	var month7 = document.getElementById('jul').value;
	var month8 = document.getElementById('aug').value;
	var month9 = document.getElementById('sep').value;
	var month10 = document.getElementById('oct').value;
	var month11 = document.getElementById('nov').value;
	var month12 = document.getElementById('dec').value;
	// for duration in a month
	var intime_m = document.getElementById('intime_m').value;
	var ontime_m = document.getElementById('ontime_m').value;
	var late_m = document.getElementById('late_m').value;
	// for duration in a year
	var intime_y = document.getElementById('intime_y').value;
	var ontime_y = document.getElementById('ontime_y').value;
	var late_y = document.getElementById('late_y').value;
// chart for books of each month
	var chart = new CanvasJS.Chart("Month", {
		theme: "theme3",
        animationEnabled: true,
		title:{
		text: "Books are borrewed for each months",
	},
		axisX: {
			interval: 12
		},
		dataPointWidth: 30,
		data: [{
			type: "column",
			indexLabelLineThickness: 2,
			dataPoints: [
				{ x: 1, y: parseInt(month1)	},
				{ x: 2, y: parseInt(month2)	},
				{ x: 3, y: parseInt(month3) },
				{ x: 4, y: parseInt(month4) },
				{ x: 5, y: parseInt(month5) },
				{ x: 6, y: parseInt(month6) },
				{ x: 7, y: parseInt(month7) },
				{ x: 8, y: parseInt(month8) },
				{ x: 9, y: parseInt(month9) },
				{ x: 10, y: parseInt(month10) },
				{ x: 11, y: parseInt(month11) },
				{ x: 12, y: parseInt(month12) }
			]
		}]
	});
// for char of return duration for a month
	var chartPie_m = new CanvasJS.Chart("duration_m", {
		title:{
		text: "Return duration per month", 
		},
        animationEnabled: true,
		legend: {
			verticalAlign: "bottom",
			horizontalAlign: "center"
		},
		theme: "theme1",
		data: [
		{        
			type: "pie",
			indexLabelFontFamily: "Garamond",       
			indexLabelFontSize: 20,
			indexLabelFontWeight: "bold",
			startAngle:0,
			indexLabelFontColor: "MistyRose",       
			indexLabelLineColor: "darkgrey", 
			indexLabelPlacement: "inside", 
			showInLegend: true,
			indexLabel: "#percent%", 
			dataPoints: [
				{  y: parseInt(intime_m) , name: "In time",legendMarkerType: "triangle"},
				{  y: parseInt(ontime_m), name: "On time", legendMarkerType: "square"},
				{  y: parseInt(late_m), name: "Late", legendMarkerType: "circle"}
			]
		}]
	});
// for char of return duration for a year
	var chartPie_y = new CanvasJS.Chart("duration_y", {
		title:{
		text: "Return duration per year",
		},
        animationEnabled: true,
		legend: {
			verticalAlign: "bottom",
			horizontalAlign: "center"
		},
		theme: "theme1",
		data: [
		{        
			type: "pie",
			indexLabelFontFamily: "Garamond",       
			indexLabelFontSize: 20,
			indexLabelFontWeight: "bold",
			startAngle:0,
			indexLabelFontColor: "MistyRose",       
			indexLabelLineColor: "darkgrey", 
			indexLabelPlacement: "inside", 
			showInLegend: true,
			indexLabel: "#percent%", 
			dataPoints: [
				{  y: parseInt(intime_y) , name: "In time",legendMarkerType: "triangle"},
				{  y: parseInt(ontime_y), name: "On time", legendMarkerType: "square"},
				{  y: parseInt(late_y), name: "Late", legendMarkerType: "circle"}
			]
		}]
	});
	// Most borrowed in each categories and month
	// month1
	var category1 = new CanvasJS.Chart("category1", {
		theme: "theme2",//theme1
		title:{
			text: "Most borrowed in category in January",
			fontFamily: "tahoma",
			fontSize: 20, 
			fontweight: "bold",           
		},
		animationEnabled: true,   // change to false
		data: [              
		{
			// Change type to "bar", "area", "spline", "pie",etc.
			type: "column",
			dataPoints: [
					<?php 
				foreach ($cat_m1 as $value1) {
					echo "{ label: '{$value1->cat_name}',  y: {$value1->total1}  },";
				}
		 	?>
			]
		}
		]
	});
	// month2
	var category2 = new CanvasJS.Chart("category2", {
		theme: "theme2",//theme1
		title:{
			text: "Most borrowed in category in February",
			fontFamily: "tahoma",
			fontSize: 20, 
			fontweight: "bold",           
		},
		animationEnabled: true,   // change to false
		data: [              
		{
			// Change type to "bar", "area", "spline", "pie",etc.
			type: "column",
			dataPoints: [
					<?php 
				foreach ($cat_m2 as $value2) {
					echo "{ label: '{$value2->cat_name}',  y: {$value2->total2}  },";
				}
		 	?>
			]
		}
		]
	});
	// month3
	var category3 = new CanvasJS.Chart("category3", {
		theme: "theme2",//theme1
		title:{
			text: "Most borrowed in category in March",
			fontFamily: "tahoma",
			fontSize: 20, 
			fontweight: "bold",             
		},
		animationEnabled: true,   // change to false
		data: [              
		{
			// Change type to "bar", "area", "spline", "pie",etc.
			type: "column",
			dataPoints: [
					<?php 
				foreach ($cat_m3 as $value3) {
					echo "{ label: '{$value3->cat_name}',  y: {$value3->total3}  },";
				}
		 	?>
			]
		}
		]
	});
	// month4
	var category4 = new CanvasJS.Chart("category4", {
		theme: "theme2",//theme1
		title:{
			text: "Most borrowed in category in April",
			fontFamily: "tahoma",
			fontSize: 20, 
			fontweight: "bold",             
		},
		animationEnabled: true,   // change to false
		data: [              
		{
			// Change type to "bar", "area", "spline", "pie",etc.
			type: "column",
			dataPoints: [
					<?php 
				foreach ($cat_m4 as $value4) {
					echo "{ label: '{$value4->cat_name}',  y: {$value4->total4}  },";
				}
		 	?>
			]
		}
		]
	});
	// month5
	var category5 = new CanvasJS.Chart("category5", {
		theme: "theme2",//theme1
		title:{
			text: "Most borrowed in category in May",
			fontFamily: "tahoma",
			fontSize: 20, 
			fontweight: "bold",               
		},
		animationEnabled: true,   // change to false
		data: [              
		{
			// Change type to "bar", "area", "spline", "pie",etc.
			type: "column",
			dataPoints: [
					<?php 
				foreach ($cat_m5 as $value5) {
					echo "{ label: '{$value5->cat_name}',  y: {$value5->total5}  },";
				}
		 	?>
			]
		}
		]
	});
	// month6
	var category6 = new CanvasJS.Chart("category6", {
		theme: "theme2",//theme1
		title:{
			text: "Most borrowed in category in June",
			fontFamily: "tahoma",
			fontSize: 20, 
			fontweight: "bold",               
		},
		animationEnabled: true,   // change to false
		data: [              
		{
			// Change type to "bar", "area", "spline", "pie",etc.
			type: "column",
			dataPoints: [
					<?php 
				foreach ($cat_m6 as $value6) {
					echo "{ label: '{$value6->cat_name}',  y: {$value6->total6}  },";
				}
		 	?>
			]
		}
		]
	});
	// month7
	var category7 = new CanvasJS.Chart("category7", {
		theme: "theme2",//theme1
		title:{
			text: "Most borrowed in category in July",
			fontFamily: "tahoma",
			fontSize: 20, 
			fontweight: "bold",              
		},
		animationEnabled: true,   // change to false
		data: [              
		{
			// Change type to "bar", "area", "spline", "pie",etc.
			type: "column",
			dataPoints: [
					<?php 
				foreach ($cat_m7 as $value7) {
					echo "{ label: '{$value7->cat_name}',  y: {$value7->total7}  },";
				}
		 	?>
			]
		}
		]
	});
	// month8
	var category8 = new CanvasJS.Chart("category8", {
		theme: "theme2",//theme1
		title:{
			text: "Most borrowed in category in August",
			fontFamily: "tahoma",
			fontSize: 20, 
			fontweight: "bold", 
		},
		animationEnabled: true,   // change to false
		data: [              
		{
			// Change type to "bar", "area", "spline", "pie",etc.
			type: "column",
			dataPoints: [
					<?php 
				foreach ($cat_m8 as $value8) {
					echo "{ label: '{$value8->cat_name}',  y: {$value8->total8}  },";
				}
		 	?>
			]
		}
		]
	});
	// month9
	var category9 = new CanvasJS.Chart("category9", {
		theme: "theme2",//theme1
		title:{
			text: "Most borrowed in category in September",
			fontFamily: "tahoma",
			fontSize: 20, 
			fontweight: "bold", 
		},
		animationEnabled: true,   // change to false
		data: [              
		{
			// Change type to "bar", "area", "spline", "pie",etc.
			type: "column",
			dataPoints: [
					<?php 
				foreach ($cat_m9 as $value9) {
					echo "{ label: '{$value9->cat_name}',  y: {$value9->total9}  },";
				}
		 	?>
			]
		}
		]
	});
	// month10
	var category10 = new CanvasJS.Chart("category10", {
		theme: "theme2",//theme1
		title:{
			text: "Most borrowed in category in October",
			fontFamily: "tahoma",
			fontSize: 20, 
			fontweight: "bold",            
		},
		animationEnabled: true,   // change to false
		data: [              
		{
			// Change type to "bar", "area", "spline", "pie",etc.
			type: "column",
			dataPoints: [
					<?php 
				foreach ($cat_m10 as $value10) {
					echo "{ label: '{$value10->cat_name}',  y: {$value10->total10}  },";
				}
		 	?>
			]
		}
		]
	});
	// month11
	var category11 = new CanvasJS.Chart("category11", {
		theme: "theme2",//theme1
		title:{
			text: "Most borrowed in category in November",
			fontFamily: "tahoma",
			fontSize: 20, 
			fontweight: "bold",               
		},
		animationEnabled: true,   // change to false
		data: [              
		{
			// Change type to "bar", "area", "spline", "pie",etc.
			type: "column",
			dataPoints: [
					<?php 
				foreach ($cat_m11 as $value11) {
					echo "{ label: '{$value11->cat_name}',  y: {$value11->total11}  },";
				}
		 	?>
			]
		}
		]
	});
	// month12
	var category12 = new CanvasJS.Chart("category12", {
		theme: "theme2",//theme1
		title:{
			text: "Most borrowed in category in December",
			fontFamily: "tahoma",
			fontSize: 20, 
			fontweight: "bold",        
		},
		animationEnabled: true,   // change to false
		data: [              
		{
			// Change type to "bar", "area", "spline", "pie",etc.
			type: "column",
			dataPoints: [
				<?php 
				foreach ($cat_m12 as $value12) {
					echo "{ label: '{$value12->cat_name}',  y: {$value12->total12}  },";
				}
		 		?>
			]
		}
		]
	});

	// most 10 books are usualy borrowed 
		var mostborrow = new CanvasJS.Chart("mostborrow", {
		theme: "theme2",//theme1
		title:{
			text: "Most 10 books are borrowed",
			fontFamily: "tahoma",
			fontSize: 20, 
			fontweight: "bold",             
		},
		animationEnabled: false,   // change to true
		data: [              
		{
			// Change type to "bar", "area", "spline", "pie",etc.
			type: "column",
			dataPoints: [
		
				<?php 
				foreach ($mostBorrow as $most) {
					echo "{ label: '{$most->b_title_en}',  y: {$most->mostBorrow}  },";
				}
		 		?>
			]
		}
		]
	});
	chart.render();
	mostborrow.render();
	category1.render();
	category2.render();
	category3.render();
	category4.render();
	category5.render();
	category6.render();
	category7.render();
	category8.render();
	category9.render();
	category10.render();
	category11.render();
	category12.render();
	chartPie_m.render();
	chartPie_y.render();
}

// to show per month or per year
	function perMonthOrYear(){
		var perMonth_year = document.getElementById('per_m_y').value;
		if (perMonth_year==1) {
			duration_m.style.display="block";
			duration_y.style.display="none";
		}else{
			duration_y.style.display="block";
			duration_m.style.display="none";
		}
	}
// show category of each months
	function eachMonth(){
		var eachMonth = document.getElementById('eachMonthCat').value;
		if (eachMonth==1) {
			category1.style.display="block";
			category2.style.display="none";
			category3.style.display="none";
			category4.style.display="none";
			category5.style.display="none";
			category6.style.display="none";
			category7.style.display="none";
			category8.style.display="none";
			category9.style.display="none";
			category10.style.display="none";
			category11.style.display="none";
			category12.style.display="none";
		}
		else if (eachMonth==2) {
			category1.style.display="none";
			category2.style.display="block";
			category3.style.display="none";
			category4.style.display="none";
			category5.style.display="none";
			category6.style.display="none";
			category7.style.display="none";
			category8.display="none";
			category9.style.display="none";
			category10.style.display="none";
			category11.style.display="none";
			category12.style.display="none";
		}
		else if (eachMonth==3) {
			category1.style.display="none";
			category2.style.display="none";
			category3.style.display="block";
			category4.style.display="none";
			category5.style.display="none";
			category6.style.display="none";
			category7.style.display="none";
			category8.style.display="none";
			category9.style.display="none";
			category10.style.display="none";
			category11.style.display="none";
			category12.style.display="none";
		}
		else if (eachMonth==4) {
			category1.style.display="none";
			category2.style.display="none";
			category3.style.display="none";
			category4.style.display="block";
			category5.style.display="none";
			category6.style.display="none";
			category7.style.display="none";
			category8.style.display="none";
			category9.style.display="none";
			category10.style.display="none";
			category11.style.display="none";
			category12.style.display="none";
		}
		else if (eachMonth==5) {
			category1.style.display="none";
			category2.style.display="none";
			category3.style.display="none";
			category4.style.display="none";
			category5.style.display="block";
			category6.style.display="none";
			category7.style.display="none";
			category8.style.display="none";
			category9.style.display="none";
			category10.style.display="none";
			category11.style.display="none";
			category12.style.display="none";
		}
		else if (eachMonth==6) {
			category1.style.display="none";
			category2.style.display="none";
			category3.style.display="none";
			category4.style.display="none";
			category5.style.display="none";
			category6.style.display="block";
			category7.style.display="none";
			category8.style.display="none";
			category9.style.display="none";
			category10.style.display="none";
			category11.style.display="none";
			category12.style.display="none";
		}
		else if (eachMonth==7) {
			category1.style.display="none";
			category2.style.display="none";
			category3.style.display="none";
			category4.style.display="none";
			category5.style.display="none";
			category6.style.display="none";
			category7.style.display="block";
			category8.style.display="none";
			category9.style.display="none";
			category10.style.display="none";
			category11.style.display="none";
			category12.style.display="none";
		}
		else if (eachMonth==8) {
			category1.style.display="none";
			category2.style.display="none";
			category3.style.display="none";
			category4.style.display="none";
			category5.style.display="none";
			category6.style.display="none";
			category7.style.display="none";
			category8.style.display="block";
			category9.style.display="none";
			category10.style.display="none";
			category11.style.display="none";
			category12.style.display="none";
		}
		else if (eachMonth==9) {
			category1.style.display="none";
			category2.style.display="none";
			category3.style.display="none";
			category4.style.display="none";
			category5.style.display="none";
			category6.style.display="none";
			category7.style.display="none";
			category8.style.display="none";
			category9.style.display="block";
			category10.style.display="none";
			category11.style.display="none";
			category12.style.display="none";
		}
		else if (eachMonth==10) {
			category1.style.display="none";
			category2.style.display="none";
			category3.style.display="none";
			category4.style.display="none";
			category5.style.display="none";
			category6.style.display="none";
			category7.style.display="none";
			category8.style.display="none";
			category9.style.display="none";
			category10.style.display="block";
			category11.style.display="none";
			category12.style.display="none";
		}
		else if (eachMonth==11) {
			category1.style.display="none";
			category2.style.display="none";
			category3.style.display="none";
			category4.style.display="none";
			category5.style.display="none";
			category6.style.display="none";
			category7.style.display="none";
			category8.style.display="none";
			category9.style.display="none";
			category10.style.display="none";
			category11.style.display="block";
			category12.style.display="none";
		}
		else{
			category1.style.display="none";
			category2.style.display="none";
			category3.style.display="none";
			category4.style.display="none";
			category5.style.display="none";
			category6.style.display="none";
			category7.style.display="none";
			category8.style.display="none";
			category9.style.display="none";
			category10.style.display="none";
			category11.style.display="none";
			category12.style.display="block";
		}
	}
</script>
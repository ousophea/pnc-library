<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $title ?> - PNC Library</title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/logo.png" />
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/bootstrap/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/bootstrap/css/AdminLTE.css" rel="stylesheet">
	
    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>assets/js/html5shiv.min.js"></script>
    <![endif]-->
    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>assets/metisMenu/css/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="<?php echo base_url();?>assets/sb-admin-2/css/timeline.css" rel="stylesheet">
    <!-- SB-ADMIN2 CSS -->
    <link href="<?php echo base_url();?>assets/sb-admin-2/css/sb-admin-2.css" rel="stylesheet">
    <!-- Bootstrap Social CSS -->
    <link href="<?php echo base_url();?>assets/sb-admin-2/css/bootstrap-social.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables CSS -->
    <link href="<?php echo base_url();?>assets/datatable/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-2.2.1.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/metisMenu/js/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/sb-admin-2/js/sb-admin-2.js"></script>
    <!-- Datatables -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/datatable/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/app.min.js"></script>
    <!-- bootbox code -->
    <script src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>favicon.ico" sizes="32x32">
    <style>
      html, body {
        height: 100%;
      }
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        margin: 0 auto -40px;
        padding: 15px 15px;
      }
      /* adapted from http://maxwells.github.io/bootstrap-tags.html */
      .tag {
        font-size: 14px;
        padding: .3em .4em .4em;
        margin: 0 .1em;
      }
      .tag a {
        color: #bbb;
        cursor: pointer;
        opacity: 0.6;
      }
      .tag a:hover {
        opacity: 1.0
      }
      .tag .remove {
        vertical-align: bottom;
        top: 0;
      }
      .tag a {
        margin: 0 0 0 .3em;
      }
      .tag a .glyphicon-white {
        color: #fff;
        margin-bottom: 2px;
      }
      #flash-message-wrapper {
        border-left: 1px solid #e7e7e7;
        margin: 0 0 0 250px;
        position: inherit;
     }
      #flash-inner-message {
          margin: 0 auto;
      }
      #upSuccess{
        color: blue;
      }
      #unSuccess{
        color: red;
      }
    </style>
  </head>
<body>

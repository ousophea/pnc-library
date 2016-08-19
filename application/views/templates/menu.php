<div id="wrapper">
    <!-- Static navbar -->
     <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo base_url();?>" class="pull-left"><img src="<?php echo base_url();?>assets/images/logo.png" 
                    style="width: 100px; height: 40px; margin: 10px;"
                    alt="logo"></a>
                <a class="navbar-brand" href="<?php echo base_url();?>"><!-- PNC Library --></a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <label><?php echo $this->session->userdata('firstname'); ?></label>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class=""fa fa-users""></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url();?>users/edit/<?php echo $this->session->userdata('id'); ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url();?>connection/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a  href="<?php echo base_url();?>account"><i class="fa fa-user fa-fw"></i> &nbsp;My account<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="<?php echo base_url();?>account/accountState"><i class="fa fa-child"></i>&nbsp;&nbsp;Account State</a>
								</li>
								<li>
									<a href="<?php echo base_url();?>request"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Request new book</a>
								</li>
							</ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>search"><i class="fa fa-search fa-fw"></i> Search books</a>                            
                        </li>          
                        <li>
                            <a href="<?php echo base_url();?>books/listbook"><i class="fa fa-file-text-o fa-fw"></i> List books</a>                            
                        </li> 
                        <li>
                            <a href="<?php echo base_url();?>borrowbook"><i class="fa fa-university fa-fw"></i>&nbsp;<i class="fa fa-share"></i>&nbsp;Borrow Books</a>
                        </li>                                     
                        <!-- Administrator is only available if the connected user is an admin of the system -->
                        <?php if ($is_admin === TRUE) { ?>	
						<li>
                            <a href="<?php echo base_url();?>returnbook"><i class="fa fa-university fa-fw"></i>&nbsp;<i class="fa fa-reply"></i>&nbsp;Return Books</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cogs fa-fw"></i>&nbsp; Administration<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li>
                                    <a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard fa-fw"></i>&nbsp;Dashboard</a>
                                </li>
                                
                                <li>
                                    <a href="<?php echo base_url();?>books"><i class="fa fa-book fa-fw"></i>&nbsp;Books</a>
                                </li> 
								<li>
                                    <a href="<?php echo base_url();?>users"><i class="fa fa-users fa-fw"></i>&nbsp;Users</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url();?>users/userstate"></i>&nbsp;<i class="fa fa-user fa-fw"></i>&nbsp;Users state</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>bookcategory"><i class="fa fa-briefcase fa-fw"></i>&nbsp;Books Category</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>request/showAllrequest"><i class="fa fa-briefcase fa-fw"></i>&nbsp;Books Requested</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } ?>         
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
        <!-- /.navbar-static-side -->
    </nav>
<?php $msg = $this->session->flashdata('msg'); if ($msg <> '') { ?>            
<div id="flash-message-wrapper">
    <div id="flash-inner-message" class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
</div>
<?php } ?>
<?php $error = $this->session->flashdata('error'); if ($error <> '') { ?>            
<div id="flash-message-wrapper">
    <div id="flash-inner-message" class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('error'); ?>
    </div>
</div>
<?php } ?>
<div id="page-wrapper">
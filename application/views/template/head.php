<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <!-- iconic -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/open-iconic-bootstrap.css">
     <!-- App CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/app.css">   
    <title><?php echo $app_name;?></title>
  </head>
<body>
<div id="wrapper" class="toggled">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a title="<?php echo $slogan;?>" class="navbar-brand" href="<?php echo base_url();?>Home"><?php echo $app_name;?> <small class="text-muted"></small></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a href="#menu-toggle" id="menu-toggle"><span class="navbar-toggler-icon"></span></a>
      <div class="collapse navbar-collapse" id="navbarCollapse">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="#">Action</a>
					<a class="dropdown-item" href="#">Another action</a>
					<a class="dropdown-item" href="#">Something else here</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#">Separated link</a>
				</div>
			</li>
		</ul>
	   
		<?php
		if ($search_object->autorize){
			$attributes = array('class' => 'form-inline', 'id' => 'myform');
			echo form_open($search_object->url, $attributes);    
			?>
			  <input class="form-control mr-sm-2" type="search" name='global_search' id='global_search' placeholder="Search" aria-label="Search" value="<?php echo $search_object->global_search;?>">
			  <button class="btn btn-outline-success btn-sm" type="submit"><span class="oi oi-magnifying-glass"></span></button>&nbsp;
			  <?php if ($search_object->global_search){ ?>
			  <a href='<?php echo base_url($search_object->url);?>/search/reset' class='btn btn-outline-warning btn-sm'><span class="oi oi-circle-x"></span></a>
			  <?php } ?>
			</form>
			<?php
			}
		?>
      </div>
    </nav>
	<!-- Sidebar -->
	<div id="sidebar-wrapper" class="bg-dark">
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
			<ul class="nav flex-column navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url('Users_controller/list');?>">
						<span class="oi oi-people"></span> <?php echo Lang('User');?></span>
					</a>
				</li>	
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url('Family_controller/list');?>">
						<span class="oi oi-people"></span> <?php echo Lang('Family');?></span>
					</a>
				</li>
			</ul>
		</nav>
	</div>
	<!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
			
	
	<div class="row">
		<div class="col-4">
			<h2><?php echo $title;?></h2>
		</div>
		<div class="col-4">
			<?php 
			if ($this->render_object->_get('_ui_rules')){ 
				echo '<a href="'.$this->render_object->_get('_ui_rules')['add']->url.'">'.Lang('ADD').'</a>';
			}
			?>	
		</div>
	</div>	
			
			


<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
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
    <title><?php echo $title;?></title>
  </head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php echo (($this->router->class == 'home') ? 'active':'');?>">
        <a class="nav-link" href="<?php echo base_url();?>">Home </a>
      </li>
      <li class="nav-item <?php echo (($this->router->class == 'users') ? 'active':'');?>">
        <a class="nav-link" href="<?php echo base_url();?>users/"><?php echo Lang('Users');?><span class="sr-only"><?php echo (($this->router->class == 'users') ? '(current)':'');?></span></a>
      </li>      
    </ul>
    <?php
    if ($can_search){
		$attributes = array('class' => 'form-inline', 'id' => 'myform');
		echo form_open($this->router->class.'/'.$this->router->method, $attributes);    
		?>
		  <input class="form-control mr-sm-2" type="search" name='global_search' id='global_search' placeholder="Search" aria-label="Search" value="<?php echo $this->session->userdata('global_search');?>">
		  <button class="btn btn-outline-success my-2 my-sm-0 btn-sm" type="submit">Search</button>
		  <?php if ($this->session->userdata('global_search')){ ?>
		  
		  <a href='<?php echo base_url($this->router->class.'/'.$this->router->method);?>/search/reset' class='btn btn-outline-warning my-2 my-sm-0 btn-sm'>Reset</a>
		  <?php } ?>
		</form>
		<?php
		}
	?>
  </div>
</nav>
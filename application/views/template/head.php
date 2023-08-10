<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="fr">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php $this->bootstrap_tools->RenderAttachFiles('css');?>
	<title><?php echo $app_name;?></title>
</head>
<body>
	<header class="py-2 mb-3 border-bottom">


	<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample09">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
			<?php echo $this->render_menu->Get('leftmenu',  $app_name );?>
        </li>
	    <li class="nav-item">
			<?php echo $this->render_menu->Get('optionmenu');?>
        </li>
        <li class="nav-item">
			<?php echo $this->render_menu->Get('sysmenu');?>
        </li>
		<li class="nav-item">
			<?php echo $this->render_menu->Get('usermenu',  $this->acl->GetUserName() );?>
        </li>
      </ul>
	  <?php
		if ($search_object->autorize){
			$attributes = array('class' => 'form-inline my-2 my-md-0', 'id' => 'myform');
			echo form_open($search_object->url, $attributes);?>
			<input class="form-control mr-sm-4" type="search" name='global_search' id='global_search' placeholder="Search" aria-label="Search" value="<?php echo $search_object->global_search;?>">
			<?php if ($search_object->global_search){ ?>
				<a href='<?php echo base_url($search_object->url);?>/search/reset' class='btn btn-warning btn-sm'><span class="oi oi-circle-x"></span></a>
			<?php } ?>
			</form>
			<?php
		}
		?>	  
    </div>
  </nav>
</header>
    
    <div class="container-fluid">
		<h2><?php echo $title;?></h2> 
		<?php  
			if ($this->render_object->_get('_ui_rules') AND !$this->render_object->_get('form_mod')){  
				foreach($this->render_object->_get('_ui_rules') AS $rule){
					if (in_array($rule->term , $this->render_object->_get('_not_link_list')) AND $rule->autorize ){
						echo '<a class="btn btn-sm '.$this->lang->line($rule->term.'_class').'" href="'.$rule->url.'"><span class="'.$rule->icon.'"></span> '.$rule->name.'</a>&nbsp;';
					}
				}
			} 
			?>

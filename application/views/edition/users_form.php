<?php
echo form_open('Users_controller/add', array('class' => '', 'id' => 'edit') , array('form_mod'=>$form_mod,'id'=>$id) );

echo form_error('name', 	'<div class="alert alert-danger">', '</div>');
echo form_error('surname', 	'<div class="alert alert-danger">', '</div>');
echo form_error('email', 	'<div class="alert alert-danger">', '</div>');
echo form_error('password', '<div class="alert alert-danger">', '</div>');
echo form_error('type', 	'<div class="alert alert-danger">', '</div>');
echo form_error('section', 	'<div class="alert alert-danger">', '</div>');
?>
<div class="form-row">
	<div class="form-group col-md-6">
		<?php 
			echo $this->bootstrap_tools->label('name');
			echo $this->render_object->RenderFormElement('name'); 
		?>
	</div>
	<div class="form-group col-md-6">
		<?php 
			echo $this->bootstrap_tools->label('surname');
			echo $this->render_object->RenderFormElement('surname');
		?>
	</div>
</div>
<div class="form-row">
	<div class="form-group col-md-6">
		<?php 
			echo $this->bootstrap_tools->label('email');
			echo $this->render_object->RenderFormElement('email');
		?>
	</div>
	<div class="form-group col-md-6">
		<?php 
			echo $this->bootstrap_tools->label('password');
			echo $this->render_object->RenderFormElement('password'); 
		?>
	</div>
</div>
<div class="form-row">
	<div class="form-group col-md-6">
		<?php 
			echo $this->bootstrap_tools->label('type');
			echo $this->render_object->RenderFormElement('type'); 
		?>
	</div>
	<div class="form-group col-md-6">
		<?php 
			echo $this->bootstrap_tools->label('section');
			echo $this->render_object->RenderFormElement('section'); 
		?>
	</div>
</div>
<button type="submit" class="btn btn-primary"><?php echo Lang($form_mod.'_'.$this->router->class);?></button>
<?php
echo form_close();
?>

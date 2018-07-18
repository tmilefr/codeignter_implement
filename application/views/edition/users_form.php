<?php
echo form_open('users/add', array('class' => '', 'id' => 'edit') , $forms_fields['hidden_form'] );

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
			echo $forms_fields['name']->label; 
			echo $forms_fields['name']->form; 
		?>
	</div>
	<div class="form-group col-md-6">
		<?php 
			echo $forms_fields['surname']->label; 
			echo $forms_fields['surname']->form; 
		?>
	</div>
</div>
<div class="form-row">
	<div class="form-group col-md-6">
		<?php 
			echo $forms_fields['email']->label; 
			echo $forms_fields['email']->form; 
		?>
	</div>
	<div class="form-group col-md-6">
		<?php 
			echo $forms_fields['password']->label; 
			echo $forms_fields['password']->form; 
		?>
	</div>
</div>
<div class="form-row">
	<div class="form-group col-md-6">
		<?php 
			echo $forms_fields['type']->label; 
			echo $forms_fields['type']->form; 
		?>
	</div>
	<div class="form-group col-md-6">
		<?php 
			echo $forms_fields['section']->label; 
			echo $forms_fields['section']->form; 
		?>
	</div>
</div>
<button type="submit" class="btn btn-primary"><?php echo Lang('ADD_USER');?></button>
<?php
echo form_close();
?>

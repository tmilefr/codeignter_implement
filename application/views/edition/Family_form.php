<div class="container-fluid">
<?php
echo form_open('Family_controller/'.$this->render_object->_get('form_mod'), array('class' => '', 'id' => 'edit') , array('form_mod'=>$this->render_object->_get('form_mod'),'id'=>$id) );

echo form_error('name', 	'<div class="alert alert-danger">', '</div>');
echo form_error('adress', 	'<div class="alert alert-danger">', '</div>');
echo form_error('postalcode', 	'<div class="alert alert-danger">', '</div>');
echo form_error('town', '<div class="alert alert-danger">', '</div>');
echo form_error('country', 	'<div class="alert alert-danger">', '</div>');
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
			echo $this->bootstrap_tools->label('adress');
			echo $this->render_object->RenderFormElement('adress');
		?>
	</div>
</div>
<div class="form-row">
	<div class="form-group col-md-6">
		<?php 
			echo $this->bootstrap_tools->label('postalcode');
			echo $this->render_object->RenderFormElement('postalcode');
		?>
	</div>
	<div class="form-group col-md-6">
		<?php 
			echo $this->bootstrap_tools->label('town');
			echo $this->render_object->RenderFormElement('town'); 
		?>
	</div>
</div>
<div class="form-row">
	<div class="form-group col-md-6">
		<?php 
			echo $this->bootstrap_tools->label('country');
			echo $this->render_object->RenderFormElement('country'); 
		?>
	</div>
</div>
<button type="submit" class="btn btn-primary"><?php echo $this->render_object->_get('_ui_rules')[$this->render_object->_get('form_mod')]->name;?></button>
<?php
echo form_close();
?>
</div>

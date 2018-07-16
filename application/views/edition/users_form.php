<?php
$attributes = array('class' => 'email', 'id' => 'myform');
echo form_open('users/add', $attributes);
?>
<div class="form-row">
	<div class="form-group col-md-6">
		<?php
			$this->bootstrap_tools->label('name');
			$this->bootstrap_tools->input_text('name','name', $name);
		?>
	</div>
	<div class="form-group col-md-6">
		<?php
			$this->bootstrap_tools->label('surname');
			$this->bootstrap_tools->input_text('surname','surname',$surname);
		?>
	</div>
</div>
<div class="form-row">
	<div class="form-group col-md-6">
		<?php
			$this->bootstrap_tools->label('email');
			$this->bootstrap_tools->input_text('email','e-mail',$email);
		?>
	</div>
	<div class="form-group col-md-6">
		<?php
			$this->bootstrap_tools->label('password');
			$this->bootstrap_tools->input_text('password','password', $password);
		?>
	</div>
</div>
<div class="form-row">
	<div class="form-group col-md-6">
		<?php 
			$this->bootstrap_tools->label('type');
			$this->bootstrap_tools->input_select('type', array(1=>'famille',2=>'individuelle') , $type);
		?>
	</div>
	<div class="form-group col-md-6">
		<?php 
			$this->bootstrap_tools->label('section');
			$this->bootstrap_tools->input_select('section', array(1=>'Motonautisme',2=>'Ski',3=>'Voile',4=>'Wake') , $section);
		?>		
	</div>
</div>
<button type="submit" class="btn btn-primary">Add</button>
<?php
echo form_close();
?>

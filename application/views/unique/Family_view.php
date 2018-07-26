<div class="container-fluid">
	<div class="card">
	  <div class="card-header">
		<?php echo $this->render_object->RenderElement('name');?>
	  </div>
	  <div class="card-body">
		<h5 class="card-title">

		</h5>
		<p class="card-text">
			<?php 
				echo $this->render_object->RenderElement('adress').'<br/>';
				echo $this->render_object->RenderElement('postalcode').' '.$this->render_object->RenderElement('town').' '.$this->render_object->RenderElement('country') ; 
			?>
		</p>
		<?php
		if ($can_delete)
			echo '<a class="btn btn-danger" href="'.$ref_url->delete.'/'.$this->render_object->RenderElement('id').'"><span class="oi oi-circle-x"></span> </a> ';
		if ($can_edit)
			echo '<a class="btn btn-warning" href="'.$ref_url->edit.'/'.$this->render_object->RenderElement('id').'"><span class="oi oi-pencil"></span> </a> ';
		if ($can_list)
			echo '<a class="btn btn-success"href="'.$ref_url->read.'/'.$this->render_object->RenderElement('id').'"><span class="oi oi-spreadsheet"></span> </a>';		
		?>
	  </div>
	</div>	
</div>

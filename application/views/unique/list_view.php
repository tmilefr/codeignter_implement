<div class="container-fluid">
	<table class="table table-striped table-sm">
	  <thead>
		<tr>			
			<th scope="col">&nbsp;</th>
			<?php
			foreach($this->{$_model_name}->_get('defs') AS $field=>$defs){
				if ($defs->list === true){
					echo '<th scope="col">'.$this->render_object->render_link($field).'</a></th>';
				}
			}
			?>

		  </tr>
	  </thead>
	  <tbody>
	<?php 
	foreach($datas AS $key => $data){
		echo '<tr>';
		echo '<td>';
			echo $this->render_object->render_element_menu($data);
		echo '</td>';	

		foreach($this->{$_model_name}->_get('defs') AS $field=>$defs){
			if ($defs->list === true){
				//echo debug($data);
				echo '<td>'.$this->render_object->RenderElement($field, $data->{$field}, $data->id).'</td>';
			}
		}
		echo '</tr>';
	}
	?>
	</tbody>
	</table>
</div>



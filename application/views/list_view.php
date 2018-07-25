<div class="container-fluid">
	<table class="table table-sm">
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
		if ($can_delete)
			echo '<a href="'.base_url().$_controller_name.'/delete/'.$data->id.'"><span class="oi oi-circle-x"></span></a>';
		if ($can_edit)
			echo '<a href="'.base_url().$_controller_name.'/edit/'.$data->id.'"><span class="oi oi-pencil"></span></a>';
		echo '</td>';	

		foreach($this->{$_model_name}->_get('defs') AS $field=>$defs){
			if ($defs->list === true){
				echo '<td>'.$this->render_object->RenderElement($field, $data->{$field}).'</td>';
			}
		}
		echo '</tr>';
	}
	?>
	</tbody>
	</table>
</div>

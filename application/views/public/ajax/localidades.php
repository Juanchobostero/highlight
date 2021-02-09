<option value="0">Seleccione...</option>
<?php foreach($localidades as $localidad):?>
<option value="<?=$localidad->id_localidad?>"><?=$localidad->descripcionLOC?></option>
<?php endforeach;?>
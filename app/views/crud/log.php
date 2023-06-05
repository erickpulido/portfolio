<h1>Log detail</h1>

<table width="90%" align="center" border="1" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Fecha de creación</th>
			<th>Nombre</th>
			<th>Fecha modificación</th>
			<th>Acción</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($log as $key => $item): ?>
			<tr>
				<td>
					<?php echo $item['createDate']; ?>
				</td>
				<td>
					<?php echo $item['name'] . " " . $item['lastname']; ?>
				</td>
				<td>
					<?php echo $item['updateDate']; ?>
				</td>
				<td>
					<?php echo $item['action']; ?>
				</td>
				<td>
					<form action="index.php?url=Crud/cud/restore" method="POST">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="key" value="<?php echo $key; ?>">
						<?php if($key !== count($log) - 1): ?><button type="submit">Reestablecer</button> <?php endif ?>
					</form>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<a href="index.php?url=Crud/index">Regresar</a>
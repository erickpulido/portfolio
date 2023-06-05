<h1>Personal</h1>

<a href="index.php?url=Crud/detail/create">Nuevo</a>

<table width="90%" align="center" border="1" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $item): ?>
			<tr>
				<td>
					<?php echo $item['name'] . " " . $item['lastname']; ?>
				</td>
				<td>
					<form action="index.php?url=Crud/detail/update" method="POST">
						<input type="hidden" name="id" value="<?php echo base64_encode($item['id']); ?>">
						<button type="submit">Actualizar</button>
					</form>
					<form action="index.php?url=Crud/detail/delete" method="POST">
						<input type="hidden" name="id" value="<?php echo base64_encode($item['id']); ?>">
						<button type="submit">Eliminar</button>
					</form>
					<form action="index.php?url=Crud/log" method="POST">
						<input type="hidden" name="id" value="<?php echo base64_encode($item['id']); ?>">
						<button type="submit">Log</button>
					</form>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
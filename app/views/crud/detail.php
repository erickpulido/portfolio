<h1>User details</h1>

<form action="index.php?url=Crud/cud/<?php echo $action; ?>" method="POST">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="text" name="name" value="<?php echo $name; ?>">
	<input type="text" name="lastname" value="<?php echo $lastname; ?>">
	<a href="index.php?url=Crud/index">Regresar</a>
	<button type="submit"><?php echo $action; ?></button>
</form>
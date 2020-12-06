<?php
include 'funcion.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $lastName = isset($_POST['apellido']) ? $_POST['apellido'] : '';
        $email = isset($_POST['correo']) ? $_POST['correo'] : '';
        $phone = isset($_POST['telefono']) ? $_POST['telefono'] : '';
        $title = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';
        $created = isset($_POST['creacion']) ? $_POST['creacion'] : date('Y-m-d H:i:s');
        // Update the record
        $stmt = $pdo->prepare('UPDATE contactos SET id = ?, nombre = ?, apellido = ?, correo = ?, telefono = ?, mensaje = ?, creacion = ? WHERE id = ?');
        $stmt->execute([$id, $name, $lastName, $email, $phone, $title, $created, $_GET['id']]);
        $msg = 'actualizado correctamente!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM contactos WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('ID no esta especificado!');
}
?>














<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="name">nombre</label>
        <input type="text" name="id" placeholder="1" value="<?=$contact['id']?>" id="id">
        <input type="text" name="name" placeholder="John Doe" value="<?=$contact['name']?>" id="name">

        
        <label for="name">apellido</label>
        <input type="text" name="id" placeholder="1" value="<?=$contact['apellido']?>" id="id">

        <label for="email">correo</label>
        <label for="phone">telefono</label>
        <input type="text" name="email" placeholder="johndoe@example.com" value="<?=$contact['correo']?>" id="email">
        <input type="text" name="phone" placeholder="2025550143" value="<?=$contact['telefono']?>" id="phone">
        <label for="title">mensaje</label>
        <label for="created">creacion</label>
        <input type="text" name="title" placeholder="Employee" value="<?=$contact['mensaje']?>" id="title">
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($contact['created']))?>" id="created">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
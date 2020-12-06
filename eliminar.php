<?php
include 'funcion.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM contactos WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM contactos WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = '¡Has eliminado el contacto!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: leer.php');
            exit;
        }
    }
} else {
    exit('¡No se ha especificado ningún ID!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>eliminar contacto #<?=$contact['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>¿Estás segur@ de que quieres eliminar el contacto? #<?=$contact['id']?>?</p>
    <div class="yesno">
        <a href="eliminar.php?id=<?=$contact['id']?>&confirm=yes">si awebos</a>
        <a href="eliminar.php?id=<?=$contact['id']?>&confirm=no">no prro</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
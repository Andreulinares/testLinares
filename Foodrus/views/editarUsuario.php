<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar datos</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <form action="index.php?controller=usuario&action=actualizar" method="post">
        <input type="hidden" name="id" value="<?= $usuario->getCliente_id()?>">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?= $usuario->getNombre(); ?>" required>
        </div>
        <div class="form-group">
            <label for="apell">Apellidos</label>
            <input type="text" id="apell" name="apell" value="<?= $usuario->getApellidos(); ?>" required>
        </div>
        <div class="form-group">
            <label for="tel">Numero de telefono:</label>
            <input type="number" id="tel" name="tel" value="<?= $usuario->getTelefono(); ?>" required>
        </div>
        <div class="form-group">
            <label for="mail">Correo electrónico</label>
            <input type="email" id="mail" name="mail" value="<?= $usuario->getEmail(); ?>" required>
        </div>
        <div class="form-group">
            <label for="passwd">Contraseña:</label>
            <input type="password" id="passwd" name="passwd" value="<?= $usuario->getPassword(); ?>" required>
        </div>

        <button type="submit" name="act-datos">Actualizar</button>
    </form>
</body>
</html>
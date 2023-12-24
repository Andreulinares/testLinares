<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar datos</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="/Foodrus/assets/css/editarUsuario.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
    <div class="principal">
        <h2 class="titulo">Datos Personales</h2>
        <hr class="linea">

        <form action="index.php?controller=usuario&action=actualizar" method="post">
            <input type="hidden" name="id" value="<?= $usuario->getCliente_id()?>">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control label-form" id="nombre" name="nombre" value="<?= $usuario->getNombre(); ?>" required>
            </div>
            <div class="form-group">
                <label for="apell">Apellidos</label>
                <input type="text" class="form-control label-form" id="apell" name="apell" value="<?= $usuario->getApellidos(); ?>" required>
            </div>
            <div class="form-group">
                <label for="tel">Numero de telefono:</label>
                <input type="number" class="form-control label-form" id="tel" name="tel" value="<?= $usuario->getTelefono(); ?>" required>
            </div>
            <div class="form-group">
                <label for="mail">Correo electrónico</label>
                <input type="email" class="form-control label-form" id="mail" name="mail" value="<?= $usuario->getEmail(); ?>" required>
            </div>
            <div class="form-group">
                <label for="passwd">Contraseña:</label>
                <input type="password" class="form-control label-form" id="passwd" name="passwd" value="<?= $usuario->getPassword(); ?>" required>
            </div>

            <a href="index.php?controller=usuario&action=cancelar" class="btn btn-secondary btn-cancelar">CANCELAR</a>
            <button type="submit" name="act-datos" class="btn btn-act">ACTUALIZAR</button>
        </form>
    </div>
</body>
</html>
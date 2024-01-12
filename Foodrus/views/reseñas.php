<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/formulario_reseñas.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
    <header></header>

    <h3 class="h3-reseña">Deja tu reseña</h3>
        <form id="form-reseñas" action="" method="post">
            <div class="form-group">
                <label for="coment">Comentario</label>
                <textarea class="form-control label-form" id="coment" name="coment" required></textarea>
            </div>
            <div class="form-group">
                <label for="puntuacion">Puntuacion</label>
                <input type="number" id="puntuacion" name="puntuacion" min="1" max="5" required>
            </div>
            <button type="submit" class="btn-enviar">Enviar</button>
        </form>

    <h2 class="h2-reseña">Reseñas de los clientes</h2>

    <div id="reseñas-container">
        <table id="tablaReseñas" border="1">
            <thead>
                <tr>
                    <th>Comentario</th>
                    <th>Puntuación</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>

    <script src="../assets/js/reseñas.js"></script>
</body>
</html>
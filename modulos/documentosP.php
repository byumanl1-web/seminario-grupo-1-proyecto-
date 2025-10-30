<?php
// Iniciar la sesión solo si no se ha iniciado ya
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Aseguramos que el usuario esté logueado y sea paciente
if (!isset($_SESSION["Ingresar"]) || $_SESSION["rol"] != "Paciente") {
    echo "Acceso no autorizado.";
    exit;
}

// Incluir la conexión a la base de datos usando una ruta absoluta
include_once($_SERVER['DOCUMENT_ROOT'] . '/clinica/Modelos/ConexionBD.php');

// Procesar la carga de documentos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['documento'])) {
    // Validar que el archivo fue subido correctamente
    $archivo = $_FILES['documento'];
    if ($archivo['error'] == UPLOAD_ERR_OK) {
        // Definir la ruta donde se almacenarán los archivos
        $carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . '/clinica/uploads/'; // Ruta donde guardarás los archivos subidos
        $nombreArchivo = time() . "_" . basename($archivo['name']);
        $rutaArchivo = $carpetaDestino . $nombreArchivo;

        // Mover el archivo al directorio de destino
        if (move_uploaded_file($archivo['tmp_name'], $rutaArchivo)) {
            // Insertar los datos en la base de datos
            $pdo = ConexionBD::cBD();
            $sql = "INSERT INTO documentos (paciente_id, nombre_documento, ruta_documento, tipo_documento, fecha_subida) 
                    VALUES (?, ?, ?, ?, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_SESSION["id"], $nombreArchivo, $rutaArchivo, $archivo['type']]);
            
            echo "<div class='alert alert-success'>Documento subido con éxito.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al subir el archivo. Por favor, inténtelo de nuevo.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error al procesar el archivo. Verifique el tipo y tamaño del archivo.</div>";
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Mis Documentos</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Aquí puedes ver y cargar tus documentos médicos</h3>
            </div>
            
            <!-- Box body (contenido) -->
            <div class="box-body">

                <!-- Mensaje en el centro de la página -->
                <div class="alert alert-info" role="alert">
                    ¡Aquí van tus documentos médicos! Aún no hay documentos disponibles.
                </div>

                <!-- Sección de cargar documentos -->
                <div class="row">
                    <div class="col-md-6">
                        <h4>Cargar nuevo documento:</h4>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="documento">Seleccionar archivo</label>
                                <input type="file" class="form-control" name="documento" id="documento" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Subir documento</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Mostrar documentos disponibles -->
                <h4>Documentos disponibles:</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre del Documento</th>
                            <th>Fecha de Carga</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Consultar los documentos cargados por el paciente
                        $pdo = ConexionBD::cBD();
                        $sql = "SELECT * FROM documentos WHERE paciente_id = ? ORDER BY fecha_subida DESC";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$_SESSION["id"]]);
                        $documentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($documentos) > 0) {
                            foreach ($documentos as $doc) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($doc['nombre_documento']) . "</td>";
                                echo "<td>" . date("d/m/Y", strtotime($doc['fecha_subida'])) . "</td>";
                                echo "<td>";

                                // Generar la ruta pública para el archivo
                                $rutaRelativa = '/clinica/uploads/' . basename($doc['ruta_documento']);

                                // Enlace para ver el documento
                                echo "<a href='" . $rutaRelativa . "' class='btn btn-info btn-sm' target='_blank'>Ver</a> ";

                                // Botón de eliminar documento
                                echo "<a href='eliminar_documento.php?id=" . $doc['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de eliminar este documento?\");'>Eliminar</a>";

                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No tienes documentos cargados.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>

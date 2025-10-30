<?php

class PacientesC {

    //Crear Pacientes
    public function CrearPacienteC() {

        if (isset($_POST["rolP"])) {

            $tablaBD = "pacientes";

            $datosC = array(
                "apellido" => $_POST["apellido"],
                "nombre" => $_POST["nombre"],
                "documento" => $_POST["documento"],
                "usuario" => $_POST["usuario"],
                "clave" => $_POST["clave"],
                "rol" => $_POST["rolP"],
                "alergias" => $_POST["alergias"],
                "enfermedades" => $_POST["enfermedades"],
                "cirugias" => $_POST["cirugias"],
                "vacunas" => $_POST["vacunas"],
                "medicamentos" => $_POST["medicamentos"],
                "habitos" => $_POST["habitos"],
                "antecedentes_familiares" => $_POST["antecedentes_familiares"]
            );

            $resultado = PacientesM::CrearPacienteM($tablaBD, $datosC);

            if ($resultado == true) {
                echo '<script>window.location = "pacientes";</script>';
            }
        }
    }

    //Ver Pacientes
    static public function VerPacientesC($columna, $valor) {
        $tablaBD = "pacientes";
        return PacientesM::VerPacientesM($tablaBD, $columna, $valor);
    }

    //Borrar Paciente
    public function BorrarPacienteC() {
        if (isset($_GET["Pid"])) {
            $tablaBD = "pacientes";
            $id = $_GET["Pid"];

            if ($_GET["imgP"] != "") {
                unlink($_GET["imgP"]);
            }

            $resultado = PacientesM::BorrarPacienteM($tablaBD, $id);

            if ($resultado == true) {
                echo '<script>window.location = "pacientes";</script>';
            }
        }
    }

    //Actualizar Paciente
    public function ActualizarPacienteC() {
        if (isset($_POST["Pid"])) {
            $tablaBD = "pacientes";
            $datosC = array(
                "id" => $_POST["Pid"],
                "apellido" => $_POST["apellidoE"],
                "nombre" => $_POST["nombreE"],
                "documento" => $_POST["documentoE"],
                "usuario" => $_POST["usuarioE"],
                "clave" => $_POST["claveE"],
                "alergias" => $_POST["alergiasE"],
                "enfermedades" => $_POST["enfermedadesE"],
                "cirugias" => $_POST["cirugiasE"],
                "vacunas" => $_POST["vacunasE"],
                "medicamentos" => $_POST["medicamentosE"],
                "habitos" => $_POST["habitosE"],
                "antecedentes_familiares" => $_POST["antecedentes_familiaresE"]
            );

            $resultado = PacientesM::ActualizarPacienteM($tablaBD, $datosC);

            if ($resultado == true) {
                echo '<script>window.location = "pacientes";</script>';
            }
        }
    }

    public function IngresarPacienteC() {

        if (isset($_POST["usuario-Ing"]) && isset($_POST["clave-Ing"])) {

            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario-Ing"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["clave-Ing"])) {

                $tablaBD = "pacientes";
                $datosC = array(
                    "usuario" => $_POST["usuario-Ing"], 
                    "clave" => $_POST["clave-Ing"]
                );

                $resultado = PacientesM::IngresarPacienteM($tablaBD, $datosC);

                if ($resultado && $resultado["usuario"] == $_POST["usuario-Ing"] && $resultado["clave"] == $_POST["clave-Ing"]) {

                    if (session_status() !== PHP_SESSION_ACTIVE) {
                        session_start();
                    }

                    $_SESSION["Ingresar"] = true;
                    $_SESSION["id"] = $resultado["id"];
                    $_SESSION["usuario"] = $resultado["usuario"];
                    $_SESSION["clave"] = $resultado["clave"];
                    $_SESSION["apellido"] = $resultado["apellido"];
                    $_SESSION["nombre"] = $resultado["nombre"];
                    $_SESSION["documento"] = $resultado["documento"];
                    $_SESSION["foto"] = $resultado["foto"];
                    $_SESSION["rol"] = $resultado["rol"];

                    echo '<script>window.location = "inicio";</script>';
                    return true;
                } else {
                    return false;
                }
            }
        }

        return false;
    }

    //Ver Perfil del Paciente
    public function VerPerfilPacienteC() {
        $tablaBD = "pacientes";
        $id = $_SESSION["id"];
        $resultado = PacientesM::VerPerfilPacienteM($tablaBD, $id);

        echo '<tr>
                <td>'.$resultado["usuario"].'</td>
                <td>'.$resultado["clave"].'</td>
                <td>'.$resultado["nombre"].'</td>
                <td>'.$resultado["apellido"].'</td>';

        if ($resultado["foto"] == "") {
            echo '<td><img src="Vistas/img/defecto.png" width="40px"></td>';
        } else {
            echo '<td><img src="'.$resultado["foto"].'" width="40px"></td>';
        }

        echo '<td>'.$resultado["documento"].'</td>
              <td>'.$resultado["alergias"].'</td>
              <td>'.$resultado["enfermedades"].'</td>
              <td>'.$resultado["cirugias"].'</td>
              <td>'.$resultado["vacunas"].'</td>
              <td>'.$resultado["medicamentos"].'</td>
              <td>'.$resultado["habitos"].'</td>
              <td>'.$resultado["antecedentes_familiares"].'</td>
              <td><a href="http://localhost/clinica/perfil-P/'.$resultado["id"].'">
                  <button class="btn btn-success"><i class="fa fa-pencil"></i></button></a></td></tr>';
    }

// ✅ NUEVO MÉTODO: Editar Perfil del Paciente (con botón para ver contraseña)
public function EditarPerfilPacienteC() {

    $tablaBD = "pacientes";
    $id = $_SESSION["id"];
    $resultado = PacientesM::VerPerfilPacienteM($tablaBD, $id);

    echo '
    <style>
        .perfil-container {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 30px 40px;
        }
        .perfil-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .perfil-header h2 {
            color: #28a745;
            font-weight: 600;
        }
        .perfil-foto {
            text-align: center;
            margin-bottom: 20px;
        }
        .perfil-foto img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #28a745;
        }
        .perfil-foto label {
            margin-top: 10px;
            display: block;
        }
        textarea.form-control {
            min-height: 60px;
            resize: vertical;
        }
        .btn-guardar {
            display: block;
            width: 100%;
            padding: 12px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
        }
        /* Estilo del botón de ver contraseña */
        .input-group-text {
            cursor: pointer;
            background: #e9ecef;
            border-left: none;
        }
        .input-group .form-control {
            border-right: none;
        }
    </style>

    <div class="perfil-container">
        <div class="perfil-header">
            <h2><i class="fa fa-user-circle"></i> Editar Perfil del Paciente</h2>
            <p>Actualiza tus datos personales y médicos</p>
        </div>

        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="Pid" value="'.$resultado["id"].'">

            <div class="perfil-foto">
                ';

                if ($resultado["foto"] == "") {
                    echo '<img src="Vistas/img/defecto.png">';
                } else {
                    echo '<img src="'.$resultado["foto"].'">';
                }

                echo '
                <label for="imgPerfil" class="btn btn-sm btn-outline-success mt-2">Cambiar foto</label>
                <input type="file" id="imgPerfil" name="imgPerfil" class="form-control" style="display:none;">
                <input type="hidden" name="imgActual" value="'.$resultado["foto"].'">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Usuario:</label>
                        <input type="text" class="form-control" name="usuarioPerfil" value="'.$resultado["usuario"].'">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Clave:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="clavePerfil" name="clavePerfil" value="'.$resultado["clave"].'">
                            <span class="input-group-text" id="togglePassword">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" name="nombrePerfil" value="'.$resultado["nombre"].'">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Apellido:</label>
                        <input type="text" class="form-control" name="apellidoPerfil" value="'.$resultado["apellido"].'">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Documento:</label>
                <input type="text" class="form-control" name="documentoPerfil" value="'.$resultado["documento"].'">
            </div>

            <hr>

            <h4 class="text-success mt-4"><i class="fa fa-heartbeat"></i> Información Médica</h4>

            <div class="form-group mt-3">
                <label>Alergias:</label>
                <textarea class="form-control" name="alergiasPerfil">'.$resultado["alergias"].'</textarea>
            </div>

            <div class="form-group">
                <label>Enfermedades:</label>
                <textarea class="form-control" name="enfermedadesPerfil">'.$resultado["enfermedades"].'</textarea>
            </div>

            <div class="form-group">
                <label>Cirugías:</label>
                <textarea class="form-control" name="cirugiasPerfil">'.$resultado["cirugias"].'</textarea>
            </div>

            <div class="form-group">
                <label>Vacunas:</label>
                <textarea class="form-control" name="vacunasPerfil">'.$resultado["vacunas"].'</textarea>
            </div>

            <div class="form-group">
                <label>Medicamentos:</label>
                <textarea class="form-control" name="medicamentosPerfil">'.$resultado["medicamentos"].'</textarea>
            </div>

            <div class="form-group">
                <label>Hábitos:</label>
                <textarea class="form-control" name="habitosPerfil">'.$resultado["habitos"].'</textarea>
            </div>

            <div class="form-group">
                <label>Antecedentes Familiares:</label>
                <textarea class="form-control" name="antecedentesPerfil">'.$resultado["antecedentes_familiares"].'</textarea>
            </div>

            <button type="submit" class="btn btn-success btn-guardar mt-4">
                <i class="fa fa-save"></i> Guardar Cambios
            </button>
        </form>
    </div>

    <script>
        // Script para mostrar/ocultar la contraseña
        document.getElementById("togglePassword").addEventListener("click", function() {
            const input = document.getElementById("clavePerfil");
            const icon = this.querySelector("i");
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    </script>
    ';
}

    //Actualizar Perfil del Paciente
    public function ActualizarPerfilPacienteC() {

        if (isset($_POST["Pid"])) {

            $rutaImg = $_POST["imgActual"];

            if (isset($_FILES["imgPerfil"]["tmp_name"]) && !empty($_FILES["imgPerfil"]["tmp_name"])) {

                if (!empty($_POST["imgActual"])) {
                    unlink($_POST["imgActual"]);
                }

                if ($_FILES["imgPerfil"]["type"] == "image/png") {
                    $nombre = mt_rand(100, 999);
                    $rutaImg = "Vistas/img/Pacientes/Paciente".$nombre.".png";
                    $foto = imagecreatefrompng($_FILES["imgPerfil"]["tmp_name"]);
                    imagepng($foto, $rutaImg);
                }

                if ($_FILES["imgPerfil"]["type"] == "image/jpeg") {
                    $nombre = mt_rand(100, 999);
                    $rutaImg = "Vistas/img/Pacientes/Paciente".$nombre.".jpg";
                    $foto = imagecreatefromjpeg($_FILES["imgPerfil"]["tmp_name"]);
                    imagejpeg($foto, $rutaImg);
                }
            }

            $tablaBD = "pacientes";

            $datosC = array(
                "id" => $_POST["Pid"],
                "nombre" => $_POST["nombrePerfil"],
                "apellido" => $_POST["apellidoPerfil"],
                "usuario" => $_POST["usuarioPerfil"],
                "clave" => $_POST["clavePerfil"],
                "documento" => $_POST["documentoPerfil"],
                "foto" => $rutaImg,
                "alergias" => $_POST["alergiasPerfil"],
                "enfermedades" => $_POST["enfermedadesPerfil"],
                "cirugias" => $_POST["cirugiasPerfil"],
                "vacunas" => $_POST["vacunasPerfil"],
                "medicamentos" => $_POST["medicamentosPerfil"],
                "habitos" => $_POST["habitosPerfil"],
                "antecedentes_familiares" => $_POST["antecedentesPerfil"]
            );

            $resultado = PacientesM::ActualizarPerfilPacienteM($tablaBD, $datosC);

            if ($resultado == true) {
                echo '<script>window.location = "http://localhost/clinica/perfil-P/'.$_SESSION["id"].'";</script>';
            }
        }
    }
}

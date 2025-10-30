<?php

class DoctoresC {
    // Crear Doctores
   public function CrearDoctorC() {

    if (isset($_POST["rolD"])) {

        $tablaBD = "doctores";

        // Verificar si el usuario ya existe
        $usuarioExistente = DoctoresM::VerDoctorUsuarioM($tablaBD, $_POST["usuario"]);

        if ($usuarioExistente != false) {
            // ⚠️ Notificación de error centrada
            echo '
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const alerta = document.createElement("div");
                    alerta.textContent = "⚠️ Este usuario ya existe. Elige otro.";
                    Object.assign(alerta.style, {
                        position: "fixed",
                        top: "50%",
                        left: "50%",
                        transform: "translate(-50%, -50%)",
                        backgroundColor: "#dc3545",
                        color: "#fff",
                        padding: "15px 25px",
                        borderRadius: "8px",
                        fontFamily: "Arial, sans-serif",
                        fontSize: "16px",
                        boxShadow: "0 4px 10px rgba(0,0,0,0.3)",
                        zIndex: "9999",
                        opacity: "1",
                        transition: "opacity 0.5s ease"
                    });
                    document.body.appendChild(alerta);
                    setTimeout(() => {
                        alerta.style.opacity = "0";
                        setTimeout(() => alerta.remove(), 500);
                    }, 3000);
                });
            </script>';
        } else {

            // Crear nuevo doctor
            $datosC = array(
                "rol" => $_POST["rolD"],
                "apellido" => $_POST["apellido"],
                "nombre" => $_POST["nombre"],
                "sexo" => $_POST["sexo"],
                "id_consultorio" => $_POST["consultorio"],
                "usuario" => $_POST["usuario"],
                "clave" => $_POST["clave"]
            );

            $resultado = DoctoresM::CrearDoctorM($tablaBD, $datosC);

            if ($resultado == true) {
                // ✅ Notificación de éxito centrada
                echo '
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        const exito = document.createElement("div");
                        exito.textContent = "✅ Doctor creado con éxito";
                        Object.assign(exito.style, {
                            position: "fixed",
                            top: "50%",
                            left: "50%",
                            transform: "translate(-50%, -50%)",
                            backgroundColor: "#28a745",
                            color: "#fff",
                            padding: "15px 25px",
                            borderRadius: "8px",
                            fontFamily: "Arial, sans-serif",
                            fontSize: "16px",
                            boxShadow: "0 4px 10px rgba(0,0,0,0.3)",
                            zIndex: "9999",
                            opacity: "1",
                            transition: "opacity 0.5s ease"
                        });
                        document.body.appendChild(exito);
                        setTimeout(() => {
                            exito.style.opacity = "0";
                            setTimeout(() => {
                                exito.remove();
                                window.location = "doctores";
                            }, 500);
                        }, 2000);
                    });
                </script>';
            }
        }
    }
}



	//Mostrar Doctores
	static public function VerDoctoresC($columna, $valor){
		$tablaBD = "doctores";
		$resultado = DoctoresM::VerDoctoresM($tablaBD, $columna, $valor);
		return $resultado;
	}


	//Editar Doctor
	static public function DoctorC($columna, $valor){
		$tablaBD = "doctores";
		$resultado = DoctoresM::DoctorM($tablaBD, $columna, $valor);
		return $resultado;
	}


	//Actualizar Doctor
	public function ActualizarDoctorC(){

		if(isset($_POST["Did"])){

			$tablaBD = "doctores";

			$datosC = array(
				"id"=>$_POST["Did"],
				"apellido"=>$_POST["apellidoE"],
				"nombre"=>$_POST["nombreE"],
				"sexo"=>$_POST["sexoE"],
				"usuario"=>$_POST["usuarioE"],
				"clave"=>$_POST["claveE"]
			);

			$resultado = DoctoresM::ActualizarDoctorM($tablaBD, $datosC);

			if($resultado == true){
				echo '<script>window.location = "doctores";</script>';
			}
		}
	}


	//Borrar Doctor
	public function BorrarDoctorC(){

		if(isset($_GET["Did"])){

			$tablaBD = "doctores";
			$id = $_GET["Did"];

			if($_GET["imgD"] != ""){
				unlink($_GET["imgD"]);
			}

			$resultado = DoctoresM::BorrarDoctorM($tablaBD, $id);

			if($resultado == true){
				echo '<script>window.location = "doctores";</script>';
			}
		}
	}


public function IngresarDoctorC() {
    if (isset($_POST["usuario-Ing"]) && isset($_POST["clave-Ing"])) {

        if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario-Ing"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["clave-Ing"])) {

            $tablaBD = "doctores";
            $datosC = array(
                "usuario" => $_POST["usuario-Ing"],
                "clave" => $_POST["clave-Ing"]
            );

            $resultado = DoctoresM::IngresarDoctorM($tablaBD, $datosC);

            if ($resultado && is_array($resultado)) {
                if ($resultado["usuario"] == $_POST["usuario-Ing"] && $resultado["clave"] == $_POST["clave-Ing"]) {

                    if (session_status() !== PHP_SESSION_ACTIVE) {
                        session_start();
                    }

                    $_SESSION["Ingresar"] = true;
                    $_SESSION["id"] = $resultado["id"];
                    $_SESSION["usuario"] = $resultado["usuario"];
                    $_SESSION["clave"] = $resultado["clave"];
                    $_SESSION["apellido"] = $resultado["apellido"];
                    $_SESSION["nombre"] = $resultado["nombre"];
                    $_SESSION["sexo"] = $resultado["sexo"];
                    $_SESSION["foto"] = $resultado["foto"];
                    $_SESSION["rol"] = $resultado["rol"];

                    // Redirigir al inicio
                    echo '<script>window.location = "inicio";</script>';
                    return true;
                }
            }
        }
    }
    return false; // Login fallido
}



	//Ver Perfil Doctor
	public function VerPerfilDoctorC(){

		$tablaBD = "doctores";
		$id = $_SESSION["id"];

		$resultado = DoctoresM::VerPerfilDoctorM($tablaBD, $id);

		if(!$resultado || !is_array($resultado)){
			echo "<tr><td colspan='8' style='color:red;'>Error: No se pudo cargar el perfil del doctor.</td></tr>";
			return;
		}

		echo '<tr>
			<td>'.$resultado["usuario"].'</td>
			<td>'.$resultado["clave"].'</td>
			<td>'.$resultado["sexo"].'</td>
			<td>'.$resultado["nombre"].'</td>
			<td>'.$resultado["apellido"].'</td>';

		if($resultado["foto"] == ""){
			echo '<td><img src="Vistas/img/defecto.png" width="40px"></td>';
		}else{
			echo '<td><img src="'.$resultado["foto"].'" width="40px"></td>';
		}
				
		$columna = "id";
		$valor = $resultado["id_consultorio"];

		$consultorio = ConsultoriosC::VerConsultoriosC($columna, $valor);
		if($consultorio && is_array($consultorio)){
			echo '<td>'.$consultorio["nombre"].'</td>';
		}else{
			echo '<td>No asignado</td>';
		}

		echo '<td>
				Desde: '.$resultado["horarioE"].'<br>
				Hasta: '.$resultado["horarioS"].'
			</td>
			<td>
				<a href="http://localhost/clinica/perfil-D/'.$resultado["id"].'">
					<button class="btn btn-success"><i class="fa fa-pencil"></i></button>
				</a>
			</td>
		</tr>';
	}


	//Editar Perfil Doctor
	public function EditarPerfilDoctorC(){

		$tablaBD = "doctores";
		$id = $_SESSION["id"];

		$resultado = DoctoresM::VerPerfilDoctorM($tablaBD, $id);

		if(!$resultado || !is_array($resultado)){
			echo "<p style='color:red;'>Error: No se pudo cargar el perfil para editar.</p>";
			return;
		}

		echo '<form method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<h2>Nombre:</h2>
					<input type="text" class="input-lg" name="nombrePerfil" value="'.$resultado["nombre"].'">
					<input type="hidden" name="Did" value="'.$resultado["id"].'">	

					<h2>Apellido:</h2>
					<input type="text" class="input-lg" name="apellidoPerfil" value="'.$resultado["apellido"].'">

					<h2>Usuario:</h2>
					<input type="text" class="input-lg" name="usuarioPerfil" value="'.$resultado["usuario"].'">

					<h2>Contraseña:</h2>
					<input type="text" class="input-lg" name="clavePerfil" value="'.$resultado["clave"].'">';

		$columna = "id";
		$valor = $resultado["id_consultorio"];
		$consultorio = ConsultoriosC::VerConsultoriosC($columna, $valor);

		echo '<h2>Consultorio Actual: '.($consultorio ? $consultorio["nombre"] : 'No asignado').'</h2>
			<h3>Cambiar Consultorio</h3>
			<select class="input-lg" name="consultorioPerfil">';

		$columna = null;
		$valor = null;
		$consultorios = ConsultoriosC::VerConsultoriosC($columna, $valor);

		if($consultorios && is_array($consultorios)){
			foreach ($consultorios as $key => $value) {
				echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
			}
		}

		echo '</select>
			<div class="form-group">
				<h2>Horario:</h2>
				Desde: <input type="time" class="input-lg" name="hePerfil" value="'.$resultado["horarioE"].'">
				Hasta: <input type="time" class="input-lg" name="hsPerfil" value="'.$resultado["horarioS"].'">
			</div>
		</div>

		<div class="col-md-6 col-xs-12">
			<br><br>
			<input type="file" name="imgPerfil"><br>';

		if($resultado["foto"] == ""){
			echo '<img src="http://localhost/clinica/Vistas/img/defecto.png" class="img-responsive" width="200px">';
		}else{
			echo '<img src="http://localhost/clinica/'.$resultado["foto"].'" class="img-responsive" width="200px">';
		}

		echo '<input type="hidden" name="imgActual" value="'.$resultado["foto"].'">
			<br><br>
			<button type="submit" class="btn btn-success">Guardar Cambios</button>
		</div>
	</div>
</form>';
	}


	//Actualizar Perfil Doctor
	public function ActualizarPerfilDoctorC(){

		if(isset($_POST["Did"])){

			$rutaImg = $_POST["imgActual"];

			if(isset($_FILES["imgPerfil"]["tmp_name"]) && !empty($_FILES["imgPerfil"]["tmp_name"])){

				if(!empty($_POST["imgActual"]) && file_exists($_POST["imgActual"])){
					unlink($_POST["imgActual"]);
				}

				$nombre = mt_rand(100,999);

				if($_FILES["imgPerfil"]["type"] == "image/png"){
					$rutaImg = "Vistas/img/Doctores/Doc-".$nombre.".png";
					$foto = imagecreatefrompng($_FILES["imgPerfil"]["tmp_name"]);
					imagepng($foto, $rutaImg);
				}

				if($_FILES["imgPerfil"]["type"] == "image/jpeg"){
					$rutaImg = "Vistas/img/Doctores/Doc-".$nombre.".jpg";
					$foto = imagecreatefromjpeg($_FILES["imgPerfil"]["tmp_name"]);
					imagejpeg($foto, $rutaImg);
				}
			}

			$tablaBD = "doctores";

			$datosC = array(
				"id"=>$_POST["Did"],
				"nombre"=>$_POST["nombrePerfil"],
				"apellido"=>$_POST["apellidoPerfil"],
				"usuario"=>$_POST["usuarioPerfil"],
				"clave"=>$_POST["clavePerfil"],
				"consultorio"=>$_POST["consultorioPerfil"],
				"horarioE"=>$_POST["hePerfil"],
				"horarioS"=>$_POST["hsPerfil"],
				"foto"=>$rutaImg
			);

			$resultado = DoctoresM::ActualizarPerfilDoctorM($tablaBD, $datosC);

			if($resultado == true){
				echo '<script>window.location = "http://localhost/clinica/perfil-D/'.$_POST["Did"].'";</script>';
			}else{
				echo "<p style='color:red;'>Error al actualizar el perfil del doctor.</p>";
			}
		}
	}
}

?>

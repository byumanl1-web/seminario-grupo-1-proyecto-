<?php

class InicioC {

	public function MostrarInicioC() {

		$tablaBD = "inicio";
		$id = "1";
		$resultado = InicioM::MostrarInicioM($tablaBD, $id);

		echo '
		<style>
			.inicio-container {
				display: flex;
				flex-wrap: wrap;
				align-items: center;
				justify-content: center;
				padding: 60px 20px;
				background: linear-gradient(135deg, #e3f2fd, #c8e6c9);
				min-height: 100vh;
			}

			.inicio-card {
				background: #fff;
				border-radius: 15px;
				box-shadow: 0 5px 25px rgba(0,0,0,0.1);
				padding: 40px;
				max-width: 1000px;
				width: 100%;
				display: flex;
				flex-wrap: wrap;
				justify-content: space-between;
				align-items: center;
				animation: fadeIn 1s ease-in-out;
			}

			@keyframes fadeIn {
				from {opacity: 0; transform: translateY(20px);}
				to {opacity: 1; transform: translateY(0);}
			}

			.inicio-info {
				flex: 1 1 50%;
				padding: 20px;
			}

			.inicio-info h1 {
				font-size: 3rem;
				color: #28a745;
				font-weight: 700;
				margin-bottom: 15px;
			}

			.inicio-info h3 {
				color: #555;
				line-height: 1.6;
				font-weight: 400;
			}

			.inicio-info hr {
				border-top: 2px solid #28a745;
				width: 60px;
				margin: 20px 0;
			}

			.inicio-info h2 {
				color: #2e7d32;
				margin-top: 25px;
				font-weight: 600;
			}

			.inicio-imagen {
				flex: 1 1 40%;
				text-align: center;
			}

			.inicio-imagen img {
				max-width: 100%;
				border-radius: 15px;
				box-shadow: 0 4px 20px rgba(0,0,0,0.15);
				transition: transform 0.3s;
			}

			.inicio-imagen img:hover {
				transform: scale(1.05);
			}

			.contacto-item {
				margin-bottom: 10px;
			}

			.contacto-item i {
				color: #28a745;
				margin-right: 10px;
			}

			@media (max-width: 768px) {
				.inicio-card {
					flex-direction: column;
					text-align: center;
				}
				.inicio-info, .inicio-imagen {
					flex: 1 1 100%;
				}
				.inicio-info hr {
					margin: 15px auto;
				}
			}
		</style>

		<div class="inicio-container">
			<div class="inicio-card">

				<div class="inicio-info">
					<h1><i class="fa fa-hospital-o"></i> Bienvenidos</h1>
					<h3>'.$resultado["intro"].'</h3>

					<hr>

					<h2><i class="fa fa-clock-o"></i> Horario</h2>
					<h4>Desde: <strong>'.$resultado["horaE"].'</strong></h4>
					<h4>Hasta: <strong>'.$resultado["horaS"].'</strong></h4>

					<hr>

					<h2><i class="fa fa-map-marker"></i> Dirección</h2>
					<h4>'.$resultado["direccion"].'</h4>

					<hr>

					<h2><i class="fa fa-phone"></i> Contactos</h2>
					<div class="contacto-item"><i class="fa fa-phone-square"></i> Teléfono: '.$resultado["telefono"].'</div>
					<div class="contacto-item"><i class="fa fa-envelope"></i> Correo: '.$resultado["correo"].'</div>
				</div>

				<div class="inicio-imagen">
					<img src="'.$resultado["logo"].'" alt="Logo Clínica">
				</div>

			</div>
		</div>
		';
	}


	//Editar Perfil
	public function EditarInicioC(){

		$tablaBD = "inicio";

		$id = "1";

		$resultado = InicioM::MostrarInicioM($tablaBD, $id);

		echo '<form method="post" enctype="multipart/form-data">
					
				<div class="row">
					
					<div class="col-md-6 col-xs-12">
						
						<h2>Introducción:</h2>
						<input type="text" class="input-lg" name="intro" value="'.$resultado["intro"].'">
						<input type="hidden" class="input-lg" name="Iid" value="'.$resultado["id"].'">

						<div class=form-group>
							<h2>Horario:</h2>
							Desde:<input type="time" class="input-lg" name="horaE" value="'.$resultado["horaE"].'">
							Hasta:<input type="time" class="input-lg" name="horaS" value="'.$resultado["horaS"].'">

						</div>

						<h2>Dirección:</h2>
						<input type="text" class="input-lg" name="direccion" value="'.$resultado["direccion"].'">

						<h2>Teléfono:</h2>
						<input type="text" class="input-lg" name="telefono" value="'.$resultado["telefono"].'">

						<h2>Correo:</h2>
						<input type="text" class="input-lg" name="correo" value="'.$resultado["correo"].'">

					</div>

					<div class="col-md-6 col-xs-12">
						
						<br><br>

						<h2>Logo:</h2>
						<input type="file" name="logo">
						<br>

						<img src="http://localhost/clinica/'.$resultado["logo"].'" width="200px;">


						<input type="hidden" name="logoActual" value="'.$resultado["logo"].'">

						<br><br>


						<h2>Favicon:</h2>
						<input type="file" name="favicon">
						<br>

						<img src="http://localhost/clinica/'.$resultado["favicon"].'" width="200px;">


						<input type="hidden" name="faviconActual" value="'.$resultado["favicon"].'">

						<br><br>

						<button type="submit" class="btn btn-success">Guardar Cambios</button>

					</div>

				</div>

			</form>';

	}



	public function ActualizarInicioC(){

			if(isset($_POST["Iid"])){

				$rutaLogo = $_POST["logoActual"];

				if(isset($_FILES["logo"]["tmp_name"]) && !empty($_FILES["logo"]["tmp_name"])){

					
					if(!empty($_POST["logoActual"])){

						unlink($_POST["logoActual"]);

					}

					if($_FILES["logo"]["type"] == "image/jpeg"){

						$rutaLogo = "Vistas/img/logo.jpeg";

						$logo = imagecreatefromjpeg($_FILES["logo"]["tmp_name"]);
						
						imagejpeg($logo, $rutaLogo);

					}

					if($_FILES["logo"]["type"] == "image/png"){

						$rutaLogo = "Vistas/img/logo.png";

						$logo = imagecreatefrompng($_FILES["logo"]["tmp_name"]);
						
						imagepng($logo, $rutaLogo);

					}

				}



				$rutaFavicon = $_POST["faviconActual"];

				if(isset($_FILES["favicon"]["tmp_name"]) && !empty($_FILES["favicon"]["tmp_name"])){

					if(!empty($_POST["faviconActual"])){

						unlink($_POST["faviconActual"]);

					}

					if($_FILES["favicon"]["type"] == "image/jpeg"){

						$rutaFavicon = "Vistas/img/favicon.jpeg";

						$favicon = imagecreatefromjpeg($_FILES["favicon"]["tmp_name"]);
						
						imagejpeg($favicon, $rutaFavicon);

					}

					if($_FILES["favicon"]["type"] == "image/png"){

						$rutaFavicon = "Vistas/img/favicon.png";

						$favicon = imagecreatefrompng($_FILES["favicon"]["tmp_name"]);
						
						imagepng($favicon, $rutaFavicon);

					}

				}


				$tablaBD = "inicio";

				$datosC = array("id"=>$_POST["Iid"], "intro"=>$_POST["intro"], "horaE"=>$_POST["horaE"], "horaS"=>$_POST["horaS"], "telefono"=>$_POST["telefono"], "correo"=>$_POST["correo"], "direccion"=>$_POST["direccion"], "logo"=>$rutaLogo, "favicon"=>$rutaFavicon);

				$resultado = InicioM::ActualizarInicioM($tablaBD, $datosC);

				if($resultado == true){

					echo '<script>

					window.location = "inicio-editar";
					</script>';

				}


		}


	}



	public function FaviconC(){

			$tablaBD = "inicio";

			$id = "1";

			$resultado = InicioM::MostrarInicioM($tablaBD, $id);

			echo '<link rel="icon" type="" href="'.$resultado["favicon"].'">';

	}


}
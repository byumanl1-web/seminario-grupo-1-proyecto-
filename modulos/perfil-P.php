<?php

if($_SESSION["rol"] != "Paciente"){

	echo '<script>
	window.location = "inicio";
	</script>';

	return;
}

?>

<div class="content-wrapper">

	<section class="content">
		
		<div class="box">
			
			<div class="box-body">

				<?php

				$editarPerfil = new PacientesC();
				$editarPerfil -> EditarPerfilPacienteC();  // ✅ Muestra el formulario
				$editarPerfil -> ActualizarPerfilPacienteC(); // ✅ Procesa el update si se envió el formulario

				?>
				
			</div>

		</div>

	</section>

</div>

<div class="content-wrapper">

	<section class="content-header text-center">
		<h1 style="font-weight:700; color:#28a745; margin-bottom:20px;">
			<i class="fa fa-users"></i> Gestor de Pacientes
		</h1>
    <script>
document.addEventListener("DOMContentLoaded", function() {
  // Cuando se hace clic en el botón de editar
  document.querySelectorAll(".EditarPaciente").forEach(function(boton) {
    boton.addEventListener("click", function() {
      const idPaciente = this.getAttribute("Pid");

      // Petición AJAX al servidor para obtener los datos del paciente
      const datos = new FormData();
      datos.append("Pid", idPaciente);

      fetch("Ajax/pacientesA.php", {
        method: "POST",
        body: datos
      })
      .then(response => response.json())
      .then(data => {
        // Asignar los valores al formulario del modal
        document.querySelector("#Pid").value = data.id;
        document.querySelector("#apellidoE").value = data.apellido;
        document.querySelector("#nombreE").value = data.nombre;
        document.querySelector("#documentoE").value = data.documento;
        document.querySelector("#usuarioE").value = data.usuario;
        document.querySelector("#claveE").value = data.clave;
        document.querySelector("#alergiasE").value = data.alergias;
        document.querySelector("#enfermedadesE").value = data.enfermedades;
        document.querySelector("#cirugiasE").value = data.cirugias;
        document.querySelector("#vacunasE").value = data.vacunas;
        document.querySelector("#medicamentosE").value = data.medicamentos;
        document.querySelector("#habitosE").value = data.habitos;
        document.querySelector("#antecedentes_familiaresE").value = data.antecedentes_familiares;
      })
      .catch(error => console.error("Error al obtener los datos:", error));
    });
  });
});
</script>
	</section>

	<section class="content">
		<div class="box" style="border:none; box-shadow:0 5px 25px rgba(0,0,0,0.1); border-radius:12px; overflow:hidden;">
			
			<div class="box-header text-center" style="background:linear-gradient(135deg,#4CAF50,#66BB6A); padding:25px;">
				<button class="btn btn-light btn-lg" data-toggle="modal" data-target="#CrearPaciente" 
					style="border-radius:30px; font-weight:600;">
					<i class="fa fa-user-plus"></i> Crear Paciente
				</button>
			</div>

			<div class="box-body" style="padding:30px;">
				<table class="table table-hover table-striped table-bordered DT" 
					style="background:white; border-radius:10px; overflow:hidden;">
					
					<thead style="background:#28a745; color:white; text-align:center;">
						<tr>
							<th>#</th>
							<th>Foto</th>
							<th>Nombre Completo</th>
							<th>Documento</th>
							<th>Usuario</th>
							<th>Datos Médicos</th>
							<th>Acciones</th>
						</tr>
					</thead>

					<tbody>
						<?php
						$columna = null;
						$valor = null;
						$resultado = PacientesC::VerPacientesC($columna, $valor);

						foreach ($resultado as $key => $value) {

							$foto = ($value["foto"] != "") ? $value["foto"] : "Vistas/img/defecto.png";

							echo '
							<tr>
								<td style="text-align:center;">'.($key+1).'</td>
								<td style="text-align:center;"><img src="'.$foto.'" class="img-circle" width="50"></td>
								<td><strong>'.$value["apellido"].', '.$value["nombre"].'</strong></td>
								<td>'.$value["documento"].'</td>
								<td>
									<i class="fa fa-user"></i> '.$value["usuario"].'<br>
									<i class="fa fa-key"></i> '.$value["clave"].'
								</td>

								<td>
									<small>
										<strong>Alergias:</strong> '.$value["alergias"].'<br>
										<strong>Enfermedades:</strong> '.$value["enfermedades"].'<br>
										<strong>Cirugías:</strong> '.$value["cirugias"].'<br>
										<strong>Vacunas:</strong> '.$value["vacunas"].'
									</small>
								</td>


                

								<td style="text-align:center;">
									<div class="btn-group">
										<button class="btn btn-success EditarPaciente" 
											Pid="'.$value["id"].'" 
											data-toggle="modal" 
											data-target="#EditarPaciente">
											<i class="fa fa-pencil"></i>
										</button>

										<button class="btn btn-danger EliminarPaciente" 
											Pid="'.$value["id"].'" 
											imgP="'.$value["foto"].'">
											<i class="fa fa-trash"></i>
										</button>
									</div>
								</td>
							</tr>';
              
						}
            
						?>
            <script>
  document.addEventListener("DOMContentLoaded", function() {
    const botonesEliminar = document.querySelectorAll(".EliminarPaciente");

    botonesEliminar.forEach(function(boton) {
      boton.addEventListener("click", function(e) {
        e.preventDefault(); // evita que se ejecute la acción inmediatamente

        const confirmar = confirm("¿Estás seguro de eliminar el paciente?");

        if(confirmar) {
          const Pid = this.getAttribute("Pid");
          const imgP = this.getAttribute("imgP");
          // Redirige a tu controlador PHP para borrar el paciente
          window.location = "index.php?pagina=pacientes&Pid=" + Pid + "&imgP=" + imgP;
        }
      });
    });
  });
</script>
					</tbody>
          
				</table>
			</div>
		</div>
	</section>
</div>

<style>
	.table th, .table td {
		vertical-align: middle !important;
	}
	.btn-success i, .btn-danger i {
		font-size: 16px;
	}
	.DT thead th {
		font-size: 15px;
	}
</style>
<!-- ================= MODAL CREAR PACIENTE ================= -->
<div class="modal fade" id="CrearPaciente" tabindex="-1" aria-labelledby="CrearPacienteLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="CrearPacienteLabel"><i class="bi bi-person-plus-fill"></i> Nuevo Paciente</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <div class="modal-body">
          <!-- Datos Personales -->
          <div class="card mb-3 shadow-sm">
            <div class="card-header bg-light">
              <strong>🧍 Datos Personales</strong>
            </div>
            <div class="card-body">
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="apellido" class="form-label">Apellido</label>
                  <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ej: Pérez" required>
                  <input type="hidden" name="rolP" value="Paciente">
                </div>
                <div class="col-md-6">
                  <label for="nombre" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Juan" required>
                </div>
              </div>

              <div class="row g-3 mt-2">
                <div class="col-md-6">
                  <label for="documento" class="form-label">Documento</label>
                  <input type="text" class="form-control" id="documento" name="documento" placeholder="DNI o Pasaporte" required>
                </div>
                <div class="col-md-6">
                  <label for="usuario" class="form-label">Usuario</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de usuario" required>
                </div>
              </div>

              <div class="row g-3 mt-2">
                <div class="col-md-6">
                  <label for="clave" class="form-label">Contraseña</label>
                  <input type="password" class="form-control" id="clave" name="clave" placeholder="Ingrese contraseña" required>
                </div>
                <div class="col-md-6">
                  <label for="foto" class="form-label">Foto del Paciente</label>
                  <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                </div>
              </div>
            </div>
          </div>

          <!-- Antecedentes Médicos -->
          <div class="card mb-3 shadow-sm">
            <div class="card-header bg-light">
              <strong>🩺 Antecedentes Médicos</strong>
            </div>
            <div class="card-body">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Alergias</label>
                  <textarea class="form-control" name="alergias" rows="2" placeholder="Ej: Penicilina"></textarea>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Enfermedades</label>
                  <textarea class="form-control" name="enfermedades" rows="2" placeholder="Ej: Diabetes"></textarea>
                </div>
              </div>

              <div class="row g-3 mt-2">
                <div class="col-md-6">
                  <label class="form-label">Cirugías</label>
                  <textarea class="form-control" name="cirugias" rows="2" placeholder="Ej: Apéndice 2019"></textarea>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Vacunas</label>
                  <textarea class="form-control" name="vacunas" rows="2" placeholder="Ej: COVID-19, Influenza"></textarea>
                </div>
              </div>

              <div class="row g-3 mt-2">
                <div class="col-md-6">
                  <label class="form-label">Medicamentos Actuales</label>
                  <textarea class="form-control" name="medicamentos" rows="2" placeholder="Ej: Ibuprofeno"></textarea>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Hábitos de Salud</label>
                  <textarea class="form-control" name="habitos" rows="2" placeholder="Ej: Ejercicio regular"></textarea>
                </div>
              </div>

              <div class="mt-3">
                <label class="form-label">Antecedentes Familiares</label>
                <textarea class="form-control" name="antecedentes_familiares" rows="3" placeholder="Ej: Hipertensión en la familia"></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Guardar Paciente</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cancelar</button>
        </div>

        <?php
          $crear = new PacientesC();
          $crear -> CrearPacienteC();
        ?>
      </form>
    </div>
  </div>
</div>


<!-- ================= MODAL EDITAR PACIENTE ================= -->
<div class="modal fade" role="dialog" id="EditarPaciente">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg rounded-3">
      <form method="post" role="form">
        
        <!-- Encabezado -->
        <div class="modal-header bg-success text-white">
          <h4 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Editar Paciente</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <!-- Cuerpo del modal -->
        <div class="modal-body bg-light">
          <div class="container-fluid">

            <!-- Sección: Datos Personales -->
            <div class="card mb-4 shadow-sm">
              <div class="card-header bg-success bg-opacity-10 text-success fw-semibold">
                🧍 Datos Personales
              </div>
              <div class="card-body">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Apellido:</label>
                    <input type="text" class="form-control" id="apellidoE" name="apellidoE" required>
                    <input type="hidden" id="Pid" name="Pid">
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombreE" name="nombreE" required>
                  </div>
                </div>

                <div class="row g-3 mt-2">
                  <div class="col-md-6">
                    <label class="form-label">Documento:</label>
                    <input type="text" class="form-control" id="documentoE" name="documentoE" required>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Usuario:</label>
                    <input type="text" class="form-control" id="usuarioE" name="usuarioE" required>
                  </div>
                </div>

                <div class="mt-3">
                  <label class="form-label">Contraseña:</label>
                  <input type="password" class="form-control" id="claveE" name="claveE" required>
                </div>
              </div>
            </div>

            <!-- Sección: Antecedentes Médicos -->
            <div class="card shadow-sm">
              <div class="card-header bg-success bg-opacity-10 text-success fw-semibold">
                🩺 Antecedentes Médicos
              </div>
              <div class="card-body">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Alergias:</label>
                    <input type="text" class="form-control" id="alergiasE" name="alergiasE" required>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Enfermedades:</label>
                    <input type="text" class="form-control" id="enfermedadesE" name="enfermedadesE" required>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Cirugías:</label>
                    <input type="text" class="form-control" id="cirugiasE" name="cirugiasE" required>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Vacunas:</label>
                    <input type="text" class="form-control" id="vacunasE" name="vacunasE" required>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Medicamentos:</label>
                    <input type="text" class="form-control" id="medicamentosE" name="medicamentosE" required>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Hábitos:</label>
                    <input type="text" class="form-control" id="habitosE" name="habitosE" required>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Antecedentes Familiares:</label>
                    <input type="text" class="form-control" id="antecedentes_familiaresE" name="antecedentes_familiaresE" required>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer bg-white">
          <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Guardar Cambios</button>
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cancelar</button>
        </div>

        <?php
          $actualizar = new PacientesC();
          $actualizar -> ActualizarPacienteC();
        ?>
      </form>
    </div>
  </div>
</div>

<?php
  $borrarP = new PacientesC();
  $borrarP -> BorrarPacienteC();
?>

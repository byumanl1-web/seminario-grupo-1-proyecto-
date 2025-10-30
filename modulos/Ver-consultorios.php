<?php
if($_SESSION["rol"] != "Paciente"){
    echo '<script>window.location = "inicio";</script>';
    return;
}
?>

<div class="content-wrapper">
    
    <section class="content-header">
        <h1 class="text-center">Elija un consultorio:</h1>
        <hr>
    </section>

    <section class="content">
        <div class="row">

            <?php
            $columna = null;
            $valor = null;
            $resultado = ConsultoriosC::VerConsultoriosC($columna, $valor);

            $colors = ["#1abc9c", "#3498db", "#e67e22", "#9b59b6", "#e74c3c"];

            foreach ($resultado as $key => $consultorio) {
                $color = $colors[$key % count($colors)];

                echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4">
                        <div class="small-box" style="background-color:'.$color.'; color:white; border-radius:10px;">
                            <div class="inner text-center p-3">
                                <h3>'.$consultorio["nombre"].'</h3>
                                <p>Doctores disponibles:</p>';

                $columna = "id_consultorio";
                $valor = $consultorio["id"];
                $doctores = DoctoresC::VerDoctoresC($columna, $valor);

                if ($doctores) {
                    echo '<div class="d-flex flex-wrap justify-content-center">';
                    foreach ($doctores as $doc) {
                        echo '<a href="Doctor/'.$doc["id"].'" class="doctor-link">
                                <span class="badge badge-light m-1">'.$doc["apellido"].' '.$doc["nombre"].'</span>
                              </a>';
                    }
                    echo '</div>';
                } else {
                    echo '<p><em>No hay doctores disponibles</em></p>';
                }

                echo '      </div>
                        </div>
                    </div>';
            }
            ?>

        </div>
    </section>
</div>

<style>
/* Estilo general de los badges de doctores */
.doctor-link {
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s, background-color 0.2s;
    display: inline-block;
}

.doctor-link:hover .badge {
    transform: scale(1.1);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    background-color: rgba(255,255,255,0.9);
}

.badge {
    font-size: 0.85em;
    padding: 0.5em 0.7em;
    border-radius: 12px;
    color: #333;
    background-color: rgba(255,255,255,0.7);
    font-weight: bold;
}
</style>

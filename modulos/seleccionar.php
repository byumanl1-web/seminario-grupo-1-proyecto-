<section class="content" style="min-height: 100vh; display: flex; position: relative;">
  <!-- Carrusel de imágenes en el fondo -->
  <div id="carouselImages" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; z-index: 1;">
    <img src="Vistas/img/a.jpg" style="width: 100%; height: auto;">
    <img src="Vistas/img/b.jpg" style="width: 100%; height: auto;">
    <img src="Vistas/img/c.jpg" style="width: 100%; height: auto;">
  </div>

  <div style="flex: 1; background-color: rgba(0, 0, 128, 0.7); display: flex; flex-direction: column; justify-content: center; align-items: center; z-index: 2; padding: 20px;">
        <h1 style="color: white; margin: 0; text-align: center; max-width: 80%;">Bienvenido a DT, por favor selecciona tu rol</h1>
  </div>

  <div style="flex: 1; background-color: white; display: flex; justify-content: center; align-items: center; z-index: 2; padding: 20px;">
    <div style="text-align: center; max-width: 80%;">
      <h2>Selecciona tu rol</h2>
      <div class="row" style="flex-direction: column; align-items: center;">
        <div class="col-lg-12">
          <div class="small-box" style="background-color: rgba(0, 123, 255, 0.7); color: white; margin: 10px;">
            <div class="inner">
              <h3>Secretaria</h3>
              <p>Inicie Sesión</p>
            </div>
            <div class="icon">
              <i class="fa fa-female"></i>
            </div>
            <a href="ingreso-Secretaria" class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="small-box" style="background-color: #28a745; color: white; margin: 10px;">
            <div class="inner">
              <h3>Doctor</h3>
              <p>Inicie Sesión</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-md"></i>
            </div>
            <a href="ingreso-Doctor" class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="small-box" style="background-color: #6f42c1; color: white; margin: 10px;">
            <div class="inner">
              <h3>Paciente</h3>
              <p>Inicie Sesión</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="ingreso-Paciente" class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="small-box" style="background-color: #dc3545; color: white; margin: 10px;">
            <div class="inner">
              <h3>Administrador</h3>
              <p>Inicie Sesión</p>
            </div>
            <div class="icon">
              <i class="fa fa-male"></i>
            </div>
            <a href="ingreso-Administrador" class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  let currentIndex = 0;
  const images = document.querySelectorAll('#carouselImages img');
  const totalImages = images.length;

  function showNextImage() {
    images[currentIndex].style.display = 'none'; // Oculta la imagen actual
    currentIndex = (currentIndex + 1) % totalImages; // Cambia al siguiente índice
    images[currentIndex].style.display = 'block'; // Muestra la nueva imagen
  }

  // Inicializa el carrusel
  images.forEach((img, index) => {
    img.style.display = index === 0 ? 'block' : 'none'; // Muestra solo la primera imagen
  });

  setInterval(showNextImage, 3000); // Cambia la imagen cada 3 segundos
</script>

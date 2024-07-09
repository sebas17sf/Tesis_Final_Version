document.addEventListener('DOMContentLoaded', function () {
  console.log("DOMContentLoaded - ActivarMenu called");
  // Establecer el estado inicial como 'collapsed' si no existe en localStorage
  if (!localStorage.getItem('sidebar')) {
      localStorage.setItem('sidebar', 'collapsed');
  }

  // Aplicar el estado del sidebar del almacenamiento local
  activarMenu();
});

function activarMenu() {
  var sidebarEstado = localStorage.getItem('sidebar');

  console.log("Activar menú llamado");
  console.log("Estado del sidebar:", sidebarEstado);

  aplicarEstadoSidebar(sidebarEstado, true);
}

function aplicarEstadoSidebar(estado, sinTransicion = false) {
  var contentSidebar = document.querySelector('.content-sidebar');
  var contentNavbar = document.querySelector('.content-navbar');
  var contentViews = document.querySelector('.content-views');
  var viewsActive = document.querySelector('.views');

  if (sinTransicion) {
      contentSidebar.style.transition = 'none';
      contentNavbar.style.transition = 'none';
      contentViews.style.transition = 'none';
      viewsActive.style.transition = 'none';
  }

  if (estado === 'collapsed') {
      contentSidebar.classList.add('content-sidebar-hidden');
      contentNavbar.classList.add('dimension-nav-hidden');
      viewsActive.classList.add('views-active');
      contentViews.classList.add('dimension-content-hidden');
  } else {
      contentSidebar.classList.remove('content-sidebar-hidden');
      contentNavbar.classList.remove('dimension-nav-hidden');
      viewsActive.classList.remove('views-active');
      contentViews.classList.remove('dimension-content-hidden');
  }

  if (sinTransicion) {
      // Forzar el reflujo para aplicar el cambio de estilo inmediatamente
      contentSidebar.offsetHeight;
      contentNavbar.offsetHeight;
      contentViews.offsetHeight;
      viewsActive.offsetHeight;

      // Restaurar las transiciones
      setTimeout(() => {
          contentSidebar.style.transition = '';
          contentNavbar.style.transition = '';
          contentViews.style.transition = '';
          viewsActive.style.transition = '';
      }, 0);
  }

  var menuIcono = document.querySelector('.menu-icono');
  if (contentSidebar.classList.contains('content-sidebar-hidden')) {
      menuIcono.classList.remove('bx-menu-alt-left');
      menuIcono.classList.add('bx-menu');
  } else {
      menuIcono.classList.remove('bx-menu');
      menuIcono.classList.add('bx-menu-alt-left');
  }
}

function triggerToggleSidebar() {
  var contentSidebar = document.querySelector('.content-sidebar');
  var sidebarEstado = contentSidebar.classList.contains('content-sidebar-hidden') ? 'expanded' : 'collapsed';
  
  // Guardar el nuevo estado en el almacenamiento local
  localStorage.setItem('sidebar', sidebarEstado);

  console.log("Toggling sidebar. New state:", sidebarEstado);

  aplicarEstadoSidebar(sidebarEstado);
}



  var elementosTitleContent = document.querySelectorAll('.title-content');
  var elementosHydrated = document.querySelectorAll('.hydrated');
  elementosHydrated[0].setAttribute('style', `--title-length:${elementosTitleContent[0].textContent.length};`)

  // Selecciona todos los elementos con la clase p-element
  var pElements = $('.p-element');
  var submenu = $('.submenu');
  var sublista = $('.sublista');
  var segmentoRuta = window.location.pathname.split('/').pop();

  $('.p-element').on('click', function () {
    $('.p-element').removeClass('active-section');
    $(this).addClass('active-section');
  });

  pElements.each(function (i, element) {
    var hrefValor = $(element).attr('href');
    var segmentoElementoMenu = null;
    if (hrefValor != null) {
      segmentoElementoMenu = hrefValor.split('/').pop();
    }
    if (segmentoElementoMenu === segmentoRuta) {
      $(element).addClass('active-section');
      if ($(element).hasClass('subitem')) {
        submenu.addClass('active-section');
        sublista.addClass('show');
      }
    } else {
      $(element).removeClass('active-section');
    }
  });

  $('.submenu').on('click', function () {
    $(this).next('.sublista').toggleClass('show');
  });

  $('.sublista .p-element').on('click', function () {
    $('.sublista .p-element').removeClass('active-section');
    $(this).addClass('active-section');
  });
  // Obtén una referencia al botón profile-icon y al menú emergente popup-menu-profile
  var profileButton = document.getElementById('profile-button');
  var popupMenu = document.querySelector('.popup-menu-profile');
  // Agrega un controlador de eventos de clic al botón profile-icon
  profileButton.addEventListener('click', function (event) {
    // Evita que el clic en el botón cierre el menú
    event.stopPropagation();
    // Verifica si el menú emergente está visible
    var isVisible = popupMenu.style.display === 'block';
    // Cambia la visibilidad del menú emergente
    if (isVisible) {
      popupMenu.style.display = 'none'; // Oculta el menú emergente si está visible
    } else {
      popupMenu.style.display = 'block'; // Muestra el menú emergente si está oculto
    }
  });


  // Agrega un controlador de eventos de clic al documento entero
  document.addEventListener('click', function (event) {
    // Si el clic se realizó fuera del menú emergente, ciérralo
    if (!popupMenu.contains(event.target) && event.target !== profileButton) {
      popupMenu.style.display = 'none';
    }
  });


  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })

  var contentSidebar = document.querySelector('.content-sidebar');

  if (contentSidebar.classList.contains('content-sidebar-hidden')) {
    var tooltipTriggers = document.querySelectorAll('.p-element');
    tooltipTriggers.forEach(function (tooltipTrigger) {
      new bootstrap.Tooltip(tooltipTrigger);
    });
  }

  window.addEventListener('scroll', function () {
    var boton = document.getElementById('btn_top');
    var contenido = document.querySelector('.content');

    // Calcula la distancia entre el final del contenido y el tope del viewport
    var distanciaAlFinal = contenido.getBoundingClientRect().bottom - window.innerHeight;

    // Si el scroll alcanza el final de la página, agrega la clase 'visible' al botón
    if (window.scrollY >= distanciaAlFinal) {
      boton.classList.add('visible');
    } else {
      boton.classList.remove('visible');
    }

    // Si el scroll vuelve hacia arriba, oculta el botón nuevamente
    if (window.scrollY === 0) {
      boton.classList.remove('visible');
    }
  });


  // Obtener referencia al botón
  var boton = document.getElementById('btn_top');

  // Agregar un evento de clic al botón
  boton.addEventListener('click', function () {
    // Hacer que la página se desplace hacia arriba
    window.scrollTo({
      top: 0,
      behavior: 'smooth' // para un desplazamiento suave
    });
  });





  document.addEventListener('DOMContentLoaded', function () {
    console.log("DOMContentLoaded - ActivarMenu called"); // Depuración
    activarMenu();
});

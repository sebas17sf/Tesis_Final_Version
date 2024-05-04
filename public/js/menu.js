/*  document.addEventListener('DOMContentLoaded', function() {
  const profileButton = document.getElementById('profile-button');
  const popupMenuContainer = document.getElementById('popup-menu-container');

  profileButton.addEventListener('click', function() {
    popupMenuContainer.classList.toggle('active');
  });

  document.addEventListener('click', function(event) {
    if (!popupMenuContainer.contains(event.target) && !profileButton.contains(event.target)) {
      popupMenuContainer.classList.remove('active');
    }
  });
});
  */


function triggerToggleSidebar() {
  var contentSidebar = document.querySelector('.content-sidebar');

  // Si la clase dimension-nav-hidden está presente en contentSidebar, la elimina; de lo contrario, la añade
  if (contentSidebar.classList.contains('content-sidebar-hidden')) {
    contentSidebar.classList.remove('content-sidebar-hidden');

  } else {
    contentSidebar.classList.add('content-sidebar-hidden');
  }


  var contentNavbar = document.querySelector('.content-navbar');

  contentNavbar.classList.add('dimension-nav');
  // Si la clase dimension-nav-hidden está presente en contentNavbar, la elimina; de lo contrario, la añade
  if (contentNavbar.classList.contains('dimension-nav-hidden')) {
    contentNavbar.classList.remove('dimension-nav-hidden');
  } else {
    contentNavbar.classList.add('dimension-nav-hidden');
  }

  var contentViews = document.querySelector('.content-views');
  contentViews.classList.add('dimension-content');
  // Si la clase dimension-nav-hidden está presente en contentNavbar, la elimina; de lo contrario, la añade
  if (contentViews.classList.contains('dimension-content-hidden')) {
    contentViews.classList.remove('dimension-content-hidden');
  } else {
    contentViews.classList.add('dimension-content-hidden');
  }


  var viewsActive = document.querySelector('.views');

  // Si la clase dimension-nav-hidden está presente en contentNavbar, la elimina; de lo contrario, la añade
  if (viewsActive.classList.contains('views-active')) {
    viewsActive.classList.remove('views-active');
  } else {
    viewsActive.classList.add('views-active');
  }

}


document.addEventListener('DOMContentLoaded', function () {

  $("#sublista").hide();
  // Selecciona todos los elementos con la clase p-element
  var pElements = document.querySelectorAll('.p-element');

  // Añade un evento de clic a cada elemento
  pElements.forEach(function (element) {
    element.addEventListener('click', function () {
      // Elimina la clase active-section de todos los elementos
      pElements.forEach(function (item) {
        item.classList.remove('active-section');
      });

      // Añade la clase active-section al elemento clicado
      this.classList.add('active-section');
    });
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


  /* var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  }) */

  var contentSidebar = document.querySelector('.content-sidebar');

  if (contentSidebar.classList.contains('content-sidebar-hidden')) {
    var tooltipTriggers = document.querySelectorAll('.p-element');
    tooltipTriggers.forEach(function (tooltipTrigger) {
      new bootstrap.Tooltip(tooltipTrigger);
    });
  }

  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })


  var submenus = document.querySelectorAll('.submenu');

  submenus.forEach(function (submenu) {
    submenu.addEventListener('click', function () {
      // Quita la clase item-list-active-section de todos los elementos .nav-item
      var navItems = document.querySelectorAll('.p-element');
      navItems.forEach(function (navItem) {
        navItem.classList.remove('item-list-active-section');
      });

      // Agrega la clase item-list-active-section solo al elemento padre más cercano de .submenu
      var closestNavItem = this.closest('.submenu');
      closestNavItem.classList.add('item-list-active-section');
    });
  });



  var submenu = document.querySelector('.submenu');


  submenu.addEventListener('click', function () {

    if (submenu.classList.contains('item-list-active-section')) {
      $("#sublista").show();
    }


  });

  var submenu = document.querySelector('.submenu');

  submenu.addEventListener('mouseover', function () {
    console.log('Hola');
    $("#sublista").show();
  });



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

});


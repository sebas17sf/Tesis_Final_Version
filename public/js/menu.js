/* document.addEventListener('DOMContentLoaded', function () {

  activarMenu();
}); */

function triggerToggleSidebar() {
  var contentSidebar = document.querySelector('.content-sidebar');


  var elementosAutores = document.querySelectorAll('.content-autors');


  // Si la clase dimension-nav-hidden está presente en contentSidebar, la elimina; de lo contrario, la añade
  if (contentSidebar.classList.contains('content-sidebar-hidden')) {
    contentSidebar.classList.remove('content-sidebar-hidden');
    elementosAutores[0].setAttribute('style', `opacity: 1;`)
    localStorage.setItem('sidebar', false);

  } else {
    contentSidebar.classList.add('content-sidebar-hidden');
    elementosAutores[0].removeAttribute('style');
    localStorage.setItem('sidebar', true);
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


  //agregar linea de los titulos
  var elementosTitleContent = document.querySelectorAll('.title-content');
  var elementosHydrated = document.querySelectorAll('.hydrated');
  elementosHydrated[0].setAttribute('style', `--title-length:${elementosTitleContent[0].textContent.length};`)

  $("#sublista").hide();
  // Selecciona todos los elementos con la clase p-element
  var pElements = document.querySelectorAll('.p-element');
  var segmentoRuta = window.location.pathname.split('/').pop();



  pElements.forEach(function (element, i) {
    element.addEventListener('click', function () {

      pElements.forEach(function (item) {
        item.classList.remove('active-section');
      });
      this.classList.add('active-section');
    });


    var hrefValor = element.getAttribute('href');
    var segmentoElementoMenu = null;

    if (hrefValor != null) {
      segmentoElementoMenu = hrefValor.split('/').pop()
    }


    if (segmentoElementoMenu === segmentoRuta) {
      pElements[i].classList.add('active-section');

    } else {
      pElements[i].classList.remove('active-section');
    }
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

  var submenus = document.querySelectorAll('.submenu');
  var itemList = document.getElementById('sublista');
  submenus.forEach(function (submenu) {
    submenu.addEventListener('mouseover', function () {

      if (itemList.classList.contains('show')) {
        $("#sublista").hide();
        itemList.classList.remove('show');
        itemList.classList.add('hide');
      } else {
        $("#sublista").show();
        itemList.classList.remove('hide');
        itemList.classList.add('show');

      }


    });
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


function activarMenu() {

  //finde agregar linea de los titulos

  //verificar si el menu esta expandido o no
  var contentSidebar = document.querySelector('.content-sidebar');
  var contentNavbar = document.querySelector('.content-navbar');
  var contentViews = document.querySelector('.content-views');
  var viewsActive = document.querySelector('.views');
  var sidebarEstado = localStorage.getItem('sidebar');
  console.log(sidebarEstado);
  if (sidebarEstado == 'true') {
    contentSidebar.classList.add('content-sidebar-hidden');
    contentNavbar.classList.add('dimension-nav-hidden');
    viewsActive.classList.add('views-active');
    contentViews.classList.add('dimension-content-hidden');
  }

}

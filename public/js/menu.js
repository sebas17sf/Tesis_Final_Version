document.addEventListener('DOMContentLoaded', function() {
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

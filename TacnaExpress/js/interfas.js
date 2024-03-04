document.getElementById('image').addEventListener('load', () => {
  const imageWidth = document.getElementById('image').offsetWidth;

  const buttons = document.querySelectorAll('.btn');

  for (const button of buttons) {
    button.style.width = `${imageWidth * 0.5}px`;
  }
});

$(document).ready(function() {
  // Filter table rows based on search input
  $('#buscar').keyup(function() { // Agrega # antes del selector para seleccionar el campo de búsqueda por su ID
      var searchTerm = $(this).val().toLowerCase();
      $('.searchable').each(function() {
          var rowText = $(this).text().toLowerCase();
          if (rowText.indexOf(searchTerm) >= 0) {
              $(this).show();
          } else {
              $(this).hide();
          }
      });
  });

  // Select row on double click
  $('.searchable').dblclick(function() {
      $(this).toggleClass('selected');
  });
});
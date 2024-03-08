function mostrarSeleccion(idSelect) {
    const select = document.getElementById(idSelect);
    const opcionSeleccionada = select.options[select.selectedIndex].text;
    const parrafoOpcionSeleccionada = document.getElementById(`opcionSeleccionada${idSelect.slice(-1)}`);
    parrafoOpcionSeleccionada.textContent = `Opción seleccionada: ${opcionSeleccionada}`;
  }
fetch('../../php/administrador/informacion.php')
    .then(response => response.text())
    .then(data => {
        document.getElementById('infoAdmin').innerHTML = data;
    })
    .catch(error => console.error('Error al cargar la información del administrador:', error));

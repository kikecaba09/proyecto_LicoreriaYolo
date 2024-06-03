function cargarContenido(seccion) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("contenido-dinamico").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", seccion, true);
    xhttp.send();
}
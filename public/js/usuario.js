
/*
LEER LAS IMAGENES 
*/

function LeerImagen(Input, IdIamgen) {
    if (Input.files && Input.files[0]) {
        var Lectura = new FileReader();
        Lectura.onload = function(e) {
            $('#' + IdIamgen).attr('src', e.target.result);
        }
        Lectura.readAsDataURL(Input.files[0]);
   }
} 
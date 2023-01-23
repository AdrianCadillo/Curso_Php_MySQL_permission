
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

/// metodo para confirmar antes de eliminar un usuario

function ConfirmDelete(id,Name){
    Swal.fire({
        title: 'Desea eliminar al usuario '+Name+" ?",
        text: "Al eliminar al usuario, se eliminará sus roles asignados",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar'
      }).then((result) => {
        if (result.isConfirmed) {
           eliminar(id)
        }
      })
}

/// metodo para eliminar al usuario

function eliminar(id){
$.ajax({
"url":"/usuario/delete/"+id,
"type":"POST",
data:{accion:'delete'},
success:function(response){

    if(response == 1){
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Usuario eliminado',
            showConfirmButton: false,
            timer: 1500
          }).then(function(){
           location.href="/usuario";
          });
    }else{
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'error al eliminar usuario',
            showConfirmButton: false,
            timer: 1500
          }).then(function(){
           location.href="/usuario";
          });
    }
}
});
}


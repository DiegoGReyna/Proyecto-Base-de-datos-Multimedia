function comentariosNoticia(){
    var comentario = document.getElementById("TextAreaComentario").value;
    if(comentario != ''){
        window.alert('Comentario agregado');
        Swal.fire({
            icon: 'Actualización exitosa',
            title: 'Comentario agregado',
            text: 'El comentario a la noticia ha sido agregado',
          });
    }else{
        window.alert('Comentario no agregado');
        Swal.fire({
            icon: 'Error',
            title: 'Comentario no agregado',
            text: 'El comentario a la noticia no ha sido agregado',
          });
    }

}


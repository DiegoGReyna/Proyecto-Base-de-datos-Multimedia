function CheckDataCreateUserInfo(){
    let regexNombre= /^[a-zA-Z\s]*$/;
    let regExEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    let regExContra = /^(?=\w*[A-Z])(?=\w*[0-9])(?=\w*[_$&+,:;=?@#|'<>.^*()%!-?¿¡!])\S{8}$/;
    //Aqui se hará el getElementById()
    var name = document.getElementById("ID_Nombre").value;
    var email = document.getElementById("ID_Correo").value;
    var contra = document.getElementById("ID_Contra").value;
    var conContra = document.getElementById("ID_ContraConf").value;
    if(name != '' && email != '' && contra != '' && conContra != ''){
        if(regexNombre.test(name)){
            if(contra == conContra){
                if(contra.length >= 8){
                    if(regExContra.test(contra)){
                        if(regExEmail.test(email)){
                            return true;
                        }
                        else{
                            Swal.fire({
                                icon:'error',
                                title:'Correo no valido',
                                text:'No cumple con los campos necesarios para ser considerado un correo'
                            });
                        }
                    }
                    else{
                        Swal.fire({
                            icon:'error',
                            title:'Contraseña no valida',
                            text:'No cumple con los campos necesarios para ser considerada una contraseña'
                        });
                    }
                }
                else{
                    Swal.fire(
                        'Error',
                        'Contraseña no valida',
                        'No cumple con la longitud para ser considerada una contraseña'
                    );
                }
            }
            else{
                Swal.fire({
                    icon:'error',
                    title:'Contraseña no valida',
                    text:'Las contraseñas no coinciden'
                });
            }
        }else{
            Swal.fire({
                icon:'error',
                title:'Nombre no valido',
                text:'No imgrese letras en la seccion nombre'
            });

        }
    }
    else{
        Swal.fire({
            icon:'error',
            title:'Campos vacios',
            text:'No deje ningun campo sin completar'
        });
       
    }
    return false;
}

function CheckRepEditor(){
    
    let regexNombre= /^[a-zA-Z\s]*$/;
    let regExEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    //Aqui se hará el getElementById()
    var name = document.getElementById("ID_Nombre").value;
    var email = document.getElementById("ID_Correo").value;
    var puesto = document.getElementById("id_Puesto").value;
    console.log(puesto);
    if(name != '' && email != '' && puesto != ''){
        if(regexNombre.test(name)){
            if(puesto == '2' || puesto == '3'){
                if(regExEmail.test(email)){
                    return true;
                }
                else{
                    Swal.fire({
                        icon:'error',
                        title:'Correo no valido',
                        text:'No cumple con los campos necesarios para ser considerado un correo'
                    });
                }
            }     
            else{
                Swal.fire({
                    icon:'error',
                    title:'Puesto no valido',
                    text:'Favor de seleccionar un puesto'
                });
            }
        }
        else{
            Swal.fire({
                icon:'error',
                title:'Nombre no valido',
                text:'No imgrese letras en la seccion nombre'
            });

        }
    }
    else{
        Swal.fire({
            icon:'error',
            title:'Campos vacios',
            text:'No deje ningun campo sin completar'
        });
       
    }
    return false;
}

function UpdateUserInfo(){
    let regexNombre= /^[a-zA-Z\s]*$/;
    let regExEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    let regExContra = /^(?=\w*[A-Z])(?=\w*[0-9])(?=\w*[_$&+,:;=?@#|'<>.^*()%!-?¿¡!])\S{8}$/;
    var name = document.getElementById("ID_Nombre").value;
    var email = document.getElementById("ID_Correo").value;
    var contraBD = document.getElementById("ID_idUserCurrentPass").value;
    var oldContra = document.getElementById("ID_ContraActual").value;
    var contra = document.getElementById("ID_Contra").value;
    var conContra = document.getElementById("ID_ContraConf").value;

    if(contra != '' && conContra != '' && oldContra != ''){
        //Traer la contraseña de la BD y compararla
            if(oldContra == contraBD){
                if(contra == conContra ){
                    if(contra.length >= 8){
                        if(!regExContra.test(contra)){
                            Swal.fire({
                                icon: 'error',
                                title: 'Contraseña no valida',
                                text: 'la contraseña no cumple con el formato'                               
                            })
                        }
                        else {
                            return true;
                        }
                    }
                    else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Contraseña no valida',
                            text: 'la contraseña es muy corta'
                            
                        })
                    }
                }
                else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Contraseña no valida',
                        text: 'Las contraseñas no coinciden'
                    })
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Contraseña ',
                    text: 'La contraseña actual no corresponde a la del usuario'
                })
            }
        }
    if(name.length != 0 && email.length != 0){
        if(regexNombre.test(name)){
            if(regExEmail.test(email)){
                return true;
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Correo no valido',
                    text: 'formato del correo no es valido'
                })
            }    
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Nombre no valido',
                text: 'Ingrese solo letras en el nombre'
            })
        }
    }
    return false;
}

function Show_HidePass(){
    var button = document.getElementById("Id_Show_Hide");
    var div = document.getElementById("divContras");
    if(button.value == "Show Passwords"){
        button.value = "Hide Passwords";
        div.style.display="block";
    }
    else{
        button.value = "Show Passwords";
        div.style.display="none";
    }
}

function puestoChanged(){
    var puesto = document.getElementById("id_Select").value;
    document.getElementById("id_Puesto").setAttribute("value", puesto);
    console.log(puesto);
}

function setImage(event){
    var output = document.getElementById('id_displayImage');

    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
}
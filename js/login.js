function checkDataForLogin(){
    //Aqui se hará el getElementById()
    var email = document.getElementById("Id_CorreoElectronico").value;
    var contra = document.getElementById("Id_PassWord").value;
    
    if(email != 0 && contra != 0){
            if(contra.length < 8){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La contraseña es demasiado corta', 
                });
                return false;
            }
        }
}

function checkDataForLoginEditor(){
    //Aqui se hará el getElementById()
    var email = document.getElementById("Id_CorreoElectronico").value;
    var contra = document.getElementById("Id_PassWord").value;
    
    if(email != 0 && contra != 0){
            if(contra.length >= 8){
                //Todo nice, checar en BD
                var contraBD = '';
                var emailBD = '';
                window.open('../html/InicioEditor.php');
                if(contraBD == contra && email == emailBD){
                }
                else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Contraseña o correo incorrectos',
                        
                      })
                }
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La contraseña es demasiado corta',
                    
                  })
            }
        }
}

function checkDataForLoginReportero(){
    //Aqui se hará el getElementById()
    var email = document.getElementById("Id_CorreoElectronico").value;
    var contra = document.getElementById("Id_PassWord").value;
    
    if(email != 0 && contra != 0){
            if(contra.length >= 8){
                //Todo nice, checar en BD
                var contraBD = '';
                var emailBD = '';
                window.open('../html/InicioReportero.php');
                if(contraBD == contra && email == emailBD){
                }
                else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Contraseña o correo incorrectos',
                        
                      })
                }
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La contraseña es demasiado corta',
                    
                  })
            }
        }
}
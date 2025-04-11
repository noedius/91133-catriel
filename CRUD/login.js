function validarLogin(){
   let u = document.forms[0].usuario.value;
   let s = document.forms[0].senha.value;

        if (u.trim() === ""||s.trim() === "" ) {
            alert("Preencha todos os campos");
            return false;
        }
        return true;
    }
document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const username = document.getElementById("nome").value;
    const password = document.getElementById("senha").value;

    if (!username || !password){
       alert("Digita os campos!");
       return;
    }
    if (password.length < 8) {
        alert("A senha precisa de pelo menos 8 caracteres!");
        return;
    }

    localStorage.setItem("username", username);

    window.location.href = "painel.html";
    alert("Login efetuado");

});
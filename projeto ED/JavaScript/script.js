
// Seleciona o botão com id "signin"
var btnSignin = document.querySelector("#signin");

// Seleciona o botão com id "signup"
var btnSignup = document.querySelector("#signup");

// Seleciona o elemento <body>
var body = document.querySelector("body");

// Ao clicar no botão de login, define a classe do body como "sign-in-js"
btnSignin.addEventListener("click", function () {
    body.className = "sign-in-js";
});

// Ao clicar no botão de cadastro, define a classe do body como "sign-up-js"
btnSignup.addEventListener("click", function () {
    body.className = "sign-up-js";
});

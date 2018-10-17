$(function () {
    if(!window.localStorage.getItem("qrvalida_user"))
    {
        window.location = "login.html";
    }

    $('.maskcpf').mask('000.000.000-00');


    ;
});
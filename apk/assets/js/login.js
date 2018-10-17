$(function () {

    $("#loginform").on('submit', (function (e) {
        e.preventDefault();

        var formData = new FormData($(this)[0]);



        $.ajax({
            url: 'http://192.168.15.8/projetos/voucher/server/logarse.php',
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) {


                if(returndata['senha'])
                {

                    localStorage.setItem("qrvalida_user", returndata['email']);
                    localStorage.setItem("qrvalida_pass", returndata['senha']);
                    sessionStorage.setItem("qrvalida_nome", returndata['nome']);
                    sessionStorage.setItem("qrvalida_sexo", returndata['sexo']);
                    localStorage.setItem("qrvalida_id", returndata['user']);



                    window.location = "home.html";
                }
            },
            error: function (xhr, error) {


                window.location = "noconnect.html";
            }
        });

    }));

});
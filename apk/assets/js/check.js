$(function () {




    if(window.localStorage.getItem("qrvalida_user"))
    {
        remember(window.localStorage.getItem("qrvalida_user"), window.localStorage.getItem("qrvalida_pass"));


        function  remember(user, pass)
        {
            var formData = new FormData();
            formData.append('email', user);
            formData.append('senha', pass);


            $.ajax({
                url: 'http://192.168.15.8/projetos/voucher/server/remember.php',
                type: 'POST',
                data: formData,
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function (returndata) {
                	if(returndata['nome'])
					{
                        sessionStorage.setItem("qrvalida_nome", returndata['nome']);
                        sessionStorage.setItem("qrvalida_sexo", returndata['sexo']);
                        window.location = "home.html";
					}else
					{
                        window.location = "login.html";
					}

                },
                error: function (result) {
                    window.location = "noconnect.html";
                }
            });
        }


    }else
    {
        window.location = "login.html";
    }
});
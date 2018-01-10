var userRender = (function ($) {
    var logInRender = function () {
        let html = "<div class='logInDiv'>";
        html += "<input type='text' class='input logIn' placeholder='User Name or Email' />";
        html += "<input type='password' class='input logIn' name='password' placeholder='password' />";
        html += "<input type='button' class='button logInBtn' value='Log In' />";
        html += "</div>";
        return html;
    }


    return {
        htmlLogIn: function () {
            $('.output').html(logInRender());
            $('input[name=password]').keypress(function (e) {
                if (e.keyCode == 13) {
                    $('.logInBtn').click();
                }
            });
        }

    }

})($);
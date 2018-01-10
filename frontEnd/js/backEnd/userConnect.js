var userConnect = (function($) {
    var BASE_URL = 'https://web-10-yorares.c9users.io/PHP Backend/';
    var endpoints = {
        contact: BASE_URL + 'contact',
        search: BASE_URL + 'search',
        getComments: BASE_URL + 'Comments/list',
        addComment: BASE_URL + 'Comments/add',
        getAll: BASE_URL + 'Articles/list',
        create: BASE_URL + 'Articles/add',
        deleteOne: BASE_URL + 'Articles/delete',
        update: BASE_URL + 'Articles/edit',
        logIn: BASE_URL + 'logIn',
        signUp: BASE_URL + 'signUp',
        logOut: BASE_URL + 'logOut',
        myAccount: BASE_URL + 'MyAccount'
    };

    var make_call = function(params, callback) {
        $.ajax({
            url: params.url,
            method: params.method,
            data: params.data || null,
            success: function(result) {
                var resultParsat = JSON.parse(result);
                callback(null, resultParsat);
            },
            error: function(XHR, status, error) {
                callback(error);
            },
            complete: function(XHR, status) {

            }
        });
    };
    var payloadSignUp = function () {
        let userName = $("input[name=userNameLogIn]").val();
        let password = $("input[name=passwordLogIn]").val();

        return {
            userName,
            password
        };

    }

    var payloadSignUp = function() {
        let firstName = $("input[name=firstName]").val();
        let lastName = $("input[name=lastName]").val();
        let userName = $("input[name=userName]").val();
        let email = $("input[name=email]").val();
        let birthDate = $("input[name=birthDate]").val();
        let phone = $("input[name=phone]").val();
        let password = $("input[name=password]").val();

        return {
            firstName,
            lastName,
            userName,
            email,
            birthDate,
            phone,
            password
        };
    }

    return {
        singUp: function(id) {
            let params = {
                url: endpoints.signUp,
                data: payloadSignUp(),
                method: 'POST'
            }
            make_call(params, function(error, result) {
                if (error) {
                    return id(error);
                }
                console.log(result);
                return id(null, result);
            });
        },
        logIn: function (callback) {
            let params = {
                url: endpoints.signUp,
                data: payloadLogIn(),
                method: 'POST'
            }
            make_call(params, function (error, result) {
                if (error) {
                    return callback(error);
                }
                console.log(result);
                return callback(null, result);
            });
        }
    }

})($);
var userConnect = (function ($) {
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

    var make_call = function (params, callback) {
        $.ajax({
            url: params.url,
            method: params.method,
            data: params.data || null,
            success: function (result) {
                var resultParsat = JSON.parse(result);
                callback(null, resultParsat);
            },
            error: function (XHR, status, error) {
                callback(error);
            },
            complete: function (XHR, status) {

            }
        });
    };
})($);
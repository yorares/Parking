            var userRender = (function($) {
                var logInRender = function() {
                    let html = "<div class='logInDiv'>";
                    html += "<input type='text' class='input logIn' placeholder='User Name or Email' name='userNameLogIn' /><br>";
                    html += "<input type='password' class='input logIn' name='passwordLogIn' placeholder='password' /><br>";
                    html += "<input type='button' class='button logInBtn' value='Log In' />";
                    html += '<p class="newAccount">Creaza un cont nou</p>';
                    html += '<input class="input" type="text" name="firstName" placeholder="First Name" ><br>';
                    html += '<input class="input" type="text" name="lastName" placeholder="Last Name" ><br>';
                    html += '<input class="input" type="text" name="userName" placeholder="username" ><br>';
                    html += '<input class="input" type="email" name="email" placeholder="email" ><br>';
                    html += '<input class="input" type="text" name="birthDate" placeholder="Birth date" ><br>';
                    html += '<input class="input" type="text" name="phone" placeholder="Phone number" ><br>';
                    html += '<input class="input" type="password" name="lastName" placeholder="password" ><br>';
                    html += '<input class="input" type="password" name="repassword" placeholder="retype password" ><br>';
                    html += '<input class="input" type="button" value="Sign Up" class="signUpSend" >';
                    html += "</div>";
                    return html;
                }

                return {
                    htmlLogIn: function() {
                        $('.output').html(logInRender());
                        $('input[name=password]').keypress(function(e) {
                            if (e.keyCode == 13) {
                                $('.logInBtn').click();
                            }
                        });
                    },



                }


            })($);
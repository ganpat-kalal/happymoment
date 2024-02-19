<!doctype html>
<html lang="en">
<head>
</head>
<body>
    
    <script>
            function login()
            {
                FB.login(function (response) {
                    if (response.status === 'connected') {
                        testAPI();
                    } else if (response.status === 'not_authorized') {
                    } else {
                    }
                }, {scope: 'public_profile,email'});
            }

            window.fbAsyncInit = function () {
                FB.init({
                    appId: '436044580065543',
                    cookie: true, // enable cookies to allow the server to access 
                    // the session
                    xfbml: true, // parse social plugins on this page
                    version: 'v2.8' // use graph api version 2.8
                });
            };

            // Load the SDK asynchronously
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            function testAPI() {
                FB.api('/me',{ locale: 'en_US', fields: 'id,name,email' },function (response) {
                        document.getElementById("ans").innerHTML = response.id +" "+ response.name+" "+response.email;
                         document.getElementById("img").innerHTML = "<img src='http://graph.facebook.com/" + response.id + "/picture?type=normal' />";
                 });
            }
        </script>

        <p onclick="login();">Login With FB</p>
        <p id="ans"></p>
        <p id="img"></p>
</body>
</html>
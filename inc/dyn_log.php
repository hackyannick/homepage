<script src="https://sso.yannick-hack.de/auth/js/keycloak.js"></script>
    </head>
  
            <script>
            /* If the keycloak.json file is in a different location you can specify it: 
Try adding file to application first, if you fail try the another method mentioned below. Both works perfectly.
            var keycloak = Keycloak('http://localhost:8080/myapp/keycloak.json'); */    
/* Else you can declare constructor manually  */
                var keycloak = Keycloak({
                    url: 'https://sso.yannick-hack.de/auth',
                    realm: 'homepage',
                    clientId: 'downloads'
                });
                keycloak.init({ onLoad: 'login-required' }).then(function(authenticated) {
                    alert(authenticated ? 'authenticated' : 'not authenticated');
                }).catch(function() {
                });
                function logout() {
                    //
                    keycloak.logout('https://sso.yannick-hack.de/auth/realms/homepage/protocol/openid-connect/logout?https://www.yannick-hack.io/logout.php')
                    alert("Logged Out");
                }
				keycloak.login({ redirectUri: 'https://www.yannick-hack.io/info.php' })
								

             </script>

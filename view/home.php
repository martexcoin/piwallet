<style>
 @import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #43A047;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #21b2a6; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #21b2a6, #21b2a6);
  background: -moz-linear-gradient(right, #21b2a6, #21b2a6);
  background: -o-linear-gradient(right, #21b2a6, #21b2a6);
  background: linear-gradient(to left, #21b2a6, #21b2a6);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}
</style>
                <?php if (!defined("IN_WALLET")) { die("Auth Error"); } ?>
                <?php
                if (!empty($error))
                {
                    echo "<p style='font-weight: bold; color: red;'>" . $error['message']; "</p>";
                }
                ?>
                <div class="login-page">
                  <div class="form">
                      <h1>Login MartexCoin WebWallet</h1>
                    <form class="register-form" action="index.php" method="POST">
                      <input type="hidden" name="action" value="register" />
                      <input type="text" name="username" placeholder="Usuario"/>
                      <input type="password" name="password" placeholder="Senha"/>
                      <input type="password" name="confirmPassword" placeholder="Confirmar Senha"/>
                      <button type="submit">Criar Wallet</button>
                      <p class="message">Já Registrado? <a href="#">Logar</a></p>
                    </form>
                    <form class="login-form" action="index.php" method="POST">
                      <input type="hidden" name="action" value="login" />
                      <input type="text" name="username" placeholder="Usu&aacute;rio"/>
                      <input type="password" name="password" placeholder="Senha"/>
                      <input type="password" name="auth" placeholder="C&oacute;digo 2Factor Auth"/>
                      <button type="submit">Login</button>
                      <p class="message">Não tem login? <a href="#">Criar uma Conta</a></p>
                    </form>
                  </div>
                </div>
                
  
  <script src="//assets.codepen.io/assets/common/stopExecutionOnTimeout-f961f59a28ef4fd551736b43f94620b5.js"></script>

  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  <script>
      $('.message a').click(function () {
    $('form').animate({
        height: 'toggle',
        opacity: 'toggle'
    }, 'slow');
});
      //@ sourceURL=pen.js
</script>

    
    <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>

    

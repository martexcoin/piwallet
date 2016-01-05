<?php if (!defined("IN_WALLET")) { die("Auth Error"); } ?>
                <h1>Bem-vindo a <?=$fullname?> wallet!</h1>
                <?php
                if (!empty($error))
                {
                    echo "<p style='font-weight: bold; color: red;'>" . $error['message']; "</p>";
                }
                ?>
                <p>Login...</p>
                <form action="index.php" method="POST" class="clearfix">
                    <input type="hidden" name="action" value="login" />
                    <div class="col-md-2"><input type="text" class="form-control" name="username" placeholder="Usu&aacute;rio"></div>
                    <div class="col-md-2"><input type="password" class="form-control" name="password" placeholder="Senha"></div>
<div class="col-md-2"><input type "text" class="form-control" name="auth" placeholder="C&oacute;digo 2Factor Auth"></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-default">Login</button></div>
                </form>
                <br />
                <p>...ou crie uma nova conta:</p>
                <form action="index.php" method="POST" class="clearfix">
                    <input type="hidden" name="action" value="register" />
                    <div class="col-md-2"><input type="text" class="form-control" name="username" placeholder="Usu&aacute;rio"></div>
                    <div class="col-md-2"><input type="password" class="form-control" name="password" placeholder="Senha"></div>
                    <div class="col-md-2"><input type="password" class="form-control" name="confirmPassword" placeholder="Confirmar senha"></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-default">Cadastrar</button></div>
                </form>

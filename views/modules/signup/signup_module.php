<div class="container-fluid signup">

    <div class="container">

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 signUpBox">

            <h3 class="signUpTitle">Register your account</h3>

            <div class="form-group text-center inputs">

                <form method="post" onsubmit="return registerUser();">

                    <br/>

                    <h4>Or Register with our account system</h4>

                    <br/>

                    <input class="form-control-lg nameInput" id="nameInput" name="nameInput" placeholder="Name" type="text">

                    <br/>

                    <input class="form-control-lg lastNameInput" id="lastNameInput" name="lastNameInput" placeholder="Last Name" type="text">

                    <br/>

                    <input class="form-control-lg emailInput" id="emailInput" name="emailInput" placeholder="Email Address" type="email">

                    <br/>

                    <input class="form-control-lg passwordInput" id="passwordInput" name="passwordInput" placeholder="Password" type="password">
                    <br/>
                    <?php
                        $register = new UsersController();
                        $register->RegisterUser();
                    ?>
                    <input type="submit" class="btn btn-default signUpBtn" value="Sign Up">

                </form>

                <!--<button type="submit" class="btn btn-default signUpBtn">Sign Up</button> -->

                <br/>

                <a href="https://www.iubenda.com/privacy-policy/31313691" class="iubenda-white iubenda-embed" title="condiciones de uso y políticas de privacidad">Politica de Privacidad</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>

                <br/>

                <p class="registerText">¿Ya tienes una cuenta registrada? | <a class="registerBtn" href="login">Ingresar</a></p>
            </div>

        </div>

    </div>

</div>
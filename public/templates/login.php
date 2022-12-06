<h1 class="text-center">Login</h1>
<div class="ipsum-form">
            <form action="./login/loginrequest" method="POST">
                <div class="ipsum-fieldset">
                    <div class="ipsum-input-wrapper">
                        <div class="ipsum-input-container">
                            <input class="ipsum-input text {{inputerror}}" type="text" name="username" placeholder="Username"/>                            
                        </div>
                        <div class="ipsum-input-container">
                            <input class="ipsum-input text {{inputerror}}" type="password" name="password" placeholder="Password"/>
                        </div>
                    </div>
                </div>

                <div class="spaceBetween font-small">
                    <div class="ipsum-checkbox">
                        <input class="ipsum-input" type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <!-- <a style="display: block;" href="">Forgot password</a> -->

                </div>
                <span class="text-center" style="color: red">{{inputerrormsg}}</span>

                <div class="center">
                <button class="ipsum-button affirm" type="submit">Login</button>
                Don't have an account yet? <a style="display: block" href="{{registrationpath}}">Register</a>
            </div>
    <!-- display optional error -->
            </form>
</div>
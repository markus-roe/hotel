<h1 class="text-center">Register</h1>
<div class="ipsum-form">
    <form action="./registration/register" method="POST">
        <div class="ipsum-fieldset">
            <div class="ipsum-input {{cssinputclass}}-wrapper">
            <span class="text-center" style="color:red">{{errormsg}}</span>

                <div class="ipsum-input {{cssinputclass}}-container horizontalLine">
                <div class="col first">
                   <h5>Gender</h5>
                </div>
                <div class="col">
                    <input class="ipsum-input {{cssinputclass}}" type="radio" name="gender" id="female"
                    value="f" />
                  <label  for="female">Female</label>
                </div>
                <div class="col">
                    <input class="ipsum-input {{cssinputclass}}" type="radio" name="gender" id="male"
                    value="m" />
                  <label for="male">Male</label>
                </div>
                <div class="col">
                    <input class="ipsum-input {{cssinputclass}}" type="radio" name="gender" id="other"
                    value="o" />
                  <label for="other">Other</label>
                </div>
            </div>
            </div>
        </div>
        <div class="ipsum-input {{cssinputclass}}-container labelOnTop horizontalLine">
            <label for="fname">First Name</label>
            <input class="ipsum-input {{cssinputclass}} text" type="text" id="fname" name="firstname" placeholder="First name"/>                            
            <label for="lname">Last Name</label>
            <input class="ipsum-input {{cssinputclass}} text" type="text" id="lname" name="surname" placeholder="Last name"/>                            
                </div>

            <div class="ipsum-input {{cssinputclass}}-container labelOnTop">
                <label for="username">Username</label>
                <input class="ipsum-input {{cssinputclass}} text" type="text" id="username" name="username" placeholder="Username"/>                            
            </div>
            <div class="ipsum-input {{cssinputclass}}-container labelOnTop">
                <label for="email">Email</label>
                <input class="ipsum-input {{cssinputclass}} text" type="text" id="email" name="email" placeholder="Email"/>                            
            </div>
            <div class="ipsum-input {{cssinputclass}}-container labelOnTop">
                <label for="password">Password</label>
                <input type="password" id="password" class="ipsum-input {{cssinputclass}} text" name="password" placeholder="Password">
            </div>
            <div class="ipsum-input {{cssinputclass}}-container labelOnTop">
                <label for="password2">Repeat Password</label>
                <input type="password" class="ipsum-input {{cssinputclass}} text" name="password2" id="password2" placeholder="Repeat Password">

            </div>
            <div class="center">
                <button class="ipsum-button affirm" type="submit">Register</button>
                Already have an account? <a style="display: block" href="{{loginpath}}">Login</a>
            </div>
        </div>


            </form>
        </div>
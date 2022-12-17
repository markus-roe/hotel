<div class="text-center">
    <h1>{{page-title}}</h1>
</div>

<div class="ipsum-form">
    <form action="{{profile-update-link}}{{userId}}" method="POST">
        <div class="ipsum-fieldset">
            <div class="ipsum-input-container labelOnTop horizontalLine">
                <div class="text-center">
                    <h4>Personal Data</h5>
                </div>
                <label for="fname">First Name</label>
                <input class="ipsum-input text" id="fname" type="text" name="firstname" value="{{firstname}}" />
                <label for="lname">Last Name</label>
                <input class="ipsum-input text" id="surname" type="text" name="surname" value="{{surname}}" />
                <label for="username">Username</label>
                <input disabled class="ipsum-input text" id="username" type="text" class="username" name="username" placeholder="{{username}}" />
                <label for="email">Email</label>
                <input class="ipsum-input text" id="email" type="text" name="email" value="{{email}}" />
                <label for="phone">Phone</label>
                <input class="ipsum-input text" id="phone" type="text" name="phone" value="{{phone}}" />
            </div>
        </div>
        <div class="center">
            <button class="ipsum-button affirm" type="submit">Update</button>
            
        </form>
            <form action="{{userStatusFormLink}}" method="post" style="width: 100%;">
                <button class="btn btn-danger ipsum-button" type="submit">{{userStatusBtnTxt}}</button>
            </form>
        </div>
</div>
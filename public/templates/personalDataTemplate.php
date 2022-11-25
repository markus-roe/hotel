<div class="text-center">
    <h1>{{page-title}}</h1>
</div>

<div class="ipsum-form">
    <form action="{{profile-update-link}}" method="POST">
        <div class="ipsum-fieldset">
            <div class="ipsum-input-container labelOnTop horizontalLine">
            <div class="text-center"><h4>Personal Data</h5></div>
                <label for="fname">First Name</label>
                <input class="ipsum-input text" id="fname" type="text" name="firstname" value="{{firstname}}" />
                <label for="lname">Last Name</label>
                <input class="ipsum-input text" id="surname" type="text" name="surname" value="{{surname}}" />
                <label for="username">Username</label>
                <input disabled class="ipsum-input text" id="username" type="text" class="username" name="username" placeholder="{{username}}" />
                <label for="email">Email</label>
                <input class="ipsum-input text" id="email" type="text" name="email" value="{{email}}" />
            </div>
            <div class="ipsum-input-container labelOnTop horizontalLine">
                <div class="text-center"><h4>Change Password</h5></div>
                <label for="currPassword">Current Password</label>
                <input type="password" class="ipsum-input text" id="currPassword" name="password" placeholder="Current Password">
                <label for="newPassword">New Password</label>
                <input type="password" class="ipsum-input text" name="newPassword" placeholder="New Password">
                <label for="passwordRepeat">Repeat new password</label>
                <input type="password" class="ipsum-input text" id="passwordRepeat" name="newPasswordRepeat" placeholder="Repeat New Password">
            </div>
        </div>
        <div class="center">
            <button class="ipsum-button affirm" type="submit">Update</button>
        </div>
    </form>
</div>
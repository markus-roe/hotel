<div class="text-center">
    <h1>{{page-title}}</h1>
</div>

<div class="ipsum-form">
    <form action="{{profile-update-link}}" method="POST">
        <div class="ipsum-fieldset">
            <div class="ipsum-input-container labelOnTop horizontalLine">
                <label for="fname">First Name</label>
                <input class="ipsum-input text" id="fname" type="text" name="firstname" value="{{firstname}}" />
                <label for="lname">Surname</label>
                <input class="ipsum-input text" id="surname" type="text" name="surname" value="{{surname}}" />
            </div>
            <div class="ipsum-input-container labelOnTop horizontalLine">
                <label for="username">Username</label>
                <input disabled class="ipsum-input text" id="username" type="text" class="username" name="username" placeholder="{{username}}" />
            </div>
            <div class="ipsum-input-container labelOnTop horizontalLine">
                <label for="email">Email</label>
                <input class="ipsum-input text" id="email" type="text" name="email" value="{{email}}" />
                <label for="phone">Phone</label>
                <input class="ipsum-input text" id="phone" type="text" name="phone" placeholder="{{phone}}" />
            </div>
            <div class="ipsum-input-container labelOnTop horizontalLine">
                <label for="currPassword">Current Password</label>
                <input type="password" class="ipsum-input text" id="currPassword" name="password" placeholder="Current Password">
            </div>
            <div class="ipsum-input-container labelOnTop horizontalLine">
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
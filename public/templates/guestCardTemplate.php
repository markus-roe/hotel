<div class="ipsum-card" style="height: fit-content !important;">
    <form action="" method="POST">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="cell">
                        <span class="title">
                            Vorname
                        </span>
                        <a href="{{user-data-path}}">{{firstname}}</a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="cell">
                        <span class="title">
                            Nachname
                        </span>
                        <a href="{{user-data-path}}">{{surname}}</a>
                    </div>
                </div>
                <div class="col-3">
                    <div class="cell">
                        <span class="title">
                            Geschlecht
                        </span>
                        <span>{{gender}}</span>
                    </div>
                </div>
                <div class="col-3">
                    <div class="cell">
                        <span class="title">
                            Username
                        </span>
                        <span>{{username}}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <div class="cell">
                        <span class="title">
                            Email
                        </span>
                        <span>{{email}}</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="cell">
                        <span class="title">
                            Telefonnummer
                        </span>
                        <span>{{phone}}</span>

                    </div>
                </div>
                <div class="col-3">
                    <div class="cell" style="display: flex; flex-direction:column">
                    <a href="{{user-data-path}}"><button type="button" class="btn btn-success ipsum-edit-btn"><span>&#9998;</span></button></a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
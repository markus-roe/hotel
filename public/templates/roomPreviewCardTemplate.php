<div class="col-sm-6">
    <div class="card mb-3 ipsum-roomImg">
        <div class="row g-0">
            <div class="col-md-4">
                <a href="./booking/room/{{roomId}}"><img src="{{picturePath}}" class="img-fluid rounded" alt="..." /></a>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><a class="link" href="./booking/room/{{roomId}}">{{name}}</a></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Preis: <b>€ {{price}} / Nacht</b></h6>
                    <!-- <p class="card-text">
                {{room-preview}}
              </p> -->
                    <p class="card-text">
                        <!-- <small class="text-muted">Last updated on {{room-updated}}</small><br> -->
                    </p>
                    <button type="button" class="btn btn-primary btn-sm"><a href="./booking/room/{{roomId}}">Jetzt buchen!</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
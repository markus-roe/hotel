<div class="col-sm-6">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4" style="width:100%">
            <a href="./article/post/{{postId}}"><img src="public{{thumbnailPath}}" class="img-fluid rounded" alt="..." /></a>
            </div>
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title"><a class="link" href="./article/post/{{postId}}" style="text-decoration: none">{{headline}}</a></h5>
                    <p class="card-text">
                        {{preview}}
                    </p>
                    <p class="card-text">
                        <small class="text-muted">Created on: {{created}}</small><br>
                    </p>
                    <button type="button" class="btn btn-primary btn-sm"><a href="./article/post/{{postId}}" style="color:white; text-decoration: none">Read more</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
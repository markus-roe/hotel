<div class="col-sm-6">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4" style="width:100%">
                <img src="./public/{{picturePath}}" class="img-fluid rounded" alt="..." />
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><a class="link" href="./news/article/post/id/{{postId}}/index" style="text-decoration: none">{{headline}}</a></h5>
                    <p class="card-text">
                        {{preview}}
                    </p>
                    <p class="card-text">
                        <small class="text-muted">Last updated on: {{updated}}</small><br>
                    </p>
                    <button type="button" class="btn btn-primary btn-sm"><a href="./news/article/post/id/{{postId}}/index" style="color:white; text-decoration: none">Read more</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
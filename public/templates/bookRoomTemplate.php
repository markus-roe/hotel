<article class="ipsum-article horizontalLine">
    <h2>{{headline}}</h2>
    <p>
    </p>
    <div class="text-center container-fluid w-80">
        <img src="https://picsum.photos/800/500" class="rounded img-fluid" alt="Image not found...">
        <!-- <img src="https://picsum.photos/1100/500" class="rounded img-fluid" alt="..."> -->
    </div>

    <form action="{{bookingPath}}" method="POST">
        <div id="booking-inputs" class="text-center ipsum-form tiny float" style="margin-top: 2rem; margin-bottom:2rem">
            <span class="text-center" style="color: red; position: absolute">{{inputerrormsg}}</span>
            <div class="ipsum-input-container">
                <input type="date" name="startDate" id="">
            </div>
            <div class="ipsum-input-container">
                <input type="date" name="endDate" id="">
            </div>
            <div class="ipsum-input-container">
                <button class="ipsum-button btn btn-primary" type="submit">Buchen</button>
            </div>
        </div>
    </form>
    <span class="horizontalLine"></span>
    <br>
    {{content}
</article>
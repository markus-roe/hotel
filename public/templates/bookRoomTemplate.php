<article class="ipsum-article horizontalLine">
    <h2 class="text-center">{{name}}</h2>
    <p>
    </p>
    <div class="text-center container-fluid w-40">
        <img src="{{picturePath}}" class="rounded img-fluid" alt="Image not found...">
        <!-- <img src="https://picsum.photos/1100/500" class="rounded img-fluid" alt="..."> -->
    </div>

    <form action="{{actionPath}}{{roomId}}" method="POST">
        <div id="booking-inputs" class="text-center ipsum-form tiny float">
            <!-- <span class="text-center" style="color: red; position: absolute">{{inputerrormsg}}</span> -->
            <div class="ipsum-input-container-vertical">
                <input type="date" name="startDate" id="">
                <input type="date" name="endDate" id="">
                <button class="ipsum-button btn btn-primary" type="submit">Buchen</button>
            </div>
        </div>
        <span class="horizontalLine"></span>
        <br>
        <!-- {{description}} -->
        <h3>Ausstattung</h3>
        <div class="text-center container-fluid w-40">
            <div class="ipsum-checkbox">
                <input type="checkbox" name="services[]" id="ac" class="ipsum-input" value="3" />
                <label for="ac">Klima-Anlage</label>
            </div>
            <div class="ipsum-checkbox">
                <input type="checkbox" name="services[]" id="tv" class="ipsum-input" value="4">
                <label for="tv">TV</label>
            </div>
            <div class="ipsum-checkbox">
                <input type="checkbox" name="services[]" id="parking" class="ipsum-input" value="1">
                <label for="parking">Parkplatz</label>
            </div>
            <div class="ipsum-checkbox">
                <input type="checkbox" name="services[]" id="wifi" class="ipsum-input" value="2">
                <label for="wifi">WIFI</label>
            </div>


        </div>
    </form>
</article>
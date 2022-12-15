<article class="ipsum-article horizontalLine">
    <h2 class="text-center">{{name}}</h2>
    <p>
    </p>
    <div class="text-center container-fluid w-40">
        <img src="{{picturePath}}" class="rounded img-fluid" alt="Image not found...">
        <!-- <img src="https://picsum.photos/1100/500" class="rounded img-fluid" alt="..."> -->
    </div>

    <form action="{{bookingPath}}" method="POST">
        <div id="booking-inputs" class="text-center ipsum-form tiny float">
            <!-- <span class="text-center" style="color: red; position: absolute">{{inputerrormsg}}</span> -->
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
    <!-- {{description}} -->
    <h3>Ausstattung</h3>
    <p>
        <ul class="ipsum-ul">
            <li>Klima-Anlage</li>
            <li>Fernseher</li>
            <li>WIFI</li>
            <li>Room Service</li>
        </ul>
    </p>
</article>
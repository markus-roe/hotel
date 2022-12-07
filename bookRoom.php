<?php include "templates_new\header.php";
include "templates_new\menu.php";
include "./public/templates/contentWrapperStart.php" ?>

<!-- CONTENT_START -->
<article class="ipsum-article horizontalLine">
  <h2>{{headline}}</h2>
  <p>
  </p>
  <div class="text-center container-fluid w-80">
    <img src="https://picsum.photos/800/500" class="rounded img-fluid" alt="Image not found...">
    <!-- <img src="https://picsum.photos/1100/500" class="rounded img-fluid" alt="..."> -->
  </div>

  {{error}}
  <span class="text-center" style="color: red; position: relative">{{inputerrormsg}}</span>
  <form action="{{bookingPath}}" method="POST">
    <div id="booking-inputs" class="text-center ipsum-form tiny float" style="margin-top: 2rem; margin-bottom:2rem">
      <div class="ipsum-input-container">
        <input type="date" name="startDate" id="">
      </div>
      <div class="ipsum-input-container">
        <input type="date" name="endDate" id="">
      </div>
      <div class="ipsum-input-container">
        <button class=" btn btn-primary" type="submit">Buchen</button>
      </div>
    </div>
  </form>
  <span class="horizontalLine"></span>
  <br>
  {{content}
        </article>
            <!-- CONTENT_END -->

<?php include "./public/templates/contentWrapperEnd.php"; ?>
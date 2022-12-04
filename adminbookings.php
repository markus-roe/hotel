<?php include "templates_new\header.php";
include "templates_new\menu.php" ?>
<div class="container">
    <div class="title-section mt-3 mb-3 p-0 text-center">
    </div>
    <div class="row">
        <div class="col-md-2 col-xs-1"></div>
        <div class="col-xs-12 col-md-8">
            <!-- CONTENT_START -->
            <div class="ipsum-card">
                <div class="container">
                    <div class="row">
                        <div class="col-4">
                            <div class="cell">
                                <span class="title">
                                    Name
                                </span>
                                <a href="">Max Mustermann</a>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="cell">
                                <span class="title">
                                    Zeitraum
                                </span>
                                <textarea rows="1" cols="10" name="startDate" class="ipsum-card-input">20.12.2022</textarea>
                                <textarea rows="1" cols="10" name="endDate" class="ipsum-card-input">30.12.2022</textarea>
                            </div>
                        </div>
                        <!-- <div class="col-4">
                            <div class="cell">
                                <span class="title">
                                    Personen
                                </span>
                                <input type="text" rows="1" name="" class="ipsum-card-input" value="4">
                            </div>
                        </div> -->
                        <div class="col-4">
                            <div class="cell">
                                <span class="title">
                                    Status
                                </span>
                                <select class="ipsum-card-input select-option" data-labeltype="confirmed" name="" id="">
                                    <option data-labeltype="confirmed" value="confirmed" selected>Bestätigt</option>
                                    <option data-labeltype="new" value="new">Neu</option>
                                    <option data-labeltype="storno" value="storno">Storniert</option>
                                </select>
                            </div>
                        </div>

                    </div>
                        <!-- <div class="w-100"></div> -->
                    <div class="row">
                        <div class="col-4">
                            <div class="cell">
                                <span class="title">
                                    Services
                                </span>
                            <ul class="services-list">
                                <li>Haustiere</li>
                                <li>Parkplatz</li>
                            </ul>

                            </div>
                        </div>
                        <div class="col-4">
                            <div class="cell">
                                <span class="title">
                                    Gesamtpreis
                                </span>
                                <span>€</span>
                                <input style="width:5rem" class="ipsum-card-input" type="number" min="0.00" step="0.01" name="roomId" id="" value="121.00">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="cell">
                                <span class="title">Zimmernr.</span>
                                <input class="ipsum-card-input" type="text" name="roomId" id="" value="121">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- CONTENT_END -->
    </div>
</div>
</div>
<div class="col-md-2 col-xs-1"></div>
</div>
</div>
</body>

</html>
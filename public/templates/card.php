<div class="ipsum-card">
                <div class="container">
                    <div class="row">
                        <div class="col-4">
                            <div class="cell">
                                <span class="title">
                                    Name
                                </span>
                                <a href="{{profilePath}}">{{firstname}} {{surname}}</a>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="cell">
                                <span class="title">
                                    Zeitraum
                                </span>
                                <textarea rows="1" cols="10" name="startDate" class="ipsum-card-input">{{startDate}}</textarea>
                                <textarea rows="1" cols="10" name="endDate" class="ipsum-card-input">{{endDate}}</textarea>
                            </div>
                        </div>
                        <!-- <div class="col-4">
                            <div class="cell">
                                <span class="title">
                                    Personen
                                </span>
                                <input type="text" rows="1" name="" class="ipsum-card-input" value="4">
                            </div>e
                        </div> -->
                        <div class="col-4">
                            <div class="cell">
                                <span class="title">
                                    Status
                                </span>
                                <select class="ipsum-card-input select-option" data-labeltype="confirmed" name="status" id="">
                                    <option data-labeltype="confirmed" value="confirmed" {{status}}>Bestätigt</option>
                                    <option data-labeltype="new" value="new" {{status}}>Neu</option>
                                    <option data-labeltype="storno" value="storno" {{status}}>Storniert</option>
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
                                <input style="width:5rem" class="ipsum-card-input" type="number" min="0.00" step="0.01" name="roomId" id="" value="{{price}}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="cell">
                                <span class="title">Zimmernr.</span>
                                <input class="ipsum-card-input" type="text" name="roomId" id="" value="{{roomId}}">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
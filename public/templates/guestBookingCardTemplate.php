<div class="ipsum-card">
                <div class="container">
                    <div class="row">
                        <div class="col-4">
                            <div class="cell">
                                <span class="title">
                                    Name
                                </span>
                                <span>{{firstname}} {{surname}}</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="cell">
                                <span class="title">
                                    Zeitraum
                                </span>
                                <span class="ipsum-card-input">{{startDate}}</span>
                                <span> - </span>
                                <span class="ipsum-card-input">{{endDate}}</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="cell">
                                <span class="title">
                                    Status
                                </span>
                                <select class="ipsum-card-input select-option" data-labeltype="{{bookingStatus}}" name="" id="" disabled>
                                    <option data-labeltype="confirmed" value="confirmed" {{confirmed}}>Bestätigt</option>
                                    <option data-labeltype="new" value="new" {{new}}>Neu</option>
                                    <option data-labeltype="storno" value="storno" {{storno}}>Storniert</option>
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
                                {{services}}
                            </ul>

                            </div>
                        </div>
                        <div class="col-5">
                            <div class="cell">
                                <span class="title">
                                    Gesamtpreis
                                </span>
                                <span>€</span>
                                <span style="width:5rem" class="ipsum-card-input" type="number" min="0.00" step="0.01" name="roomId" id="" value="{{price}}">
                                {{price}}</span>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="cell">
                                <span class="title">Zimmernr.</span>
                                <span class="ipsum-card-input" type="text" name="roomId" id="" value="{{roomId}}">{{roomId}}</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
<form action="./booking/{{bookingId}}/update" method="POST">
    <div class="ipsum-card">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="cell">
                        <span class="title">
                            Name
                        </span>
                        <a href="./admin/userprofile/{{userId}}">{{firstname}} {{surname}}</a>
                    </div>
                </div>
                <div class="col-5">
                    <div class="cell">
                        <span class="title">
                            Zeitraum
                        </span>
                        <input type="date" name="startDate" class="ipsum-card-input" value="{{startDate}}"></input>
                        <input type="date" name="endDate" class="ipsum-card-input" value="{{endDate}}"></input>
                    </div>
                </div>
                <div class="col-3">
                    <div class="cell">
                        <span class="title">
                            Status
                        </span>
                        <select class="ipsum-card-input select-option" data-labeltype="{{bookingStatus}}" name="bookingStatus" id="">
                            <option data-labeltype="confirmed" value="2" {{confirmed}}>Bestätigt</option>
                            <option data-labeltype="new" value="1" {{new}}>Neu</option>
                            <option data-labeltype="storno" value="3" {{canceled}}>Storniert</option>
                        </select>
                    </div>
                </div>
            </div>
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
                        <input style="width:5rem" class="ipsum-card-input" type="number" min="0.00" step="0.01" name="price" id="" value="{{price}}">
                    </div>
                </div>
                <div class="col-3">
                    <div class="cell">
                        <span class="title">Zimmernr.</span>
                        <input class="ipsum-card-input" type="text" name="roomId" id="" value="{{roomId}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="cell">
                        <span class="title">Erstellt am</span>
                        <span>{{date}}</span>
                    </div>
                </div>
                <div class="col-5">
                </div>
                <div class="col-3" style="display: flex;flex-direction: column;flex-wrap: nowrap; justify-content: flex-end;">
                    <div class="cell" style="display: flex; flex-direction:column">
                       <button type="submit" class="btn btn-success"> <span style="font-size: 1.0rem; font-weight: bold;"> &#x2713;</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
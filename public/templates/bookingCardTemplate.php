<form action="./booking/{{bookingId}}/update" method="POST">
<div class="ipsum-card">
    <div class="container">
        <div class="row">
            <div class="col-4">
            <div class="cell">
                <span class="title">
                Name
                </span>
                <a>{{firstname}} {{surname}}</a>
            </div>
            </div>
            <div class="col-4">
            <div class="cell">
                <span class="title">
                Zeitraum
                </span>
                <input type="date" name="startDate" class="ipsum-card-input" value="{{startDate}}"></input>
                <input type="date" name="endDate" class="ipsum-card-input" value="{{endDate}}"></input>
                <!-- <textarea rows="1" cols="10" name="endDate" class="ipsum-card-input">{{endDate}}</textarea> -->
            </div>
            </div>
            <div class="col-4">
                <div class="cell">
                    <span class="title">
                    Status
                    </span>
                    <select class="ipsum-card-input select-option" data-labeltype="{{bookingStatus}}" name="" id="">
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
            <div class="col-4">
                <div class="cell">
                    <span class="title">
                    Gesamtpreis
                    </span>
                    <span>€</span>
                    <input style="width:5rem" class="ipsum-card-input" type="number" min="0.00" step="0.01" name="price" id="" value="{{price}}">
                </div>
            </div>
            <div class="col-4">
                <div class="cell">
                    <span class="title">Zimmernr.</span>
                    <input class="ipsum-card-input" type="text" name="roomId" id="" value="{{roomId}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <div class="col-3">
                    <div class="cell" style="display: flex; flex-direction:column">
                    <!-- <button type="submit" class="btn btn-success">Bearbeiten</button> -->
                    <a href="./booking/{{bookingId}}/update"><button type="submit" class="btn btn-success">Bearbeiten</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
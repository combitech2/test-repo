@include('partials.head')

    <div id="map-canvas"></div>

    <div id="tweet" v-if="selectedTweet">
    <div class="close-tweet" @click="clearAllSelected()">X</div>
        <span class="tweet-author">@{{ selectedTweet.author }}</span>
        <span class="tweet-time">@{{ selectedTweet.time }}</span>
        <p class="tweet-msg">@{{{ selectedTweet.msg }}}</p>
    </div>

    <div id="event-list" v-show="selectedPlace">
        <div class="close-events" @click="clearAllSelected()">X</div>
        <div class="top">
            <h3>@{{ selectedPlace ? selectedPlace.name : '' }}</h3>
            <p>@{{ selectedPlace ? (selectedPlace.description.length > 200 ? selectedPlace.description.substring(0, 200) + '...' : selectedPlace.description) : '' }}</p>
        </div>
        <div class="event-row" v-show="events.length <= 0">
            <span>Inga events :(</span>
        </div>
        <div class="event-row" v-for="event in events" @click="selectEvent(event)">
            <span class="event-name">@{{ event.name }}</span>
            <span class="event-description">@{{{ event.description }}}</span>
        </div>
    </div>

@include('partials.footer')
var Autolinker = require('autolinker');
var autolinker = new Autolinker();

var createMarker = function (map, item, color) {
    var position = {
        lat: item.lat,
        lng: item.lng
    };

    var marker = new google.maps.Marker({
        map: map,
        position: position,
        title: item.name,
        icon: (color == 'blue') ? vm.bluePinImage : vm.redPinImage,
        shadow: vm.pinShadow
    });

    return marker;
};

var createPlaceMarker = function (map, item) {
    var marker = createMarker(map, item, 'red');

    marker.addListener('click', function () {
        $.get('/event?place_id=' + item.id, function(data) {
            vm.setEvents(data);
            vm.selectPlace(item);
        });
    });
};

var tweetMarkers = [];

var vm = new Vue({
    el: '#app',

    data: {
        bluePinImage: null,
        redPinImage: null,
        pinShadow: null,
        map: null,

        events: {},
        places: {},
        selectedEvent: null,
        selectedPlace: null,
        selectedTweet: null,
        filterText: ''
    },

    methods: {
        init: function () {
            // Create a map object and specify the DOM element for display.
            this.bluePinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|4AE4FE",
                new google.maps.Size(21, 34),
                new google.maps.Point(0,0),
                new google.maps.Point(10, 34));
            this.redPinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|FE192D",
                new google.maps.Size(21, 34),
                new google.maps.Point(0,0),
                new google.maps.Point(10, 34));
            this.pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
                new google.maps.Size(40, 37),
                new google.maps.Point(0, 0),
                new google.maps.Point(12, 35));

            global.map = new google.maps.Map(document.getElementById('map-canvas'), {
                center: {
                    lat: 62.98, 
                    lng: 16.62
                },
                scrollwheel: true,
                zoom: 5
            });

            this.getPlaces();
            this.getTweets('');
        },

        clearAllSelected: function () {
            this.events = {};
            this.selectedPlace = null;
        },

        setEvents: function (events) {
            events.forEach(function (item) {
                item.description = autolinker.link(item.description);
            });
            this.events = events;
        },

        selectEvent: function (event) {
            this.selectedEvent = event;
        },

        selectPlace: function (place) {
            this.selectedPlace = place;
        },

        selectTweet: function (tweet) {
            this.selectedTweet = tweet;
        },

        getTweets: function (filter) {
            $.get('/message?filter=' + encodeURIComponent(filter), function(data) {
                this.tweets = data;
                data.forEach(function (item) {
                    this.createTweetMarker(item);
                }.bind(this));
            }.bind(this));
        },

        getPlaces: function () {
            $.get('/place', function(data) {
                this.places = data;
                data.forEach(function (item) {
                    createPlaceMarker(global.map, item);
                }.bind(this));
            }.bind(this));
        },

        filterTweets: function () {
            tweetMarkers.forEach(function (item) {
                item.setMap(null);
            });

            this.getTweets(this.filterText);
        },

        createTweetMarker: function (item) {
            var marker = createMarker(global.map, item, 'blue');

            marker.addListener('click', function () {
                this.selectTweet({ author: item.name, time: item.created_at, msg: autolinker.link(item.message) });
            }.bind(this));

            tweetMarkers.push(marker);
        }
    }
});

module.exports = vm;
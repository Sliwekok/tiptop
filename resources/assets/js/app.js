/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });

let googleMap, googleMapMarker = null, placesApiInited = null;

function tog(v) {
    return v ? 'addClass' : 'removeClass';
}

$(document).on('input', '.clearable', function () {
    $(this)[tog(this.value)]('x');
}).on('mousemove', '.x', function (e) {
    $(this)[tog(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]('onX');
}).on('touchstart click', '.onX', function (ev) {
    ev.preventDefault();
    $(this).removeClass('x onX').val('').change();
});


window.alert = (title, content, size = null) => {

    let $alert = $("#alertModal");

    if (size !== null) {
        $alert.find('.modal-dialog').addClass('modal-' + size);
    }

    $alert.find('.modal-title').text(title);
    $alert.find('.modal-text').html(content);

    $alert.modal();
};

window.initGoogleMapsOnCreateAnimalView = function () {
    initMap();
    initPlacesApi();
};

window.initGoogleMapsOnUpdateAnimalView = function () {
    initMap();
    initPlacesApi();
    setGoogleMapMarker(parseFloat($('#lat').val()), parseFloat($('#lng').val()))
};

window.initMap = function () {
    let lat = 52.411969, lng = 16.931340;

    googleMap = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: {lat: lat, lng: lng}
    });
};

window.setGoogleMapMarker = function (lat, lng) {
    googleMapMarker = new google.maps.Marker({
        map: googleMap,
        anchorPoint: new google.maps.Point(0, -29)
    });

    googleMapMarker.setPosition({lat: lat, lng: lng});
    googleMap.setCenter({lat: lat, lng: lng});
    googleMap.setZoom(13);
};

window.onAnimalFormSubmit = () => {

    $('form[name="animalForm"]').on('submit', (e) => {

        const $date = $('input[name="accidentDate"]'), $time = $('input[name="accidentTime"]'), $lat = $('input[name="lat"]'), $submitBtn = $('.submit-btn');

        if ($lat.val() === '' || $lat.val() === "0") {
            e.preventDefault();
            alert('Uwaga!', 'Musisz wyszukać lokalizację i wybrać ją z listy, aby dodać ogłoszenie.', 'sm');
            return false;
        }

        let date = moment($date.val());

        if (!date.isValid()) {
            e.preventDefault();
            alert('Uwaga!', 'Wpisz poprawną datę np. 2018-05-16 (rok-miesiac-dzien).', 'sm');
            return false;
        }

        let time = moment($date.val() + ' ' + $time.val());

        if (!time.isValid()) {
            e.preventDefault();
            alert('Uwaga!', 'Wpisz poprawną godzinę np. 15:05 (godziny:minuty).', 'sm');
            return false;
        }

        $submitBtn.html('<i class="fa fa-spinner fa-spin mr-2"></i> Proszę czekać');
        $submitBtn.attr('disabled', 'disabled');

        return true;

    });

};

window.setGoogleMapCircle = function (lat, lng) {
    new google.maps.Circle({
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35,
        map: googleMap,
        center: {lat: lat, lng: lng},
        radius: 200
    });
    googleMap.setCenter({lat: lat, lng: lng});
    googleMap.setZoom(13);
};

window.initPlacesApi = function () {

    /* Bind keydown to places input and prevent enter key default action. */
    let input = document.getElementById('place');
    const $placeClear = $('#place-clear');

    google.maps.event.addDomListener(input, 'keydown', function (e) {
        if (e.keyCode === 13 && $('.pac-container:visible').length) {
            e.preventDefault();
        }
    });

    $placeClear.click((e) => {
        $('#lat').val("");
        $('#lng').val("");
        $('#place').val("").removeAttr('disabled').focus();
        $('#placeName').val("");
        if (googleMapMarker !== null) {
            googleMapMarker.setVisible(false);
            googleMapMarker = null;
            googleMap.setCenter({lat: 52.411969, lng: 16.931340});
            googleMap.setZoom(13);
        }
        $placeClear.attr('disabled', 'disabled');
    });

    /* Google Places API options */
    let options = {
        // types: ['(regions)'],
        componentRestrictions: {country: "pl"}
    };

    /* Init Google Places API */
    let autocomplete = new google.maps.places.Autocomplete(input, options);

    autocomplete.addListener('place_changed', function () {

        let place = autocomplete.getPlace();

        if (!place.geometry) {
            window.alert("No details available for input: '" + place.name + "'");
            return false;
        }

        $('#lat').val(place.geometry.location.lat());
        $('#lng').val(place.geometry.location.lng());
        $('#place').val(place.formatted_address).attr('disabled', 'disabled');
        $('#placeName').val(place.formatted_address);

        if (!$placeClear.hasClass('no-marker')) {
            setGoogleMapMarker(place.geometry.location.lat(), place.geometry.location.lng());
        }

        $placeClear.removeAttr('disabled');

    });

    placesApiInited = true;

};

window.initGoogleMapsOnAnimalDetails = function () {
    const lat = parseFloat($('#animal-details').data('lat')), lng = parseFloat($('#animal-details').data('lng'));
    initMap();
    setGoogleMapCircle(lat, lng);
};

window.onCaptchaResponse = function (e) {
    $.ajax({
        type: "POST",
        url: baseUrl + '/numer-telefonu',
        data: {id: $('#animal-details').data('id')},
        dataType: 'JSON',
        success: function (e) {
            console.log('a');
            console.log('a', e);
            $('#animal-details').find('.captcha').remove();
            $('#animal-details').find('.phone-placeholder').text(e);
        },
        error: function (e) {
            console.log('error', e);
        }
    });
};

window.attachSearchBox = function () {

    $('#searchForm').on('submit', function (e) {

        e.preventDefault();

        let $form = $(this);

        let status = $form.find('select[name="status"]').val(),
            species = $form.find('select[name="species"]').val(),
            lat = $form.find('input[name="lat"]').val(),
            lng = $form.find('input[name="lng"]').val(),
            place = $form.find('input[name="placeName"]').val(),
            distance = $form.find('select[name="distance"]').val(),
            words = $form.find('input[name="words"]').val();

        let request = {
            status: status,
            species: species,
            lat: lat,
            lng: lng,
            place: place,
            distance: distance,
            words: words
        };

        let jsonRequest = JSON.stringify(request);
        let base64Request = Base64.encode(jsonRequest);

        window.location.href = baseUrl + '/zaginione-znalezione/' + base64Request;

    })
};

window.onAnimalStatusChange = function () {
    $('select[name="status"]').on('change', function (e) {
        if ($(e.target).val() === "FOUND") {
            $('input[name="name"]').val('Nieznane');
        } else {
            $('input[name="name"]').val('').focus();
        }
    });
};

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

window.acceptCookies = function () {
    setCookie('sarzcookies', 'accept', 365);
    $('#cookies').remove();
};

$(document).ready(() => {

    if(!getCookie('sarzcookies')) {
        $('#cookies').fadeIn(200);
    }

    if (window.location.hash === '#_=_') {
        history.replaceState
            ? history.replaceState(null, null, window.location.href.split('#')[0])
            : window.location.hash = '';
    }

    $('.facebook-share-btn').on('click', (e) => {

        e.preventDefault();

        FB.ui({
            method: 'share',
            mobile_iframe: true,
            href: $(e.target).data('href'),
        }, function (response) {
        });

    });

    let $navbar = $('.navbar'),
        didScroll = false,
        lastScrollTop = 0,
        delta = 5,
        navbarHeight = $navbar.outerHeight() + 2;

    $(window).scroll(function (event) {
        didScroll = true;
    });

    $('.close-toaster').on('click', function (e) {
        $(e.target).parent().parent().parent().hide();
    });

    setInterval(function () {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 10);

    function hasScrolled() {
        let st = $(this).scrollTop();

        // Make sure they scroll more than delta
        if (Math.abs(lastScrollTop - st) <= delta)
            return;

        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > lastScrollTop && st > navbarHeight) {
            // Scroll Down
            $navbar.removeClass('nav-down').addClass('nav-up');
        } else {
            // Scroll Up
            if (st + $(window).height() < $(document).height()) {
                $navbar.removeClass('nav-up').addClass('nav-down');
            }
        }

        lastScrollTop = st;
    }

});

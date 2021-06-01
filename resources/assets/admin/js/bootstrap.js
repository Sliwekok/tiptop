window._ = require('lodash');
window.Popper = require('popper.js').default;

try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
    window.moment = require('moment');
    moment.locale('pl');
    window.Base64 = require('js-base64').Base64;
    require('@fortawesome/fontawesome');
    require('@fortawesome/fontawesome-free-solid');
    require('@fortawesome/fontawesome-free-regular');
    require('@fortawesome/fontawesome-free-brands');

} catch (e) {}

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
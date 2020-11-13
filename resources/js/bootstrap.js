window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

//jquery
window.$ = window.jQuery = require('jquery');
window.bootstrap = require('bootstrap');
window.jQueryValidation = require('jquery-validation');

//popper.js
window.popperJS = require('popper.js');
//bootbox
window.bootbox = require('bootbox');
//moment
window.moment = require('moment');
//jquery.inputmask
//window.jQueryInputMask = require('jquery.inputmask');
//jquery-easy-loading
window.jQueryEasyLoading = require('jquery-easy-loading');
//bootstrap-validator
window.bootstrapValidator = require('bootstrap-validator');
//@fortawesome/fontawesome-free
window.fontAwesome = require('@fortawesome/fontawesome-free');
//adminLTE
window.adminLTE = require('admin-lte');

//datatables
window.dataTables = require('datatables.net');
//datatablesBS4
window.dataTablesBS4 = require('datatables.net-bs4');
//datatablesResponsive
window.dataTablesResponsive = require('datatables.net-responsive');
//datatablesResponsiveBS4
window.dataTablesResponsiveBS4 = require('datatables.net-responsive-bs4');

//select2
window.select2 = require('select2');
//$.fn.select2.defaults.set( "theme", "bootstrap4" );
$.fn.select2.defaults.set( "theme", "bootstrap" );

//sweetalert
window.sweetalert = require('sweetalert');

//bootbox
window.bootbox = require('bootbox');

//daterangepicker
window.daterangepicker = require('daterangepicker');

//bootstrap-datepicker
window.bootstrapDatepicker = require('bootstrap-datepicker');
var datepicker = $.fn.datepicker.noConflict();
$.fn.bootstrapDatepicker = datepicker;

//toastr
window.toastr = require('toastr');

//jquerySoap
window.jquerySoap = require('jquery.soap');
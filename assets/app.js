/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

//Jquery
const $ = require('jquery');
global.$ = $;
global.jQuery = $;

//Jquery Easing
require('startbootstrap-sb-admin-2/vendor/jquery-easing/jquery.easing.min');

//Bootstrap
require('bootstrap');

//Fontawesome
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

// Template SBAdmin2
import './styles/app.scss';
require('./js/sidebar');


// start the Stimulus application
import './bootstrap';

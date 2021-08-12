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

//Bootstrap
require('bootstrap');

//Fontawesome
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

// Template SBAdmin2
import './styles/app.scss';
require('startbootstrap-sb-admin-2/js/sb-admin-2.min');


// start the Stimulus application
// import './bootstrap';

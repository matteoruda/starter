/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

//Jquery
const $ = require('jquery');
global.$ = global.jQuery = $;

//Bootstrap
require('bootstrap');

//Fontawesome
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

//Datatables
require('datatables.net-bs/js/dataTables.bootstrap');
require('datatables.net-buttons-bs4/js/buttons.bootstrap4.min');
import 'datatables.net-bs/css/dataTables.bootstrap.css';
import 'datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css';

//Chart.js
require('./js/demo/chart-area-demo')

// Template SBAdmin2
import './styles/app.scss';
require('./js/sb-admin-2');


// start the Stimulus application
// import './bootstrap';

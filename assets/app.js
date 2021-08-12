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
require('datatables.net-bs4/js/dataTables.bootstrap4.min');
require('datatables.net-buttons-bs4/js/buttons.bootstrap4.min');
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import 'datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css';

const datatableTranslation = require('./json/datatableItalian.json');
window.datatableTranslation = datatableTranslation;


//Chart.js
// require('chart.js/dist/Chart.min')
const chart = require('startbootstrap-sb-admin-2/vendor/chart.js/Chart.min');
global.Chart = Chart;

require('startbootstrap-sb-admin-2/js/demo/chart-area-demo')
require('startbootstrap-sb-admin-2/js/demo/chart-pie-demo')

// Template SBAdmin2
import './styles/app.scss';
require('startbootstrap-sb-admin-2/js/sb-admin-2.min');



// start the Stimulus application
// import './bootstrap';

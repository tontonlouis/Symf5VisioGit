import $ from 'jquery';
import Places from 'places.js';
import Map from './modules/map';
import 'select2';

Map.init();

let inputAdress = document.querySelector('#property_address');

if(inputAdress !== null){
    let place = Places({
        container: inputAdress
    });

    place.on('change', e => {
        inputAdress.value = e.suggestion.name
        document.querySelector('#property_city').value = e.suggestion.city
        document.querySelector('#property_postalCode').value = e.suggestion.postcode
        document.querySelector('#property_lat').value = e.suggestion.latlng.lat
        document.querySelector('#property_lng').value = e.suggestion.latlng.lng
    });
}

$('#contactButton').click( e => {
    e.preventDefault();
    $('#contactForm').slideDown();
    $('#contactButton').slideUp();
});

$('select').select2();
$('.carousel').carousel('cycle');

console.log('Hello Webpack Encore! Edit me in assPets/js/app.js');

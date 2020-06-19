import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export default class Map{

    static init(){
        let map = document.querySelector('#map');
        let lat = map.dataset.lat;
        let lng = map.dataset.lng;
        map = L.map(map).setView([lat, lng], 13);

        let icon = L.icon({
            iconUrl: '/images/marker-icon.png'
        });

        let token = 'pk.eyJ1IjoidG9udG9ubG91aXM1OSIsImEiOiJja2JtMWl6dm8wNjRvMnVwNzFpaHFtMzBzIn0.CFzVhypkYUd66C2r96Rgsw'

        L.tileLayer(`https://api.mapbox.com/v4/mapbox.streets/{z}/{x}/{y}.png?access_token=${token}`, {
            maxZoom: 18,
            minZoom: 12,
            attribution: '© <a href="https://www.mapbox.com/about/maps/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> <strong><a href="https://www.mapbox.com/map-feedback/" target="_blank">Improve this map</a></strong>'
        }).addTo(map)
        // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        // }).addTo(map);

        L.marker([lat, lng], {icon: icon}).addTo(map)

    }
}
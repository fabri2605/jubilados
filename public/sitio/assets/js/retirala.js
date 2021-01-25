_load_map = false;
_lat = null;
_lng = null;
_map = null;
_marker = null;

function basicmap() {
    var mapOptions = {
        zoom: 12,
        scrollwheel: false,
        center: new google.maps.LatLng(_lat, _lng), 
        mapTypeControl: false,
        styles: [
                {
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#d3d3d3"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "stylers": [
                        {
                            "color": "#808080"
                        },
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#b3b3b3"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#ffffff"
                        },
                        {
                            "weight": 1.8
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#d7d7d7"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#ebebeb"
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#a7a7a7"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#efefef"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#696969"
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#737373"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#d6d6d6"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {},
                {
                    "featureType": "poi",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#dadada"
                        }
                    ]
                }
            ]

    };
    var mapElement = document.getElementById('map');
    _map = new google.maps.Map(mapElement, mapOptions);

    _marker = new google.maps.Marker({
        position: new google.maps.LatLng(_lat, _lng),
        map: _map,
    });

    //Casa de Gobierno 
    const infowindow = new google.maps.InfoWindow({
        content: "Ventanilla Única (Casa de Gobierno). Lunes a Viernes de 09 a 15hs."
      });

    let cg = new google.maps.Marker({
        position: new google.maps.LatLng(-32.8982778, -68.84636111111111),
        map: _map,
        title: "Ventanilla Única (Casa de Gobierno). Lunes a Viernes de 09 a 15hs."
    });

    cg.addListener("click", () => {
        infowindow.open(_map, cg);
    });

    //Grupo 100 (STM) 
    new google.maps.Marker({
        position: new google.maps.LatLng(-32.873294, -68.844357),
        map: _map,
        title: "Grupo 100 (STM). Lunes a Viernes de 09 a 13hs."
    });

    

    //Centro Atención en Perú y Rivadavia
    new google.maps.Marker({
        position: new google.maps.LatLng(-32.8902222, -68.84855555555555),
        map: _map,
        title: "Centro Atención en Perú y Rivadavia. Lunes a Viernes de 09 a 16hs. Sábado de 09 a 12hs"
    });

     //Grupo 200 
     new google.maps.Marker({
        position: new google.maps.LatLng(-32.93036, -68.746273),
        map: _map,
        title: "Grupo 200. Lunes a Viernes de 09 a 16hs. Sábados de 09 a 11hs"
    });

    //Grupo 300 
    new google.maps.Marker({
        position: new google.maps.LatLng(-32.965223, -68.841457),
        map: _map,
        title: "Grupo 200. Lunes a Viernes de 08 a 16hs. Sábados de 09 a 11hs"
    });

    //Grupo 400 
    new google.maps.Marker({
        position: new google.maps.LatLng(-32.941877, -68.841679),
        map: _map,
        title: "Grupo 400. Lunes a Viernes de 08 a 16hs. Sábados de 09 a 12hs"
    });

    //Grupo 700 
    new google.maps.Marker({
        position: new google.maps.LatLng(-32.968331, -68.849333),
        map: _map,
        title: "Grupo 700. Lunes a Viernes de 08 a 14hs. Sábados de 09 a 11hs"
    });


    //Grupo 800 
    new google.maps.Marker({
        position: new google.maps.LatLng(-32.985306, -68.782394),
        map: _map,
        title: "Grupo 800. Lunes a Viernes de 09 a 16hs. Sábados de 09 a 11hs"
    });

    //Grupo 900 
    new google.maps.Marker({
        position: new google.maps.LatLng(-32.983628, -68.783356),
        map: _map,
        title: "Grupo 900 (calle Perón). Lunes a Viernes de 08 a 15hs"
    });

    //Grupo 900 
    new google.maps.Marker({
        position: new google.maps.LatLng(-32.916991, -68.771449),
        map: _map,
        title: "Grupo 900 (calle Castro). Lunes a Viernes de 09 a 12hs. Sábados de 09 a 12hs"
    });

    //Grupo Terminal de Omnibus 1 Piso (ala oeste). Lunes a Viernes de 09 a 17hs 
    new google.maps.Marker({
        position: new google.maps.LatLng(-32.89525, -68.83111111111111),
        map: _map,
        title: "Grupo Terminal de Omnibus 1 Piso (ala oeste). Lunes a Viernes de 09 a 17hs "
    });

    _map.setCenter(new google.maps.LatLng(_lat, _lng));
}
function initMap(lat,lng){
    _lat = -32.890655;
    _lng = -68.8440078;
    if(!_load_map){
        _load_map = true;
       basicmap();
    }else{
        
    }
}
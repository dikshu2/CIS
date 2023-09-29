<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<?php include('includes/header.php');?>
<?php
 include_once 'header1.php';
include 'location_model.php';

?>

<?php include('includes/signup.php');?>			
<!-- //signu -->
<!-- signin -->
<?php include('includes/signin.php');?>			
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php');?>

<style>

/* input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
} */

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

/* input[type=submit]:hover {
    background-color: #45a049;
} */

/* .container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    margin-left: 20%;
    width:50%
} */
#map { position:absolute;right: 350px; top:350px; bottom:0px;height:550px ;width:660px; }
/* .geocoder {
    position:absolute;right: 350px; top:0px;
} */
.geocoder {
            height: 100px;
            width: 150px;
            position: absolute;
            top: 20px;
            right:10px;
            background-color: rgba(255, 255, 255, .9);
            padding: 15px;
            text-align: right;
            font-family: 'Arial';
            margin: 0;
            font-size: 13px;
        }
        
        #instructions {
            position: absolute;
            height: 300px;
            margin: 20px;
            width: 25%;
            center:5;
            bottom: 0;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            overflow-y: scroll;
            font-family: sans-serif;
        }
</style>
     
    <!DOCTYPE HTML>
<html>
<head>
<title>CIS | City Information System</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Tourism Management System In PHP" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/about.css" rel="stylesheet">
<!-- <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />  -->

      <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.css' rel='stylesheet' /> 

    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />
     
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.0.0/mapbox-gl-draw.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.0.0/mapbox-gl-draw.css' type='text/css' />
     

     <!-- <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>  -->
     
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
</head>

<br>
<body>
 
<br> <br>
    <!-- <div class="container">
        <form action="" id="signupForm">
            
        <label for="lat">lat</label>
            <input type="text" id="lat" name="lat" placeholder="Your lat..">

            <label for="lng">lng</label>
            <input type="text" id="lng" name="lng" placeholder="Your lng.."><br>
             <input type="submit" value="Submit" > 
        </form>
    </div>
    -->
    <div class="geocoder">   
    </div> 
    <div id="geocoder" ></div> 
<br>
    <div id="map"></div>

    <div id='instructions'>
        <div id="calculated-line"></div>
    </div>
    

    <script>
//28.3949,84.1240
//77.216721,28.644800
        var saved_markers = <?= get_saved_locations() ?>;
        var user_location = [28.3949, 84.1240];
        //27.686386, 83.432426-Butwal
        mapboxgl.accessToken = 'pk.eyJ1IjoiZGlrc2hpdGEiLCJhIjoiY2xqczF6Z3EyMGhsZzNkdnNjZHJuNTZpeSJ9.6FQ1562dFyDz_2RbwcfNaA';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v9',
            center: user_location,
            zoom: 10
        });
        //  geocoder here
        var geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
        });

        var marker ;
        map.on('load', function() {
            addMarker(user_location,'load');
            add_markers(saved_markers);

        
            geocoder.on('result', function(ev) {
                alert("aaaaa");
                console.log(ev.result.center);

            });
        });
        map.on('click', function (e) {
            marker.remove();
            addMarker(e.lngLat,'click');
            //console.log(e.lngLat.lat);
            document.getElementById("lat").value = e.lngLat.lat;
            document.getElementById("lng").value = e.lngLat.lng;

        });

        function addMarker(ltlng,event) {

            if(event === 'click'){
                user_location = ltlng;
            }
            marker = new mapboxgl.Marker({draggable: true,color:"#d02922"})
                .setLngLat(user_location)
                .addTo(map)
                .on('dragend', onDragEnd);
        }
        function add_markers(coordinates) {

            var geojson = (saved_markers == coordinates ? saved_markers : '');

            console.log(geojson);
            // add markers to map
            geojson.forEach(function (marker) {
                console.log(marker);
                // make a marker for each feature and add to the map
                new mapboxgl.Marker()
                    .setLngLat(marker)
                    .addTo(map);
            });

        }

        function onDragEnd() {
            var lngLat = marker.getLngLat();
            document.getElementById("lat").value = lngLat.lat;
            document.getElementById("lng").value = lngLat.lng;
            console.log('lng: ' + lngLat.lng + '<br />lat: ' + lngLat.lat);
        }

        $('#signupForm').submit(function(event){
            event.preventDefault();
            var lat = $('#lat').val();
            var lng = $('#lng').val();
            var url = '/tms/tms/locations_model.php?add_location&lat=' + lat + '&lng=' + lng;
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data){
                    alert(data);
                    location.reload();
                }
            });
        });

        document.getElementById('geocoder').appendChild(geocoder.onAdd(map));



        var draw = new MapboxDraw({
            displayControlsDefault: false,
            controls: {
                line_string: true,
                trash: true
            },
            styles: [
                // ACTIVE (being drawn)
                // line stroke
                {
                    "id": "gl-draw-line",
                    "type": "line",
                    "filter": ["all", ["==", "$type", "LineString"],
                        ["!=", "mode", "static"]
                    ],
                    "layout": {
                        "line-cap": "round",
                        "line-join": "round"
                    },
                    "paint": {
                        "line-color": "#3b9ddd",
                        "line-dasharray": [0.2, 2],
                        "line-width": 4,
                        "line-opacity": 0.7
                    }
                },
                // vertex point halos
                {
                    "id": "gl-draw-polygon-and-line-vertex-halo-active",
                    "type": "circle",
                    "filter": ["all", ["==", "meta", "vertex"],
                        ["==", "$type", "Point"],
                        ["!=", "mode", "static"]
                    ],
                    "paint": {
                        "circle-radius": 10,
                        "circle-color": "#FFF"
                    }
                },
                // vertex points
                {
                    "id": "gl-draw-polygon-and-line-vertex-active",
                    "type": "circle",
                    "filter": ["all", ["==", "meta", "vertex"],
                        ["==", "$type", "Point"],
                        ["!=", "mode", "static"]
                    ],
                    "paint": {
                        "circle-radius": 6,
                        "circle-color": "#3b9ddd",
                    }
                },
            ]
        });
        // add the draw tool to the map
        map.addControl(draw);

        // add create, update, or delete actions
        map.on('draw.create', updateRoute);
        map.on('draw.update', updateRoute);
        map.on('draw.delete', removeRoute);

        // use the coordinates you just drew to make your directions request
        function updateRoute() {
            removeRoute(); // overwrite any existing layers
            var data = draw.getAll();
            var lastFeature = data.features.length - 1;
            var coords = data.features[lastFeature].geometry.coordinates;
            var newCoords = coords.join(';');
            getMatch(newCoords);
        }

        // make a directions request
        function getMatch(e) {
            var url = 'https://api.mapbox.com/directions/v5/mapbox/cycling/' + e +
                '?geometries=geojson&steps=true&access_token=' + mapboxgl.accessToken;
            var req = new XMLHttpRequest();
            req.responseType = 'json';
            req.open('GET', url, true);
            req.onload = function() {
                var jsonResponse = req.response;
                var distance = jsonResponse.routes[0].distance * 0.001;
                var duration = jsonResponse.routes[0].duration / 60;
                var steps = jsonResponse.routes[0].legs[0].steps;
                var coords = jsonResponse.routes[0].geometry;
                //  console.log(steps);
                console.log(coords);
                //  console.log(distance);
                // console.log(duration);

                // get route directions on load map
                steps.forEach(function(step) {
                    instructions.insertAdjacentHTML('beforeend', '<p>' + step.maneuver.instruction + '</p>');
                });
                // get distance and duration
                instructions.insertAdjacentHTML('beforeend', '<p>' + 'Distance: ' + distance.toFixed(2) + ' km<br>Duration: ' + duration.toFixed(2) + ' minutes' + '</p>');

                // add the route to the map
                addRoute(coords);
                //  console.log(coordinates);

            };
            req.send();
        }

        // adds the route as a layer on the map
        function addRoute(coords) {
            // check if the route is already loaded
            if (map.getSource('route')) {
                map.removeLayer('route');
                map.removeSource('route')
            } else {
                map.addLayer({
                    "id": "route",
                    "type": "line",
                    "source": {
                        "type": "geojson",
                        "data": {
                            "type": "Feature",
                            "properties": {},
                            "geometry": coords
                        }
                    },
                    "layout": {
                        "line-join": "round",
                        "line-cap": "round"
                    },
                    "paint": {
                        "line-color": "#1db7dd",
                        "line-width": 8,
                        "line-opacity": 0.8
                    }
                });
            };
        }

        // remove the layer if it exists
        function removeRoute() {
            if (map.getSource('route')) {
                map.removeLayer('route');
                map.removeSource('route');
                instructions.innerHTML = '';
            } else {
                return;
            }
        }
        // document.getElementById('geocoder').appendChild(geocoder.onAdd(map));

    </script>

</body>
</html>
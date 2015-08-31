<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            margin: 0;
            padding: 10px 20px 20px;
            font-family: Arial;
            font-size: 16px;
        }
        #map-container {
            padding: 6px;
            border-width: 1px;
            border-style: solid;
            border-color: #ccc #ccc #999 #ccc;
            -webkit-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
            -moz-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
            box-shadow: rgba(64, 64, 64, 0.1) 0 2px 5px;
            width: 1200px;
        }
        #map {
            width: 1200px;
            height: 800px;
        }
    </style>

    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="data.json"></script>
    <script type="text/javascript" src="src/markerclusterer.js"></script>


    <script>
        function initialize() {
            var center = new google.maps.LatLng(50, 50);
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 3,
                center: center,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var markers = [];
            for (var c = 0; c < 1; c++) { //multiplier
                for (var i = 0; i < 10000; i++) {
                    var pointData = data[i];
                    var latLng = new google.maps.LatLng(pointData.latitude, pointData.longitude);
                    var marker = new google.maps.Marker({
                        position: latLng
                    });
                    markers.push(marker);
                }
            }
            console.log(i + " real points on map")
            function cdnCalc(data){
                console.log(data)
            }
            var mcOptions = {
                zoomOnClick: false,
                minimumClusterSize: 1
            };
            var markerCluster = new MarkerClusterer(map, markers, mcOptions);
//            markerCluster.setCalculator(cdnCalc(data))
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

</head>
<body>


<div id="map-container">
    <div id="map"></div>
</div>
</body>
</html>
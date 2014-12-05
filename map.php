<?php
    include("circle.php");
    
    $lat = 12.582243;
    $long = -6.132813;
    
    $distance = 100000;
    $segments = 12;
    
    $circle = new PointCircle();
    $result = $circle->buildCircle($segments,$lat,$long,$distance);
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            html, body, #map-canvas {
                height: 100%;
                margin: 0px;
                padding: 0px
            }
        </style>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
        <script>
            function initialize() {
                var mapOptions = {
                    zoom: 12,
                    center: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>)
                }
                var map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
                    var marker<?php echo $key; ?> = new google.maps.Marker({
                        position: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>),
                        map: map
                    });
                    
                <?php foreach ($result as $key => $points) { ?>
                    var marker<?php echo $key; ?> = new google.maps.Marker({
                        position: new google.maps.LatLng(<?php echo $points[0]; ?>, <?php echo $points[1]; ?>),
                        map: map
                    });
                <?php } ?>
            }

            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
    </head>
    <body>
        <div id="map-canvas"></div>
    </body>
</html>
<?php
/**
 * Get Circle of Points from Central Coordinates
 * 
 * @author Christopher Darby
 * @version 0.1
 * 
 */

class PointCircle {

    public function destPnt($lat, $long, $bearing, $distance) {
        $metres = $distance / 3.2808399; // Distance in Metres
        $distance = $metres / 1000; // Distance in Kilometres
        
        $rad = 6371; // Mean Radius of the Earth
        
        $distance = $distance / $rad;  // Convert Distance to Angular Distance In Radians
        $bearing = deg2rad($bearing);  // Convert Bearings to Radians
        
        $lat_source = deg2rad($lat);
        $long_source = deg2rad($long);

        $lat_dest = asin(sin($lat_source) * cos($distance) + cos($lat_source) * sin($distance) * cos($bearing));
        
        $long_dest = $long_source + atan2(sin($bearing) * sin($distance) * cos($lat_source), cos($distance) - sin($lat_source) * sin($lat_dest));
        $long_dest = fmod($long_dest + 3 * M_PI, 2 * M_PI) - M_PI;
        
        $lat_dest = rad2deg($lat_dest);
        $long_dest = rad2deg($long_dest);

        return Array($lat_dest, $long_dest);
    }

    public function pointsArray($total) {
        $array = Array();
        $degrees = 360 / $total;
        $next = 0;
        
        for ($i = 0; $i < $total; $i++) {
            $array[] = $next;
            $next = $next + $degrees;
        }
        
        return $array;
    }
    
    public function buildCircle($i,$lat,$long,$distanceance) {
        $array = $this->pointsArray($i);
        $result = Array();
        
        foreach($array as $bearing) {
            $sub = $this->destPnt($lat, $long, $bearing, $distanceance);
            $result[$bearing] = $sub;
        }
        
        return $result;
    }
}



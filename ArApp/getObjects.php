<?php
    include('db.php');

    $lat = $_REQUEST["lat"];
    $lon = $_REQUEST["lon"];

    

    $dist = 0.5;
    $latlow = $lat-$dist;
    $latup = $lat+$dist;

    $lonlow = $lon-$dist;
    $lonup = $lon+$dist;

    // select all objects that are within the latitude and longitude radius
    $sql = "SELECT o.*, l.* FROM objects o JOIN locations l ON o.object_id = l.object_id WHERE (l.latitude > ? AND l.latitude < ?) AND (l.longitude > ? AND l.longitude < ?)";

    $sqlprep = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($sqlprep, "dddd", $latlow, $latup, $lonlow, $lonup);
    mysqli_stmt_execute($sqlprep);
    $result = mysqli_stmt_get_result($sqlprep);

    $d = array();

    while ($row = mysqli_fetch_assoc($result)) {
        
        $d[] = array(
            'location_id' => $row['location_id'], 
            'object_id' => $row['object_id'], 
            'lat' => $row['latitude'], 
            'lon' => $row['longitude'],
            'alt' => $row['altitude'],
            'title' => $row['title'],
            'shortdesc' => $row['short_description'],
            'longdesc' => $row['long_description'],
            'model' => base64_encode($row['3d_object']),
            'image' => base64_encode($row['image'])
            );
    }

    echo json_encode(array('data' => $d));
?>
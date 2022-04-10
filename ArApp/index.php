<?php
    include('session.php');


    
?>




<html>
<head>
        <script src="https://aframe.io/releases/1.0.3/aframe.min.js"></script>
        <script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="./js/gpshandling.js"></script>
        
    </head>
    
    <body style="overflow: hidden;">
        <a-scene cursor='rayOrigin: mouse; fuse: true; fuseTimeout: 0;'
        raycaster="objects: [clickable];" id="scene" vr-mode-ui="enabled: false" embedded arjs="sourceType: webcam; debugUIEnabled: false;">
        <a-camera id="camera" gps-camera rotation-reader position-reader></a-camera>
        
        </a-scene>
        <span id="dataspan" style="top: 0; left: 0; position: absolute"></span>
        <div style="bottom: 10; left: 10; position: absolute;" id="selected-object-card">
            
        </div>
    </body>
</html>
<script>
    AOS.init();
</script>





var loadedObjectsJson;


// get the GPS position of the user then send it to the server, wait for the server to return a json list of objects
// within a specific radius of the user, once returned, add the objects to the scene
AFRAME.registerComponent('position-reader', {
    init: function () {
        window.addEventListener('gps-camera-update-position', e => {
            $('#dataspan').html("lat="+e.detail.position.latitude + "&lon=" + e.detail.position.longitude)

            //alert("location update");
            $.ajax ( {
                type: 'POST',
                url: './getObjects.php',
                data: "lat="+e.detail.position.latitude + "&lon=" + e.detail.position.longitude,
                
                success: function(response)
                {
                    var jsonData = JSON.parse(response);
                    //alert(JSON.stringify(jsonData.data[0]));
                    addObjects(jsonData);
                },
                error: function() {
                    alert('There was some error performing the AJAX call!');
                  }
            });

        });
  }});



// check for clicks on markers, 
// when a click is detected, populate the info div with the html template from long_description
// this is quite useful because using a template allows different content to be embedded for different locations
// it also lets me be lazy and now write loads of HTML or js to generate the content in the first place,
// getting a reusable frontend working lets me slowly populate the databse with more data, safe in the knwoledge that it will all work
const clickListener = function (ev) {
    ev.stopPropagation();
    ev.preventDefault();
    //alert("click");

    const el = ev.detail.intersection && ev.detail.intersection.object.el;

    if (el && el === ev.target) {
        console.log(ev.target.getAttribute('id'))
        $('#selected-object-card').html(
            loadedObjectsJson.data[ev.target.getAttribute('id')].longdesc
            
        )
     }
 };


// add an objects from the json returned from the database, each object is a clickable marker that will bring up a custom HTML template defined in
// long_description in the database, the title and short description will display next to the marker
//
// the scene must first be cleared to prevent duplicate markers being shown
function addObjects(objJson) {
    loadedObjectsJson = objJson;
    var scene = $('#scene');
    for (elem of document.getElementsByClassName("obj")) {
        elem.classList.remove("obj");
    }
    for (var i in objJson.data) {
        // remember to change position and replace it with gps-entity-place, position is only here for testing!
        scene.append(
            "<a-link id='" + i + "' look-at='#camera' class='obj'  material='color: red' clickable gps-entity-place='latitude: " + objJson.data[i].lat + "; longitude: " + objJson.data[i].lon + "' position='0 " + objJson.data[i].alt + " 0'>" +
            "<a-text value='" + objJson.data[i].title + "' look-at='#camera' position='1 0.25 0' scale='2 2 2 '></a-text>" +
            "<a-text value='" + objJson.data[i].shortdesc + "' look-at='#camera' position='1 -0.125 0' scale='1 1 1'></a-text>" +
            "</a-link>"
        )
        document.getElementById(i).addEventListener('click', clickListener);
    }

    

}

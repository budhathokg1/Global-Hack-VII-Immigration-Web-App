<?php

        $hostLatitude = 38.562579;
        $hostLongitude = -84.401139; //union ky
        $migrantLatitude = 39.14300;
        $migrantLongitude = -84.203060;//montgomery
        $centerLatitude = ($hostLatitude + $migrantLatitude) /2;
        $centerLongitude = ($hostLongitude + $migrantLongitude)/ 2;
    ?>
<!DOCTYPE html>
<html>
<head>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
	</script><!-- Latest compiled and minified CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"><!-- Latest compiled and minified JavaScript -->

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
	</script>
	<title></title>
</head>
<body>
	<div class="container map-container">
		<div class="row">
			<div class="col-md-6" id="googleMap" style="height: 400px;"></div>
			<script>
                 function initMap()
                 {
                     var hostLocation = {lat: <?php echo $hostLatitude; ?>,lng: <?php echo $hostLongitude; ?>};
                     var migrantLocation =  {lat: <?php echo $migrantLatitude; ?>,lng: <?php echo $migrantLongitude; ?>};
                     var centerLocation = {lat: <?php echo $centerLatitude; ?>,lng: <?php echo $centerLongitude; ?>};
                     var map = new google.maps.Map(document.getElementById("googleMap"), {zoom: 4, center: centerLocation});
                     var markerCenter = new google.maps.Marker({position: centerLocation, map: map});
                     var markerHost = new google.maps.Marker({position: hostLocation, map: map});
                     var markerMigrant = new google.maps.Marker({position: migrantLocation, map: map});
                     
                     
                     //place predictions
                     
                      var activity = 'climbing';
                    var location = 'Ohio';
        var displaySuggestions = function(predictions, status) {
          if (status != google.maps.places.PlacesServiceStatus.OK) {
            alert(status);
            return;
          }

          predictions.forEach(function(prediction) {
            var divcard= document.createElement('div');
            divcard.setAttribute("class", "card");
              var divcardbody = document.createElement('div');
              divcardbody.setAttribute("class","card-body");
              divcardbody.appendChild(document.createTextNode(prediction.description));
            divcard.appendChild(divcardbody);
              document.getElementById("results").appendChild(divcard);
          });
        };

        var service = new google.maps.places.AutocompleteService();
        service.getPlacePredictions({ input: activity }, displaySuggestions);
      
                 }
			</script> 
			 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhc-gJsL4DOC6hA4DUW-uZGLCR_vPDkSk&libraries=places&callback=initMap"
        async defer></script>

			<div class="col-md-6 info" id = "results">
				
			</div>
		</div>
	</div>
</body>
</html>
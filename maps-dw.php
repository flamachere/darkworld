<?php
    // ouverture de la base de données
    $db = new mysqli("localhost", "root", "99ycapz!", "darkworld");
    // query sur les Icones
    $rdb = $db->query("SELECT * FROM icon;");

    // création des marqueurs
    foreach ($result as $row) {
      $row = $rdb->fetch_assoc();
      $iconBlock = $iconBlock + "var i".$row['type'].$row['nom']." = L.icon({ iconURL: 'img/".$row['type']."/".$row['nom'].".png, iconSize: [55.84], popupAnchor: [-3, -76]});"."\n";
    };
    echo $iconBlock;

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cartes du DarkWorld</title>
    	<meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.13.2/themes/dark-hive/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="https://bootswatch.com/5/darkly/bootstrap.min.css" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" />
        <script src="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>
        <style>
            #map { height: 1080px; }
            #map1 { height: 1080px; }
        </style>
        <script>
            $(function() {
		// Icons
			//Generique
			var iCoDLieux = L.icon({ iconUrl: 'img/generique/Lieux.png', iconSize: [55,84], popupAnchor: [-3, -76]});

			//Vampires
			var iVampiresLieux = L.icon({ iconUrl: 'img/Vampire/lieux.png', iconSize: [55,84], popupAnchor: [-3, -76]});

			//Hunter
			var iHunterLieu = L.icon({ iconUrl: 'img/Hunter/lieux.png', iconSize: [55,84], popupAnchor: [-3, -76]});
			var iHunterMnemosis = L.icon({ iconUrl: 'img/Hunter/mnemosis.png', iconSize: [55, 84], popupAnchor: [-3,-76]});
			var iHunterSanctums = L.icon({ iconUrl: 'img/Hunter/sanctums.png', iconSize: [55, 84], popupAnchor: [-2,-76]});
			var iHunterInterets = L.icon({ iconUrl: 'img/Hunter/interets.png', iconSize: [55, 84], popupAnchor: [-2,-76]});
			var iHunterDangers = L.icon({ iconUrl: 'img/Hunter/dangers.png', iconSize: [55, 84], popupAnchor: [-2,-76]});

			//Mage
			var iMageSanctums = L.icon({ iconUrl: 'img/Mage/sanctums.png', iconSize: [55, 84], popupAnchor: [-2,-76]});

			//Geist

			//Werewolf
			var iWerewolfSanctums = L.icon({ iconUrl: 'img/Loup-garou/sanctums.png', iconSize: [55, 84], popupAnchor: [-2, -76]});


		// layers
                var divers = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'OpenStreetMap contributors'});
		var poi = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'OpenStreetMap contrinbutors'});
		var draws = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'OpenStreetMap contributors'});

                var circle = L.circle([42.51961, -70.8966], 550000, {
                    color: 'black',
                    fillcolor: '#EEE',
                    fillOpacity: 0.5
                }); 

		// Marqueurs
			// Villes ou Localisations
	                var mArkhaam = L.marker([42.77521, -71.07597], {icon: iCoDLieux, title: "Arkhaam" });

			// Batiments		
			var mAlexOThorn = L.marker([42.35376, -71.10536], {icon: iMageSanctums, title: "Tour d'Alexander O'Thorn" });
			var mOldRoses = L.marker([42.75864, -71.09977], {icon: iVampiresLieux, title: "The Old Roses"});		
			var mJacobLair = L.marker([44.91074, -123.04019], {icon: iMageSanctums, title: "Lieu de detention de Kyle"});
			var mAliceHome = L.marker([32.85072, -83.60053], {icon: iHunterSanctums, title: "Maison des parents d'Alice"});
			var mAliceHospital = L.marker([33.0518, -83.2211], {icon: iHunterDangers, title: "Central State Hospital"});
			var mErwenneReserve = L.marker([31.7602055, -88.1568515], {icon: iWerewolfSanctums, title: "Réserve de la Meute d'Erwenne"});
			var mErwenneHome = L.marker([31.756916, -88.089501], {icon: iWerewolfSanctums, title: "Maison d'Erwenne"});
			var mLieuxTeno = L.marker([19.2826595, -99.0615526], {icon: iHunterInterets, title: "Musée temporaire de Tenochtitlan"});

		// Groups 
		var cities = L.layerGroup([mArkhaam]);
		var poig = L.layerGroup([mAlexOThorn, mOldRoses]);
		var poib = L.layerGroup([mJacobLair, mAliceHome, mAliceHospital, mErwenneReserve, mErwenneHome, mLieuxTeno]);

		var map1 = L.map('map1', {center: [39.50, -98.35], zoom: 4, layers: [divers, cities, poig, poib]});

		// Layers
		var baseMaps = {
			"Carte Générale": divers
		};

		var overlayMaps = {
			"Points d'Interet Généraux": poig,
			"Points d'Interet Historique": poib,
			"Dessin / Zones": circle,
			"Villes": cities
		};

		// Layer Control
		var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(map1);
		
            });
        </script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">DarkWorld - Cartes</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                    <a class="nav-link active" href="#">Le Dôme
                      <span class="visually-hidden">(current)</span>
                    </a>
                  </li>
<!--                  <li class="nav-item">
                    <a class="nav-link" href="#">Arkhaam Centre</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Régions</a>
                  </li> -->
                  <li class="nav-item">
                    <a class="nav-link" href="https://www.twitch.tv/latelierdesreves" target="_blank">Twitch</a>
                  </li>
<!--                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Autres cartes</a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Separated link</a>
                    </div> 
                  </li>-->
                </ul>
                <form class="d-flex">
                  <input class="form-control me-sm-2" type="text" placeholder="Recherche">
                  <button class="btn btn-secondary my-2 my-sm-0" type="submit">Recherche</button>
                </form>
              </div>
            </div>
          </nav>
        <div id="map1"></div>
    </body>
</html>

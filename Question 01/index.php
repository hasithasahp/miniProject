<?php

  $apiHost = "covid-19-statistics.p.rapidapi.com";
  $apiKey = "fff3b7ba29msh26ec1452c3fe5c0p114e96jsn5e8277a7df64";

  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://covid-19-statistics.p.rapidapi.com/provinces?iso=CHN",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
      "x-rapidapi-host: ".$apiHost,
      "x-rapidapi-key: ".$apiKey
    ],
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $data = json_decode($response, true);
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Provinces in China</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      body {
          background-color: #f4f6f9;
      }
      h1 {
          color: #343a40;
      }
    </style>
  </head>
  <body>
    <div class="container my-5">
        <h1 class="text-center mb-4">China Provinces</h1>
        <div id="provinces" class="row justify-content-center">
          <?php if(isset($data['data'])):
                  foreach ($data['data'] as $province): ?>
          <div class="col-lg-4 col-md-6">
            <div class="card p-2 m-1">
              <h6 class="card-title"><?=$province['province']?></h6>
              <div class="card-text">Latitude: <?=$province['lat']?></div>
              <div class="card-text">Logitude: <?=$province['long']?></div>
            </div>
          </div>
          <?php   endforeach; ?>
          <?php  else: ?>
            <div class="alert alert-danger" role="alert">
              No data available
            </div>
          <?php endif; ?>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
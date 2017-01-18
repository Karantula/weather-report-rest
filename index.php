<?php

    $weather = "";

    $error = "";

    if(array_key_exists('city', $_GET)) {

      $city = str_replace(' ','', $_GET['city']);

      $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$city.",uk&appid=42a2e337b40ee0d09457b210d8247d7f");

      $weatherArray = json_decode($urlContents, true);

      $weather = "The weather in ".$city." is currently '".$weatherArray['weather']['0']['description']."'.";

      $tempInCelsius = intval($weatherArray['main']['temp'] - 273);

      $weather .= "<br>Current temperature is ".($tempInCelsius)."&deg;C";

      $windSpeed = $weatherArray['wind']['speed'];

      $weather .= ", wind speed of ".($windSpeed)."m/s.";

    }


 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Weather Scraper</title>

    <style type="text/css">

    html {
        background: url(background.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }

      body {

        background: none !important;

      }

      .container {

        text-align: center;
        margin-top: 100px;
        color: white;
        position: relative;
        width:50% !important;

      }

      #weather {

        margin-top: 20px;
      }




    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css"
      integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">



  </head>
  <body>

    <div class="container">

      <h1>What's the weather like today?</h1>

      <form>
        <div class="form-group">
          <label for="city">Enter a name of a city</label>
          <input type="text" class="form-control" name="city" id="city" placeholder="Eg. New York, Belgrade" value =

          "<?php

            if(array_key_exists('city', $_GET)) {

echo ($_GET['city']); }

          ?>">

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

      <div id="weather">

          <?php

            if ($weather) {

              echo '<div class="alert alert-success" role="alert">'.$weather.'
</div>';

            } else if ($error) {

              echo '<div class="alert alert-danger" role="alert">'.$error.'
</div>';

            }

           ?>

      </div>
    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
  </body>
</html>

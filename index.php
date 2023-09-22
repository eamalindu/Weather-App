<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Forecast App ⛅</title>
    <!--bootstrap CSS CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!--custom css-->
    <link rel="stylesheet" href="css/style.css">
    <!--boostrap JS CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <!--fontawesome CDN-->
    <script src="https://kit.fontawesome.com/07941f149f.js" crossorigin="anonymous"></script>
    <!-- jquery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body class="bg-black">
<div class="w-100 bg-dark text-white p-3">
    <h3><a href="">Weather Forecast App ⛅</a></h3>
</div>
<div class="container-fluid bg-light p-4">
    <form action="" method="post">
        <div class="input-group w-50 mx-auto p-2 search-box">
            <label class="form-label"></label>
            <input type="text" class="form-control" placeholder="Enter Your City" id="textCity" name="textCity" required>
            <button class="btn btn-success" type="submit" name="btnSearch" id="btnSearch">Search</button>
        </div>
    </form>
    <div class="row mt-2">
        <div class="col-lg-6 col-12 custom-div">
            <div class="card card-body bg-light">

                <?php
                error_reporting(E_ERROR | E_PARSE);
                if (isset($_POST["btnSearch"])) {


                    $apiKey = '37a8e98b6bfcebc78b2cc54978c4e311'; // Replace with your API key
                    $city = $_POST["textCity"]; // Replace with the city you want to fetch weather data for
                    $apiUrl = 'https://api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=' . $apiKey;

                    // Make the API request
                    $response = file_get_contents($apiUrl);
                    // Decode the JSON response
                    $data = json_decode($response, true);


                    if ($data == null) {
                        echo '<div class="card-body">';
                        echo '<div class="row">';
                        echo '<div class="col-12">';
                        echo '<h1 class="fw-bold text-capitalize" style="font-size: 25px;font-weight: 700">City <small class="text-muted">' . $city . '</small> Not Found!</h1>';
                        echo '</div>';
                        echo '<div class="col-lg-1 col-4">';
                        echo '<img src="https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/icons/logo_60x60.png" width="70px" height="70px">';
                        echo '</div>';
                        echo '<div class="col-lg-11 col-8 d-flex align-items-center">';
                        echo '<h1 class="fw-bold ms-4"></h1>';
                        echo '</div>';
                        echo '<p class="fw-bold text-capitalize">Please check if your city name is correct</p>';
                        echo '<table class="table table-bordered">';
                        echo '<tr>';
                        echo '<td class="w-25">Humidity 💧</td><td>n/a %</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>Pressure 🧭</td><td>n/a hPa</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>Wind Speed 💨</td><td>n/a m/s</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>Wind Direction ↗️</td><td>n/a °</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>Sunrise 🌅</td><td>n/a</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>Sunset 🌇</td><td>n/a</td>';
                        echo '</tr>';
                        echo '</table>';
                        echo '</div>';

                    } else {
                        // Get the weather information
                        $weather = $data['weather'][0];
                        $temperature = $data['main']['temp'];
                        $humidity = $data['main']['humidity'];
                        $pressure = $data['main']['pressure'];
                        $windSpeed = $data['wind']['speed'];
                        $windDirection = $data['wind']['deg'];
                        $country = $data['sys']['country'];
                        $feelsLike = $data['main']['feels_like'];
                        $icon = $data['weather'][0]['icon'];
                        $description = $data['weather'][0]['description'];
                        $sunrise = $data['sys']['sunrise'];
                        $sunset = $data['sys']['sunset'];
                        $timezone = $data['timezone'];

                        date_default_timezone_set("Asia/Colombo");

                        // Display the weather information
                        echo '<div class="card-body">';
                        echo '<div class="row">';
                        echo '<div class="col-12">';
                        echo '<h1 class="fw-bold text-capitalize" style="font-size: 25px;font-weight: 700">Weather in ' . $city . ', ' . $country . '</h1>';
                        echo '</div>';
                        echo '<div class="col-lg-1 col-4">';
                        echo '<img src="http://openweathermap.org/img/w/' . $icon . '.png" width="70px" height="70px">';
                        echo '</div>';
                        echo '<div class="col-lg-11 col-8 d-flex align-items-center">';
                        echo '<h1 class="fw-bold ms-4">' . intval($temperature - 273) . '°C</h1>';
                        echo '</div>';
                        echo '<p class="fw-bold text-capitalize">Feels Like: ' . intval($feelsLike - 273) . '°C. ' . $description . ' </p>';
                        echo '<table class="table table-bordered">';
                        echo '<tr>';
                        echo '<td>Humidity 💧</td><td>' . $humidity . '%</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>Pressure 🧭</td><td>' . $pressure . 'hPa</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>Wind Speed 💨</td><td>' . $windSpeed . 'm/s</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>Wind Direction ↗️</td><td>' . $windDirection . '°</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>Sunrise 🌅</td><td>' . date('h:i a (e)', $sunrise) . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td>Sunset 🌇</td><td>' . date('h:i a (e)', $sunset) . '</td>';
                        echo '</tr>';
                        echo '</table>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="card-body">';
                    echo '<div class="row">';
                    echo '<div class="col-12">';
                    echo '<h1 class="fw-bold text-capitalize" style="font-size: 25px;font-weight: 700">Weather in , </h1>';
                    echo '</div>';
                    echo '<div class="col-lg-1 col-4">';
                    echo '<img src="https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/icons/logo_60x60.png" width="70px" height="70px">';
                    echo '</div>';
                    echo '<div class="col-lg-11 col-8 d-flex align-items-center">';
                    echo '<h1 class="fw-bold ms-4">°C</h1>';
                    echo '</div>';
                    echo '<p class="fw-bold text-capitalize">Feels Like: °C. </p>';
                    echo '<table class="table table-bordered">';
                    echo '<tr>';
                    echo '<td class="w-25">Humidity 💧</td><td>n/a %</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Pressure 🧭</td><td>n/a hPa</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Wind Speed 💨</td><td>n/a m/s</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Wind Direction ↗️</td><td>n/a °</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Sunrise 🌅</td><td>n/a</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Sunset 🌇</td><td>n/a</td>';
                    echo '</tr>';
                    echo '</table>';
                    echo '</div>';
                }
                ?>


            </div>
        </div>
    </div>
    <div class="col-lg-6 col-12 custom-div">
        <div class="card card-body bg-light" style="height: 475px">
            <?php
            if (isset($_POST["btnSearch"])) {
                $city = $_POST["textCity"];
                echo '<iframe width="100%" style="border: none" height="400px" src="https://maps.google.com/maps?q=' . $city . '&output=embed"></iframe>';
                echo '<iframe width="100%" style="border: none" height="400px" src="https://en.wikipedia.org/wiki/' . $city . '"></iframe>';

            } else {
                echo '<iframe width="100%" style="border: none" height="400px" src="https://maps.google.com/maps?q=&output=embed"></iframe>';
                echo '<iframe width="100%" style="border: none" height="400px" src="https://en.wikipedia.org/wiki/"></iframe>';
            }
            ?>
        </div>
    </div>
</div>

</div>
<p class="text-center mt-3">Designed by: Malindu Prabodhitha</p>
</body>
</html>
<?php
$apiKey = 'b36bcb487fe43fd2f80ddf65e5264e0a'; 
$weatherData = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['city'])) {
    $cityName = urlencode(trim($_POST['city']));
    $url = "https://api.openweathermap.org/data/2.5/weather?q={$cityName}&appid={$apiKey}&units=metric";
    $response = file_get_contents($url);
    $weatherData = json_decode($response, true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        .search {
            text-align: center;
            margin-bottom: 20px;
        }
        .weather-info {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header>
        <h1>Weather App</h1>
        <p>Get real-time weather information using OpenWeatherMap API</p>
    </header>
    <main>
        <section class="search">
            <form method="POST">
                <input type="text" name="city" placeholder="Enter city name" required>
                <button type="submit">Search</button>
            </form>
        </section>
        <section class="weather-info">
            <?php if ($weatherData): ?>
                <?php if ($weatherData['cod'] == 200): ?>
                    <h2><?php echo htmlspecialchars($weatherData['name']); ?></h2>
                    <p>Temperature: <?php echo htmlspecialchars($weatherData['main']['temp']); ?> °C</p>
                    <p>Humidity: <?php echo htmlspecialchars($weatherData['main']['humidity']); ?>%</p>
                    <p>Condition: <?php echo htmlspecialchars($weatherData['weather'][0]['description']); ?></p>
                <?php else: ?>
                    <p><?php echo htmlspecialchars($weatherData['message']); ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>

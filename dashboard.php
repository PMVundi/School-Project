<?php
function fetchData($endpoint) {
    $url = "http://localhost:3000/$endpoint";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($curl);
    curl_close($curl);
    return json_decode($res, true);
}

$weather = fetchData("weather?location=Kenya");
$tip = fetchData("tips");
?>

<!DOCTYPE html>
<html>
<head>
    <title>AgriSure Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="dashboard">
    <h1>🌾 AgriSure Admin Dashboard</h1>

    <div class="card">
        <h2>🌤️ Weather Info</h2>
        <p>Temperature: <strong><?php echo $weather['temperature']; ?>°C</strong></p>
        <p>Condition: <strong><?php echo $weather['weather']; ?></strong></p>
    </div>

    <div class="card">
        <h2>📩 Farming Tip</h2>
        <p><?php echo $tip['tip']; ?></p>
    </div>
</div>
</body>
</html>

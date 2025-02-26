<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php-Hotel</title>
</head>

<body>
    <header class="header">
        <h1 class="title text-center">
            PHP Hotel
        </h1>
    </header>
    <main class="main my-5">
        <div class="container">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <!-- manual headers for using italian language -->
                        <th scope="col">Hotel</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col" class="text-center">Parcheggio</th>
                        <th scope="col">Voto</th>
                        <th scope="col">Distanza dal centro</th>
                    </tr>

                    <!-- dynamic headers using for each-->
                    <?php
                    // foreach ($hotels[0] as $key => $value) {
                    //     echo "<th scope='col text-center'>$key</th>";
                    // }
                    ?>
                </thead>
                <tbody>
                    <!-- hotels list data -->
                    <?php
                    //parking checkmark
                    $checkmark = "&#10003;";
                    $not_available = "&#10005;";

                    foreach ($hotels as $hotel) {

                        echo "<tr>";

                        foreach ($hotel as $key => $value) {
                            if ($key == 'parking') {
                                if ($value) {
                                    echo "<td class='text-success text-center fw-bold'>$checkmark</td>";
                                } else {
                                    echo "<td class='text-danger text-center fw-bold'>$not_available</td>";
                                }
                            } else {
                                echo "<td>$value</td>";
                            }
                        }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
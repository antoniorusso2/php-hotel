<?php

$not_found_message = "<div class='alert alert-danger'>Nessun hotel trovato</div>";

echo "live server enabled";

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

$filtered_hotels = &$hotels;

$filters = [
    'parking' => $_GET['parking'] ?? " ",
    'vote' => $_GET['vote'] ?? " ",
];


if ($filters['parking']) {
    //filter built in method
    $filtered_hotels = array_filter($hotels, fn($hotel) => $hotel['parking'] == $filters['parking']); //new array

} else if ($filters['parking'] == 0) {
    $filtered_hotels = array_filter($filtered_hotels, fn($hotel) => $hotel['parking'] == false);
} else {
    $filtered_hotels = $hotels;
}

if ($filters['vote']) {
    // foreach method
    foreach ($hotels as $key => $hotel) {
        if ($hotel['vote'] < $filters['vote']) {
            unset($hotels[$key]);
        }
    }
    $filtered_hotels = $hotels;

    //filter built in method
    // $filtered_hotels = array_filter($filtered_hotels, fn($hotel) => $hotel['vote'] >= $filters['vote']); //new array
}



// var_dump($filters);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php-Hotel</title>

    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <header class="header">
        <h1 class="title text-center">
            PHP Hotel
        </h1>
    </header>
    <main class="main my-5">
        <div class="container">
            <!-- filter -->
            <div class="row">
                <div class="col">
                    <form class="mb-5" action="index.php" method="GET">
                        <!-- parking filter -->
                        <div class="mb-3">
                            <label for="parking" class="form-label">Parcheggio</label>
                            <select class="form-select" name="parking" id="parking">
                                <option value="">Tutti</option>
                                <option value="1">Disponibile</option>
                                <option value="0">Non disponibile</option>
                            </select>
                        </div>
                        <!-- vote filter -->
                        <div class="mb-3">
                            <label for="vote" class="form-label">Voto</label>
                            <select class="form-select" name="vote" id="vote">
                                <option value="">Tutti</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Filtra</button>
                        <!-- reset filters button -->
                        <button class="btn btn-danger">
                            Resetta
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <!-- manual headers for using italian language -->
                        <th scope="col">Hotel</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col" class="text-center">Parcheggio</th>
                        <th scope="col" class="text-center">Voto</th>
                        <th scope="col" class="text-center">Distanza dal centro</th>
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

                    //check if there are filtered hotels
                    if ($filtered_hotels) {
                        foreach ($filtered_hotels as $hotel) {

                            echo "<tr>";

                            foreach ($hotel as $key => $value) {
                                //parking checkmark - stars - distance format conditions
                                if ($key == 'parking') {
                                    if ($value) {
                                        echo "<td class='text-success text-center fw-bold'>$checkmark</td>";
                                    } else {
                                        echo "<td class='text-danger text-center fw-bold'>$not_available</td>";
                                    }
                                } else if ($key == 'vote') {
                                    //stars for vote
                                    echo "<td class='text-center stars'>";
                                    for ($i = 0; $i < $value; $i++) {
                                        echo "&#11088;";
                                    }
                                    echo "</td>";
                                } else if ($key == 'distance_to_center') {
                                    //distance format
                                    echo "<td class='text-center'>$value km</td>";
                                } else {
                                    echo "<td>$value</td>";
                                }
                            }

                            //closing table row
                            echo "</tr>";
                        }
                    }


                    //?other solution
                    // foreach ($filtered_hotels as $hotel) {
                    // 
                    ?>

                    <!-- <tr>
                        <td><?php echo $hotel['name']; ?></td>
                        <td><?php echo $hotel['description']; ?></td>
                        <td class="text-center"><?php echo $hotel['parking'] ? $checkmark : $not_available; ?></td>
                        <td class="text-center stars"><?php echo $hotel['vote']; ?></td>
                        <td class="text-center"><?php echo $hotel['distance_to_center']; ?></td>
                    </tr> -->

                    <?php
                    // }
                    // 
                    ?>
                </tbody>
            </table>

            <!-- not found message -->
            <?php
            if (!$filtered_hotels) {
                echo $not_found_message;
            }
            ?>
        </div>
    </main>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
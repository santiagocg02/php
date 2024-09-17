<?php

declare (strict_types=1); // arriba del todo a nivel de archivo tipos estrictos

const API_URL = "https://whenisthenextmcufilm.com/api";

function get_data(string $url) {
    $result = file_get_contents(API_URL); //si solo quieres hacer un GET de una API
    $data = json_decode($result, true);
    return $data;
}

function get_until_message (int $days): string
{
return match (true){
    $days === 0    => "Hoy se estrena!",
    $days === 1  => "Manana se estrena!",
    $days < 7  =>"Esta semana se estrena!",
    $days === 18 =>"Este mes se estrena!",
    default     => "$days dias hasta el estreno",
    };
}

$data = get_data(API_URL);
$until_message = get_until_message($data["days_until"]);
?>

<head>
    <title>La proxima pelicula de marvel</title>
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
    >
</head>


<main>
    <section>
       <img src="<?= $data["poster_url"]; ?>" width="300" alt="Poster de <?= $data ["title"]; ?>"
       style="border-radius: 16px" />

    </section>

    <hgroup>
        <h3><?= $data["title"] ?> se estrena en - <?=$until_message ?> dias </h3>
        <p>Fecha de estreno: <?= $data["release_date"]?></p>
        <p>La siguiente es: <?= $data["following_production"] ["title"] ?></p>
    </hgroup>
</main>

<style>
    :root {
        color-scheme: light dark;
    }
    
    body {
        display: grid;
        place-content: center;
    }

    img {
        margin: 0 auto;

    }

    section{
        display: flex;
        justify-content: center;
        text-align: center;

    }

hgroup {
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
}

</style>
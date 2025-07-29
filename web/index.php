<?php

$rootUrl = "https://wheelerrecommends.com/";

global $config;
$config['rootUrl'] = $rootUrl;

?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Wheeler Recommends - Movie Recommendations</title>
    <meta name='description' content='Discover movie recommendations curated by Wheeler Universe. Find your next favorite film from our collection of quality recommendations.'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='theme-color' content='#2563eb'>
    <link rel='icon' href='/assets/wheeleruniverse-logo.jpg' type='image/jpeg'>
    <link rel='apple-touch-icon' href='/assets/wheeleruniverse-logo.jpg'>
    <link rel='manifest' href='/assets/site.webmanifest'>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='css/global.css'/>
    <?php
    if (isset($_GET['title'])) {
        echo "<link rel='stylesheet' href='css/movie.css' type='text/css'/>";
    } else {
        echo "<link rel='stylesheet' href='css/home.css' type='text/css'/>";
    }
    ?>
    <link rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css'
          integrity='sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=='
          crossorigin='anonymous'
          referrerpolicy='no-referrer'
          type='text/css'
    />
    <script type='application/javascript'>
        function viewMoreMovies() {
            const hiddenMovieContainer = document.querySelector('.movies-container.hidden');
            hiddenMovieContainer?.classList?.remove('hidden');
        }
    </script>
</head>
<body>
<header class='header-container' role='banner'>
    <?= "
    <a class='brand-section' 
       href='$rootUrl' 
       swa-event='Navigate->Home' 
       swa-event-async 
       swa-event-category='Navigate'
       aria-label='Wheeler Recommends - Home'
    >
       <img src='assets/wheeleruniverse-logo.jpg' alt='Wheeler Universe Logo' class='brand-logo'>
       <span class='brand-name'>WHEELER RECOMMENDS</span>
    </a>
    " ?>
    <a class='github-link'
       href='https://github.com/wheeleruniverse/wheelerrecommends'
       swa-event='Open->GitHub'
       swa-event-category='Open'
       target='_blank'
       rel='noopener noreferrer'
       aria-label='View Wheeler Recommends on GitHub (opens in new window)'
    >
        <i class='fa fa-brands fa-github github-icon' aria-hidden='true'></i>
    </a>
</header>
<main class='content-container' role='main'>
    <?php
    if (isset($_GET['title'])) {
        include 'pages/movie.php';
    } else {
        include 'pages/home.php';
    }
    ?>
</main>
<script src='https://dhscpc2fh3pyz.cloudfront.net/cdn/client-script.js'
        site='wheelerrecommends.com'
        attr-tracking='true'
>
</script>
</body>
</html>


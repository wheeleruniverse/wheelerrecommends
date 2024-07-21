<?php

$rootUrl = "https://wheelerrecommends.com";

global $config;
$config['rootUrl'] = $rootUrl;

?>

<html lang='en'>
<head>
    <title>Wheeler Recommends</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='shortcut icon' href='images/favicon.jpg'>
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
<div class='header-container'>
    <?= "
    <a class='brand-name' 
       href='$rootUrl' 
       swa-event='Navigate->Home' 
       swa-event-async 
       swa-event-category='Navigate'
    >
       WHEELER RECOMMENDS
    </a>
    " ?>
    <a class='github-link'
       href='https://github.com/wheeleruniverse/wheelerrecommends'
       swa-event='Open->GitHub'
       swa-event-async
       swa-event-category='Open'
       target='_blank'
    >
        <i class='fa fa-brands fa-github github-icon'></i>
    </a>
</div>
<div class='content-container'>
    <?php
    if (isset($_GET['title'])) {
        include 'pages/movie.php';
    } else {
        include 'pages/home.php';
    }
    ?>
</div>
<script src='https://dhscpc2fh3pyz.cloudfront.net/cdn/client-script.js'
        site='wheelerrecommends.com'
        attr-tracking='true'
>
</script>
</body>
</html>


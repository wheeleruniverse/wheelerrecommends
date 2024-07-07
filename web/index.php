<?php

global $config;

$config['rootUrl'] = "http://localhost:63342/wheelerrecommends/web/"; // TODO: https://wheelerrecommends.com

?>

<html>
<head>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='shortcut icon' href='images/favicon.ico'>
    <link rel='stylesheet' href='css/global.css'/>
    <?php
    if (isset($_GET['title'])) {
        echo "<link rel='stylesheet' href='css/movie.css' type='text/css'/>";
    } else {
        echo "<link rel='stylesheet' href='css/home.css' type='text/css'/>";
    }
    ?>
    <link rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'
          type='text/css'
    >
    <script type="application/javascript">
        function viewMoreMovies() {
            const hiddenMovieContainer = document.querySelector('.movies-container.hidden');
            hiddenMovieContainer?.classList?.remove('hidden');
        }
    </script>
</head>
<body>
<div class='header-container'>
    <?= "<a class='brand-name' href=" . $config['rootUrl'] . ">WHEELER RECOMMENDS</a>" ?>
    <a class='github-link' href='https://github.com/wheeleruniverse/wheelerrecommends' target='_blank'>
        <i class='fa fa-github github-icon'></i>
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
</body>
</html>


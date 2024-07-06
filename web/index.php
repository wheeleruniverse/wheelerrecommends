<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/main.css"/>
    <link rel="stylesheet" href="css/media.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div>
    <div class="flex">
        <div id="brand-logo">
            <a href="https://wheelerrecommends.com">
                <img src="images/favicon.jpg"/>
            </a>
        </div>
        <div id="brand-name">
            <h1>WHEELER RECOMMENDS</h1>
        </div>
        <div>
            <a target="_blank" href="https://github.com/wheeleruniverse/wheelerrecommends">
                <i class="fa fa-github github"></i>
            </a>
        </div>
    </div>
    <?php
    if (isset($_GET['title'])) {
        include "pages/title.php";
    } else {
        include "pages/home.php";
    }
    ?>
</div>
</body>
</html>


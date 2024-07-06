<?php

include_once('services/MovieService.php');
include_once('services/SearchService.php');
include_once('services/TemplateService.php');

use services\MovieService;
use services\SearchService;
use services\TemplateService;

# find all
$movies = MovieService::find_all();

# get id from url
$target_id = $_GET['title'];

# find movie with id
$target = SearchService::find_by_id($movies, $target_id);

# handle invalid id
if ($target == null) {
    echo "Could Not Find MovieTitle: '$target_id'";
    return;
}

$id = $target->get_id();

$name = $target->get_name();

$cluster_hits = SearchService::find_by_cluster($movies, $target->get_cluster());

$distance_hits = SearchService::find_by_distance($cluster_hits, $name);

?>
    <div class="flex">
        <div id="title-lhs">
            <?php
                // TODO: update to load images from S3 dynamically after the page has loaded to ensure good performance
                // TODO: echo "<img src='/images/$id.jpg' onerror=\"this.onerror=null;this.src='noposter.jpg';\" />";

                echo "<img src='images/noposter.jpg' />";
            ?>
        </div>
        <div id="title-rhs">
            <div>
                <h2><?= $name . "(" . $target->get_year() . ")" ?></h2>
            </div>
            <div>
                <h3>Genres</h3>
                <?= $target->get_genres(); ?>
            </div>
            <div>
                <h3>Rating</h3>
                <?php
                $total = 10;
                foreach (range(1, $target->get_rating()) as $i) {
                    echo "<span class='fa fa-star checked'></span>";
                    $total--;
                }
                foreach (range(0, $total - 1) as $i) {
                    echo "<span class='fa fa-star'></span>";
                }
                echo " (" . number_format($target->get_votes()) . ")";
                ?>
            </div>
            <br/><br/>
            <div>
                <?php echo "<a target='_blank' href='https://www.imdb.com/title/$id/'><i class='fa fa-imdb imdb'></i></a>"; ?>
            </div>
        </div>
    </div>

<?php
echo "<br/>";
echo "<hr/>";

$page_instances = array_slice($distance_hits, 0, 9);
TemplateService::write($page_instances);
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
$year = $target->get_year();

$cluster_hits = SearchService::find_by_cluster($movies, $target->get_cluster());

try {
    $distance_hits = SearchService::find_by_distance($cluster_hits, $name);
} catch (Exception $e) {
}

$google_url = "https://www.google.com/search?q=$name ($year)";

?>
    <div class="details-container">
        <div class="lhs">
            <?php
            echo "<a href='$google_url' target='_blank'>";
            echo "<img alt='Movie Poster' src='images/$id.jpg' onerror=\"this.onerror=null;this.src='images/noposter.jpg'\" />";
            echo "</a>";
            ?>
        </div>
        <div class="rhs">
            <div class="name-container">
                <span class="label">
                    <?= "$name ($year)" ?>
                </span>
            </div>

            <div class="genres-container">
                <span class="label">Genres</span>
                <span class="value"><?= $target->get_genres(); ?></span>
            </div>

            <div class="rating-container">
                <span class="label">Rating</span>
                <span class="value">
                <?php
                $total = 10;
                foreach (range(1, $target->get_rating()) as $i) {
                    echo "<span class='fa fa-star fill'></span>";
                    $total--;
                }
                foreach (range(0, $total - 1) as $i) {
                    echo "<span class='fa fa-star'></span>";
                }
                ?>
                </span>
            </div>

            <div class="votes-container">
                <span class="label">Votes</span>
                <span class="value">
                    <?= number_format($target->get_votes()) ?>
                </span>
            </div>

            <div class="icon-container">
                <?= "<a target='_blank' href='https://www.imdb.com/title/$id/'><i class='fa fa-imdb imdb'></i></a>" ?>
                <?= "<a target='_blank' href='https://www.google.com/search?q=$name ($year)'><i class='fa fa-google google'></i></a>" ?>
            </div>
        </div>
    </div>

<?php

$page_instances = array_slice($distance_hits, 0, 12);
TemplateService::write($page_instances, 12);
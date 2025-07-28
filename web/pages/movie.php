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
    $distance_hits = [];
}

$google_url = "https://www.google.com/search?q=" . urlencode("$name ($year)");
$escapedName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$escapedGenres = htmlspecialchars($target->get_genres(), ENT_QUOTES, 'UTF-8');

?>
    <article class="movie-details" role="main">
        <div class="movie-poster">
            <?php
            echo "
            <a class='poster-link'
               href='$google_url' 
               swa-event='Open->Poster' 
               swa-event-category='Open' 
               swa-event-data='$name ($year)' 
               target='_blank'
               rel='noopener noreferrer'
               aria-label='Search for $escapedName ($year) on Google'
            >";
            TemplateService::writeMoviePoster($id, $name, $year);
            echo "</a>";
            ?>
        </div>
        <div class="movie-info">
            <header class="movie-title">
                <h1><?= $escapedName ?> <span class="year">(<?= $year ?>)</span></h1>
            </header>

            <div class="movie-metadata">
                <div class="metadata-item">
                    <span class="label">Genres</span>
                    <span class="value"><?= $escapedGenres ?></span>
                </div>

                <div class="metadata-item rating-item">
                    <span class="label">Rating</span>
                    <div class="rating-stars" aria-label="Rating: <?= $target->get_rating() ?> out of 10 stars">
                        <?php
                        $rating = $target->get_rating();
                        for ($i = 1; $i <= 10; $i++) {
                            if ($i <= $rating) {
                                echo "<span class='fa fa-star filled' aria-hidden='true'></span>";
                            } else {
                                echo "<span class='fa fa-star' aria-hidden='true'></span>";
                            }
                        }
                        ?>
                        <span class="rating-text"><?= $rating ?>/10</span>
                    </div>
                </div>

                <div class="metadata-item">
                    <span class="label">Votes</span>
                    <span class="value"><?= number_format($target->get_votes()) ?></span>
                </div>
            </div>

            <div class="external-links">
                <?= "
                <a class='external-link imdb-link'
                   href='https://www.imdb.com/title/$id/' 
                   swa-event='Open->IMDb'
                   swa-event-category='Open' 
                   swa-event-data='$id' 
                   target='_blank'
                   rel='noopener noreferrer'
                   aria-label='View $escapedName on IMDb (opens in new window)'
                >
                  <i class='fa fa-brands fa-imdb' aria-hidden='true'></i>
                  <span class='link-text'>IMDb</span>
                </a>
                <a class='external-link google-link'
                   href='$google_url' 
                   swa-event='Open->Google' 
                   swa-event-category='Open' 
                   swa-event-data='$name ($year)' 
                   target='_blank' 
                   rel='noopener noreferrer'
                   aria-label='Search for $escapedName on Google (opens in new window)'
                >
                  <i class='fa fa-brands fa-google' aria-hidden='true'></i>
                  <span class='link-text'>Google</span>
                </a>
                " ?>
            </div>
        </div>
    </article>

    <section class="recommendations" aria-labelledby="recommendations-heading">
        <h2 id="recommendations-heading">Similar Movies</h2>

<?php

$page_instances = array_slice($distance_hits, 0, 15);
TemplateService::writeMovies($page_instances, 15);

?></section>
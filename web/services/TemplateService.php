<?php

namespace services;

class TemplateService
{
    public static function writeMovies($movie_title_instances, $page_size): void
    {
        global $config;

        $movie_pages = array_chunk($movie_title_instances, $page_size);

        foreach ($movie_pages as $key => $page) {
            if ($key === array_key_first($page)) {
                echo "<div class='movies-container'>";
            } else {
                echo "<div class='movies-container hidden'>";
            }
            foreach ($page as $movie) {
                $id = $movie->get_id();
                $name = $movie->get_name();
                $year = $movie->get_year();
                $genres = $movie->get_genres();
                $rating = $movie->get_rating();

                echo "<article id='$id' class='poster'>";

                $titleUrl = $config['rootUrl'] . "?title=$id";
                $escapedName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
                $ariaLabel = "View details for $escapedName ($year)";

                echo "<a href='$titleUrl' swa-event='Navigate->Movie' swa-event-async swa-event-category='Navigate' swa-event-data='$id' aria-label='$ariaLabel'>";

                self::writeMoviePoster($id, $escapedName, $year);

                if (strlen($name) > 20) {
                    $name_substring = substr($name, 0, 17) . "...";
                } else {
                    $name_substring = substr($name, 0, 20);
                }

                echo "<span class='movie-name'>" . htmlspecialchars($name_substring, ENT_QUOTES, 'UTF-8') . " ($year)</span>";
                echo "</a>";
                echo "</article>";
            }
            echo "</div>";
        }
        if (count($movie_pages) > 1) {
            echo "<div class='more-container'>";
            echo "<button onclick='viewMoreMovies()' swa-event='Load->ViewMore' swa-event-async swa-event-category='Load' aria-label='Load more movie recommendations'>";
            echo "View More Movies";
            echo "</button>";
            echo "</div>";
        }
    }

    public static function writeMoviePoster($id, $name, $year): void
    {
        $src = "images/$id.jpg";
        $fallback = "images/noposter.jpg";
        $altText = "Movie poster for $name ($year)";
        
        // In serverless environment, rely on onerror fallback since file_exists() won't work for CDN assets
        echo "<img alt='$altText' src='$src' onerror=\"this.onerror=null;this.src='$fallback'\" loading='lazy' />";
    }
}
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

                echo "<span id='$id' class='poster'>";
                echo "<a href='" . $config['rootUrl'] . "?title=$id'>";

                self::writeMoviePoster($id);

                if (strlen($name) > 20) {
                    $name_substring = substr($name, 0, 17) . "...";
                } else {
                    $name_substring = substr($name, 0, 20);
                }

                echo "<span class='movie-name'>$name_substring ($year)</span>";
                echo "</a>";
                echo "</span>";
            }
            echo "</div>";
        }
        if (count($movie_pages) > 1) {
            echo "<div class='more-container'><button onclick='viewMoreMovies()'>View More</button></div>";
        }
    }

    public static function writeMoviePoster($id): void
    {
        $src = "images/$id.jpg";
        $fallback = "images/noposter.jpg";
        echo "<img alt='Movie Poster' src='$src' onerror=\"this.onerror=null;this.src='$fallback'\" loading='lazy' />";
    }
}
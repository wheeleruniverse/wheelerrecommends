<?php

namespace services;

include('models/MovieTitle.php');

use services\models\MovieTitle;

class MovieService
{
    static string $filename = "data/imdb.csv";

    /**
     * @return MovieTitle[]
     */
    public static function find_all(): array
    {
        $idx = 0;
        $movie_title_instances = array();
        if (($file = fopen(MovieService::$filename, "r")) !== FALSE) {
            while (($row = fgetcsv($file, 0, ",", '"', "\\")) !== FALSE) {
                $idx++;
                if ($idx === 1) {
                    continue;
                }
                $movie_title_instances[] = self::convert_row_to_movie($row);
            }
            fclose($file);
        }
        return $movie_title_instances;
    }

    private static function convert_row_to_movie($row): MovieTitle
    {
        $movie_title = new MovieTitle();
        $movie_title->set_id($row[0]);
        $movie_title->set_genres($row[1]);
        $movie_title->set_rating($row[2]);
        $movie_title->set_name($row[3]);
        $movie_title->set_votes($row[4]);
        $movie_title->set_year($row[5]);
        $movie_title->set_cluster($row[6]);
        $movie_title->set_distance($row[7]);

        return $movie_title;
    }
}
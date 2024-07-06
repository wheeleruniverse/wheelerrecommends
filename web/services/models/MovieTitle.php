<?php

namespace services\models;

class MovieTitle
{
    private $id;
    private $cluster;
    private $distance;
    private $genres;
    private $name;
    private $rating;
    private $votes;
    private $year;

    # Generated
    private $distance_diff;


    # Getters/Setters
    public function get_id()
    {
        return $this->id;
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    public function get_cluster()
    {
        return $this->cluster;
    }

    public function set_cluster($cluster)
    {
        $this->cluster = $cluster;
    }

    public function get_distance()
    {
        return $this->distance;
    }

    public function set_distance($distance)
    {
        $this->distance = $distance;
    }

    public function get_genres()
    {
        return $this->genres;
    }

    public function set_genres($genres)
    {
        $this->genres = $genres;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function set_name($name)
    {
        $this->name = $name;
    }

    public function get_rating()
    {
        return $this->rating;
    }

    public function set_rating($rating)
    {
        $this->rating = $rating;
    }

    public function get_votes()
    {
        return $this->votes;
    }

    public function set_votes($votes)
    {
        $this->votes = $votes;
    }

    public function get_year()
    {
        return $this->year;
    }

    public function set_year($year)
    {
        $this->year = $year;
    }


    public function get_distance_diff()
    {
        return $this->distance_diff;
    }

    public function set_distance_diff($distance_diff)
    {
        $this->distance_diff = $distance_diff;
    }
}
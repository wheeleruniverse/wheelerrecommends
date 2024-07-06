<?php

namespace services;

use Exception;
use services\models\MovieTitle;

class SearchService
{
    /**
     * @param $movie_title_instances
     * @param $target_id
     * @return MovieTitle|null
     */
    public static function find_by_id($movie_title_instances, $target_id)
    {
        foreach ($movie_title_instances as $i) {
            if ($i->get_id() == $target_id) {
                return $i;
            }
        }
        return null;
    }

    /**
     * @param $movie_title_instances
     * @param $target_cluster
     * @return MovieTitle[]
     */
    public static function find_by_cluster($movie_title_instances, $target_cluster): array
    {
        $clusterInstances = [];
        foreach ($movie_title_instances as $i) {
            $titleCluster = $i->get_cluster();
            if ($titleCluster == $target_cluster) {
                $clusterInstances[] = $i;
            }
        }
        return $clusterInstances;
    }

    /**
     * @param $movie_title_instances
     * @param $target_name
     * @return MovieTitle[]
     * @throws Exception
     */
    public static function find_by_distance($movie_title_instances, $target_name): array
    {
        # find count
        $cnt = count($movie_title_instances);
        if ($cnt < 1) {
            throw new Exception("find_by_distance: 'movie_title_instances' is invalid");
        }

        # find index
        $idx = -1;
        $target_distance = null;
        foreach ($movie_title_instances as $i => $v) {

            $titleName = $v->get_name();
            if ($titleName == $target_name) {
                $idx = $i;
                $target_distance = $v->get_distance();
                break;
            }
        }
        if ($idx < 0) {
            throw new Exception("find_by_distance: could not find $target_name in 'movie_title_instances'");
        }

        # populate distance
        foreach ($movie_title_instances as $i => $v) {
            if ($i == $idx) {
                $diff = 999999;
            } else {
                $diff = abs($target_distance - $v->get_distance());
            }
            $v->set_distance_diff($diff);
        }

        # sort by distance
        usort($movie_title_instances, fn($a, $b) => strcmp($a->get_distance_diff(), $b->get_distance_diff()));

        return $movie_title_instances;
    }
}
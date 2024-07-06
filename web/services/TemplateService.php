<?php

namespace services;

class TemplateService
{
//    static string $root = "https://wheelerrecommends.com";
    static string $root = "http://localhost:63342/wheelerrecommends/web/";

    public static function write($movie_title_instances): void
    {
        echo "<div>";
        foreach ($movie_title_instances as $i) {

            $id = $i->get_id();
            $name = $i->get_name();
            $year = $i->get_year();

            echo "<p id='$id' class='poster'>";
            echo "<a href='" . self::$root . "?title=$id'>";

            // TODO: update to load images from S3 dynamically after the page has loaded to ensure good performance
            // TODO: echo "<img src='/images/img/$id.jpg' onerror=\"this.onerror=null;this.src='noposter.jpg';\" />";

            echo "<img src='images/noposter.jpg' />";

            if (strlen($name) > 20) {
                $name_substring = substr($name, 0, 17) . "...";
            } else {
                $name_substring = substr($name, 0, 20);
            }

            echo "$name_substring ($year)";
            echo "</a>";
            echo "</p>";
        }
        echo "<p style='clear: both;'></p>";
        echo "</div>";
    }
}
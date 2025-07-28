<?php

include_once('services/MovieService.php');
include_once('services/TemplateService.php');

use services\MovieService;
use services\TemplateService;

# find all
$movies = MovieService::find_all();

# randomize
shuffle($movies);

# render
TemplateService::writeMovies($movies, 25);

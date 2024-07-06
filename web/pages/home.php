<?php

include_once('services/MovieService.php');
include_once('services/TemplateService.php');

use services\MovieService;
use services\TemplateService;

# find all
$movies = MovieService::find_all();

# randomize
shuffle($movies);

# paginate
// TODO: add more pages with next and back buttons
$page_instances = array_slice($movies, 0, 20);

# render
TemplateService::write($page_instances);

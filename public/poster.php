<?php

use Entity\Exception\EntityNotFound;

$poster = $_GET['Id'];

try {
    $stmt = \Entity\Poster::findById($poster);

    header("Content-type:image/png");
    echo "$stmt";
} catch (EntityNotFound $poster) {
    header("Content-type:image/png");
    header("Location: http://cutrona/but/s2/sae2-01/ressources/public/img/default.png");
}
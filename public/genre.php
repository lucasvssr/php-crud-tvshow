<?php

declare(strict_types=1);

use Entity\Collection\GenreCollection;
use Html\AppWebPage;
use Entity\Collection\SerieCollection;

$webPage = new AppWebPage();

$webPage->setTitle('Séries TV');

$stmt = GenreCollection::findAllGenre();

$webPage->appendContent("<div class='menu'><a class='home' href='index.php'> ACCUEIL</a><span class='choice'>Genre<nav class='genre'>");

foreach ($stmt as $genre) {
    $webPage->appendContent("<a href='genre.php?Id={$genre->getId()}'>{$genre->getName()}</a>");
}

$webPage->appendContent("</nav></span> </div>");

$webPage->appendContent('<div class="list">');

$genre = $webPage->escapeString($_GET['Id']);

$stmt = \Entity\TvShowGenre::findByGenreId((int)$genre);

foreach ($stmt as $serie) {
    $smt = \Entity\Serie::findById($serie['tvShowId']);
    $webPage->appendContent("    <a class='pres' href='saison.php?Id={$webPage->escapeString("{$smt->getId()}")}'><div class='poster'><img src = 'poster.php?Id={$smt->getPosterID()}' alt='a'></div><div class='serie'><span><h3>{$webPage->escapeString("{$smt->getName()}")}</h3><p class='description'>{$webPage->escapeString("{$smt->getOverview()}")}</p></span></div></a>");
}

$webPage->appendContent("</div>");

echo $webPage->toHTML();
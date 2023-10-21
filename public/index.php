<?php

declare(strict_types=1);

use Entity\Collection\GenreCollection;
use Html\AppWebPage;
use Entity\Collection\SerieCollection;

$webPage = new AppWebPage();

$webPage->setTitle('Séries TV');

$stmt = GenreCollection::findAllGenre();

$webPage->appendContent("<div class='menu'><a class='home' href='index.php'> Accueil</a><span class='choice'>Genre<nav class='genre'>");

foreach ($stmt as $genre) {
    $webPage->appendContent("<a href='genre.php?Id={$genre->getId()}'>{$genre->getName()}</a>");
}

$webPage->appendContent("</nav></span> </div>");

$webPage->appendContent('<div class="list">');

$stmt = SerieCollection::findAll();

foreach ($stmt as $titre) {
    $webPage->appendContent("    <a class='pres' href='saison.php?Id={$webPage->escapeString("{$titre->getId()}")}'><div class='poster'><img src = 'poster.php?Id={$titre->getPosterID()}' alt='a'></div><div class='serie'><span><h3>{$webPage->escapeString("{$titre->getName()}")}</h3><p class='description'>{$webPage->escapeString("{$titre->getOverview()}")}</p></span></div></a>");
}

$webPage->appendContent("</div>");

echo $webPage->toHTML();

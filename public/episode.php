<?php

use Html\AppWebPage;

$webPage = new AppWebPage();

$episode = $webPage->escapeString($_GET['Id']);

$stmt = \Entity\Saison::findById($episode);

$titre = \Entity\Serie::findById($stmt->getTvShowId());


$webPage->setTitle("Séries TV : {$titre->getName()} {$stmt->getName()}");

$webPage->appendContent("<div class='menu'><a class='home' href='index.php'> ACCUEIL</a></div>");

$webPage->appendContent("<div class='list'>");

$webPage->appendContent("    
            <div class='presentation'>
                 <span class='poster'><img src = 'poster.php?Id={$stmt->getPosterID()}' alt='Saison'></span>
                 <div class='season' >
                   <span class='titres'>
                        <a class='pres' href='saison.php?Id={$webPage->escapeString("{$titre->getId()}")}'><h3>{$webPage->escapeString("{$titre->getName()}")}</h3></a>
                        <h4>{$webPage->escapeString("{$stmt->getName()}")}</h4>
                   </span>
                  </div>
            </div>
            ");

$stmt = \Entity\Saison::findById($episode);

$stmt = $stmt->getEpisode();

foreach ($stmt as $episode) {
    $webPage->appendContent("<span class='episode'><h4 class='episodeTitre'>{$webPage->escapeString("Episode {$episode->getEpisodeNumber()}")} - {$webPage->escapeString("{$episode->getName()}")}</h4>
                                     <p class='episodeDesc'>{$webPage->escapeString("{$episode->getOverview()}")}</p></span>");
}

$webPage->appendContent("</div>");

echo $webPage->toHTML();

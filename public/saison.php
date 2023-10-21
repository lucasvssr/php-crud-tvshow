<?php

use Html\AppWebPage;

$webPage = new AppWebPage();

$webPage->appendCssUrl("https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" );

if (isset($_GET['Id']) == '') {
    header('Location: saison.php', true, 400);
    exit("Id=Not Use");
}

if (empty($_GET['Id'])) {
    header('Location: saison.php', true, 403);
    exit("Empty");
}

if (!(int)$_GET['Id']) {
    header('Location: saison.php', true, 400);
    exit("Not Int");
}

$saison = $webPage->escapeString($_GET['Id']);

$stmt = \Entity\Serie::findById((int)$saison);

$webPage->setTitle("Séries TV : {$stmt->getName()}");

$webPage->appendContent("<div class='menu'><a class='home' href='index.php'> ACCUEIL</a></div>");

$webPage->appendContent('<div class="list">');

$webPage->appendContent("    
            <div class='presentation'>
                 <span class='poster'><img src = 'poster.php?Id={$stmt->getPosterID()}' alt='Saison'></span>
                 <div class='season' >
                   <span class='titres'>
                        <a href='modification.php?Id={$stmt->getId()}' class='material-symbols-outlined modification'>settings</a>
                        <h3>{$webPage->escapeString("{$stmt->getName()}")}</h3>
                        <h4>{$webPage->escapeString("{$stmt->getOriginalName()}")}</h4>
                   </span>
                   <span class='description'>{$webPage->escapeString("{$stmt->getOverview()}")}</span>
                 </div>
            </div>");

$stmt = $stmt->getSeason();

foreach ($stmt as $season) {
    $webPage->appendContent("<a class='saison' href='episode.php?Id={$webPage->escapeString("{$season->getId()}")}'><div class='poster'><img src = 'poster.php?Id={$season->getPosterID()}' alt='Saison'></div><div class='serie>'> {$webPage->escapeString("{$season->getName()}")}</div></a>");
}

$webPage->appendContent("</div>");

echo $webPage->toHTML();
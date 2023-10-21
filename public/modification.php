<?php

declare(strict_types=1);

use Html\AppWebPage;

$webPage = new AppWebPage();

$serie = $_GET['Id'];

$serie = \Entity\Serie::findById((int)$serie);

$overview = substr($serie->getOverview(), 0, 15)."...";

$webPage->setTitle("Modification de {$serie->getName()}");
$webPage->appendContent("<div class='menu'><a class='home' href='saison.php?Id={$serie->getId()}'> Retour </a></div>");
$webPage->appendContent("<form class='formulaire' action='setter.php' method='post'>");
$webPage->appendContent("    <input name='id' type='hidden' value='{$serie->getId()}'><label><h4>Name</h4><input type='text'  name='name' placeholder='{$serie->getName()}'></label>");
$webPage->appendContent("    <label><h4>OriginalName</h4><input type='text' name='originalName' placeholder={$serie->getOriginalName()}></label>");
$webPage->appendContent("    <label><h4>Description</h4><input type='text' name='description' placeholder='$overview'></label>");
$webPage->appendContent("    <input type='Submit' name='a' value='Modifier'>");
$webPage->appendContent("</form>");

echo $webPage->toHTML();

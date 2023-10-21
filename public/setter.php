<?php

declare(strict_types=1);

use Database\MyPdo;

$id = $_POST['id'];
$name = $_POST['name'];
$orinalName = $_POST['originalName'];
$overview = $_POST['description'];

    if (!empty($name)) {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            UPDATE tvshow
            SET name = :name
            WHERE id = :serieId
            SQL
        );

        $stmt->execute([':serieId' => $id, ':name' => $name]);
    }

    if (!empty($orinalName)) {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            UPDATE tvshow
            SET originalName = :originalName 
            WHERE id = :serieId
            SQL
        );

        $stmt->execute([':serieId' => $id, ':originalName' => $orinalName]);
    }

    if (!empty($overview)) {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            UPDATE tvshow
            SET overview = :overview
            WHERE id = :serieId
            SQL
        );

        $stmt->execute([':serieId' => $id, ':overview' => $overview]);
    }

    $id = (int)$id;

header("Location: saison.php?Id={$id}");

<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;
use PDO;

class GenreCollection
{
    public static function findAllGenre()
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id ,name
            FROM genre
            ORDER BY name
            SQL
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Genre::class);
    }
}

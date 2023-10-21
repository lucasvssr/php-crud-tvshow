<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Serie;
use PDO;

class SerieCollection
{
    public static function findAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                    SELECT id, name, originalName, homePage, overview,posterId
                    FROM tvshow
                    ORDER BY name
                SQL
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Serie::class);
    }
}
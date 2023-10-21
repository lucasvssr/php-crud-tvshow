<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Saison;
use PDO;

class SaisonCollection
{
    public static function findBySeasonId(int $seasonId)
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id ,tvShowId, name, seasonNumber, posterId
            FROM season
            WHERE tvShowId = :seasonId
            ORDER BY seasonNumber
            SQL
        );

        $stmt->execute([':seasonId' => $seasonId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, saison::class);
    }
}
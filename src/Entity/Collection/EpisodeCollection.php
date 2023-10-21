<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Episode;
use PDO;

class EpisodeCollection
{
    public static function findByEpisodeId(int $episodeId): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id ,seasonId, name, overview, episodeNumber
            FROM episode
            WHERE seasonId = :episodeId
            ORDER BY episodeNumber
            SQL
        );

        $stmt->execute([':episodeId' => $episodeId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Episode::class);
    }
}

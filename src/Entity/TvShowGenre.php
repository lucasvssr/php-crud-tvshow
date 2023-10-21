<?php

namespace Entity;

use Database\MyPdo;

class TvShowGenre
{
    private int $id;
    private int $genreId;
    private int $tvShowId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getGenreId(): int
    {
        return $this->genreId;
    }

    /**
     * @return int
     */
    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }

    public static function findByGenreId(int $id)
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, genreId, tvShowId
            FROM tvshow_genre
            WHERE genreId = :genreId
            SQL
        );

        $stmt->execute([':genreId' => $id]);

        $serie = $stmt->fetchAll();

        return $serie;
    }
}
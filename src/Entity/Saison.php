<?php

namespace Entity;

use Database\MyPdo;
use Entity\Collection\EpisodeCollection;
use Entity\Exception\EntityNotFound;
use PDO;

class saison
{
    private int $id;
    private int $tvShowId;
    private string $name;
    private int $seasonNumber;
    private int $posterId;

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
    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    /**
     * @return int
     */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    public static function findById(int $id):Saison
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, tvShowId, name, seasonNumber, posterId
            FROM season
            WHERE id = :saisonId
            SQL
        );

        $stmt->execute([':saisonId' => $id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Saison::class);

        if (($saison = $stmt->fetch()) === false) {
            throw new EntityNotFound('Season not found');
        }

        return $saison;

    }

    public function getEpisode(): array
    {
        return EpisodeCollection::findByEpisodeId($this->getId());
    }
}
<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\SaisonCollection;
use Entity\Exception\EntityNotFound;
use PDO;

class Serie
{
    private int $id;
    private string $name;
    private string $originalName;
    private string $homePage;
    private string $overview;
    private int $posterId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    /**
     * @return string
     */
    public function getHomePage(): string
    {
        return $this->homePage;
    }

    /**
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * @return int
     */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    public static function findById(int $id): Serie
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id , name, originalName, homepage, overview, posterId
            FROM tvshow
            WHERE id = :serieId
            SQL
        );

        $stmt->execute([':serieId' => $id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Serie::class);

        if (($serie = $stmt->fetch()) === false) {
            header("HTTP/1.1 404 Serie NotFound");
            throw new EntityNotFound('TVShow not found');
        }

        return $serie;
    }

    public function getPoster(): string
    {
        return Poster::findById($this->getPosterId());
    }

    public function getSeason(): array
    {
        return SaisonCollection::findBySeasonId($this->getId());
    }
}

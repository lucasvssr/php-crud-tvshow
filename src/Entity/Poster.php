<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFound;

class Poster
{
    private int $id;
    private string $jpeg;

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
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    public static function findById(int $id): string
    {
        if (empty($id)) {
            header("Content-type:image/png");
            header("Location: http://cutrona/but/s2/sae2-01/ressources/public/img/default.png");
        }

        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT jpeg
            FROM poster
            WHERE id = :posterId
            SQL
        );

        $stmt->execute([':posterId' => $id]);

        $poster = $stmt->fetch();

        return $poster['jpeg'];
    }
}
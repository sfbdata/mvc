<?php

declare(strict_types=1);

namespace Sfbdata\Mvc\Repository;

use Sfbdata\Mvc\Entity\Video;
use PDO;

class VideoRepository
{
    public function __construct(private PDO $pdo)
    {
        
    }

    public function add(video $video): bool
    {
        $sql = 'INSERT INTO videos (url, title) VALUES (?,?)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $video->url);
        $stmt->bindValue(2, $video->title);

        $result = $stmt->execute();

        if ($result === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }

        $id = $this->pdo->lastInsertId();

        $video->setId(intval($id));
        
        return $result;

    }

    public function remove(int $id): bool
    {
        $sql = 'DELETE FROM videos WHERE id = ?';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);

        $result = $statement->execute();

        if ($result === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }

        return $result;

    }

    public function update(video $video): bool
    {
        $sql = 'UPDATE videos SET url = :url, title= :title WHERE id = :id;';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':url', $video->url);
        $statement->bindValue(':title', $video->title);
        $statement->bindValue(':id', $video->id, PDO::PARAM_INT);

        $result = $statement->execute();

        if ($result === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }

        return $result;
    }

    /**
     * @return Video[]
     */
    public function all(): array
    {
        $videoList = $this->pdo
            ->query('SELECT * FROM videos;')
            ->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            $this->hydrateVideo(...), 
            $videoList 
        );

    }

    public function find(int $id)
    {

        $stmt = $this->pdo->prepare('SELECT * FROM videos WHERE id = ?;');
        $stmt->bindValue(1, $id, PDO::FETCH_ASSOC);
        $stmt->execute();

        return $this->hydrateVideo($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function hydrateVideo(array $videoData): Video
    {
        $video = new Video($videoData['url'], $videoData['title']);
        $video->setId($videoData['id']);

        return $video;
    }
}
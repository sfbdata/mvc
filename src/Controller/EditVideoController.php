<?php 

declare(strict_types=1);

namespace Sfbdata\Mvc\Controller;

use Sfbdata\Mvc\Entity\Video;
use Sfbdata\Mvc\Repository\VideoRepository;

class EditVideoController implements Controller
{
    public function __construct(private VideoRepository $repository)
    {        
    }

    public function processaRequisicao(): void
    {

        $id =  filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null){
            header('Location: /?sucesso=0');
            exit();
        }

        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        if ($url === false){
            header('Location: /?sucesso=0');
            exit();
        }

        $title = filter_input(INPUT_POST, 'title');
        if ($title === false) {
            header('Location: /?sucesso=0');
            exit();
        }

        $video = new Video($url, $title);
        $video->setId($id);

        $success = $this->repository->update($video);

        if ($success === false)
        {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }

    }
}
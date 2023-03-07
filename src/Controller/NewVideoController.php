<?php 

declare(strict_types=1);

namespace Sfbdata\Mvc\Controller;

use Sfbdata\Mvc\Entity\Video;
use Sfbdata\Mvc\Repository\VideoRepository;

class NewVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
        
    }

    public function processaRequisicao(): void
    {

        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        if ($url === false){
            header('Location: /?sucesso=0');
            return;
        }

        $title = filter_input(INPUT_POST, 'title');
        if ($title === false) {
            header('Location: /?sucesso=0');
            return;
        }

        $success = $this->videoRepository->add(new Video($url,$title));

        if ($success === false)
        {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }

        
    }


}
<?php 

declare(strict_types=1);

namespace Sfbdata\Mvc\Controller;

use Sfbdata\Mvc\Repository\VideoRepository;

class RemoveVideoController implements Controller
{
    public function __construct(private VideoRepository $repository)
    {        
    }

    public function processaRequisicao(): void
    {
        $id =  filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null) {
            header('Location: /?sucesso=0');
        }

        $success = $this->repository->remove($id);
        if ($success === false)
        {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }

    }

}


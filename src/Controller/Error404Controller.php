<?php 

declare(strict_types=1);

namespace Sfbdata\Mvc\Controller;


class Erro404Controller  implements Controller
{
    public function processaRequisicao(): void
    {
        http_response_code(404);
    }
}
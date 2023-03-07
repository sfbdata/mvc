<?php

declare(strict_types=1);

use Sfbdata\Mvc\Controller\EditVideoController;
use Sfbdata\Mvc\Controller\NewVideoController;
use Sfbdata\Mvc\Controller\RemoveVideoController;
use Sfbdata\Mvc\Controller\VideoFormController;
use Sfbdata\Mvc\Controller\VideoListController;

return [
    'GET|/' => VideoListController::class,
    'GET|/novo-video' => VideoFormController::class,
    'POST|/novo-video'=> NewVideoController::class,
    'GET|/editar-video' => VideoFormController::class,
    'POST|/editar-video' => EditVideoController::class,
    'GET|/remover-video' => RemoveVideoController::class,
];
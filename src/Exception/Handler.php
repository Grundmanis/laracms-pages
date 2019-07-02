<?php

namespace Grundmanis\Laracms\Modules\Pages\Exception;

use Exception;
use Grundmanis\Laracms\Modules\Pages\Models\LaracmsPage;

class Handler extends \App\Exceptions\Handler {

    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $url = implode('/', $request->segments());

            if ($page = LaracmsPage::where('url', $url)->first()) {
                return response()
                    ->view('laracms.pages.index', compact('page'))
                    ->setStatusCode(200);
            }
        }

        return parent::render($request, $exception);
    }
}
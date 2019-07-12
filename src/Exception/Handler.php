<?php

namespace Grundmanis\Laracms\Modules\Pages\Exception;

use Exception;
use Grundmanis\Laracms\Modules\Pages\Models\LaracmsPage;
use Grundmanis\Laracms\Modules\Pages\Models\LaracmsPageTranslation;

class Handler extends \App\Exceptions\Handler {

    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $url = implode('/', $request->segments());

            if ($translation = LaracmsPageTranslation::where('url', $url)->first()) {
                $page = $translation->page;

                return response()
                    ->view('laracms.pages.pages.index', compact('page'))
                    ->setStatusCode(200);
            }
        }

        return parent::render($request, $exception);
    }
}
<?php

namespace Components\Exceptions;

use Clarity\Exceptions\Handler as BaseHandler;
use Clarity\Exceptions\ControllerNotFoundException;
use Clarity\Exceptions\AccessNotAllowedException;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class Handler extends BaseHandler
{
    public function report()
    {
        parent::report();
    }

    public function render($e, $status_code = null)
    {
        if (headers_sent()) {
            return;
        }
        $whoops = new Run();
        $whoops->pushHandler(new PrettyPageHandler());
        if ($e instanceof AccessNotAllowedException) {
            return (new CsrfHandler)->handle($e);
        }

        if ($e instanceof ControllerNotFoundException) {
            if (config()->app->debug) {
                return parent::render($e, PageNotFoundHandler::STATUS_CODE);
            }

            return (new PageNotFoundHandler)->handle($e);
        }

        # you may also want to extract the error for other purpose
        # such as logging it to your slack bot notifier or using
        # bugsnag

        // ... notifications | bugsnag | etc...

        if (! config()->app->debug && is_cli() === false) {
            return $whoops->handleException($e);
        }
        if (is_cli()) {
            $whoops->popHandler();
            $whoops->pushHandler(new PlainTextHandler());
            return $whoops->handleException($e);
        }
        return $whoops->handleException($e);
    }
}

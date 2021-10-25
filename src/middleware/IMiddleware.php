<?php


namespace SimpleMvc\middleware;


use SimpleMvc\http\Request;
use SimpleMvc\http\Response;

interface IMiddleware
{
    /**
     * Выполнение действий перед выполнением роутера.
     * Если вернуть false - роутер не будет выполнен.
     *
     * @param Request $request
     * @param Response $response
     *
     * @return bool
     */
    public function handle(Request $request, Response $response): bool;
}
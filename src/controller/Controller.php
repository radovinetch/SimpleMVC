<?php

namespace SimpleMvc\controller;

use SimpleMvc\http\Request;
use SimpleMvc\http\Response;
use SimpleMvc\session\Session;

abstract class Controller
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var Response
     */
    protected Response $response;

    /**
     * @var Session
     */
    protected Session $session;

    /**
     * Controller constructor.
     * @param Request $request
     * @param Response $response
     * @param Session $session
     */
    public function __construct(Request $request, Response $response, Session $session)
    {
        $this->request = $request;
        $this->response = $response;
        $this->session = $session;
    }
}
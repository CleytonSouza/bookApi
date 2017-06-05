<?php

namespace BookApi\Controller;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Author implements ControllerProviderInterface
{
    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/', __CLASS__ . '::getCollection')->method('GET');
        $controllers->get('/isbn/{isbn}', __CLASS__ . '::getEntity')->method('GET');
        $controllers->get('/', __CLASS__ . '::isCollection')->method('POST');
        $controllers->get('/isbn/{isbn}', __CLASS__ . '::updateEntity')->method('PUT');
        $controllers->get('/isbn/{isbn}', __CLASS__ . '::deleteEntity')->method('DELETE');

        return $controllers;
    }
}

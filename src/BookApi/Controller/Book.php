<?php

namespace BookApi\Controller;

use BookApi\DAL\DAL;
use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Book implements ControllerProviderInterface
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

    protected function getDataAccessLayer()
    {
        return new DAL();
    }

    /**
     * @param Application $app
     * @param Request $request
     * @return Response
     */
    public function getCollection(Application $app, Request $request)
    {
        $collections = $this->getDataAccessLayer()->all('\\BookApi\\Model\\Book');

        $collections = $app['serializer']->serialize($collections, 'json');

        return new Response(
            $collections,
            200,
            array(
                'Content-Type' => $request->getMimeType('json')
            )
        );
    }

    /**
     * @param Application $app
     * @param Request $request
     * @return Response
     */
    public function getEntity(Application $app, Request $request)
    {
        $statusCode = 200;
        $contentType = 'json';
        $entity = $this->getDataAccessLayer()->find(new \BookApi\Model\Book());

        if (!($entity instanceof \BookApi\Model\Book)) {
            throw new \DomainException('Resource Not Found', 404);
        }

        $entity = $app['serializer']->serialize($entity, $contentType);
        return new Response($entity, $statusCode, array('Content-Type' => $request->getMimeType($contentType)));
    }

    /**
     * @param Application $app
     * @param Request $request
     * @return Response
     */
    public function isCollection(Application $app, Request $request)
    {
        return (array_key_exists("email", $request->request->all())) ?
            $this->createEntity($app, $request) : $this->createEntities($app, $request);
    }

    /**
     * @param Application $app
     * @param Request $request
     * @return Response
     */
    public function createEntity(Application $app, Request $request)
    {
        $statusCode = 201;
        $contentType = 'json';

    }

    /**
     * @param Application $app
     * @param Request $request
     */
    public function updateEntity(Application $app, Request $request)
    {
        throw new \BadMethodCallException("Feature Not Allowed", 405);
    }

    /**
     * @param Application $app
     * @param Request $request
     */
    public function deleteEntity(Application $app, Request $request)
    {
        throw new \LogicException("Feature Not Allowed", 405);
    }
}

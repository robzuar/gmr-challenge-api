<?php
namespace App\Controller;

use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\View\TwitterBootstrap3View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Doctrine\Persistence\ObjectRepository;

/**
 * Class CrudController
 * @package App\Controller
 */
abstract class CrudController extends AbstractController
{
    const ENTITY_NAME = null;
    const ENTITY_REPOSITORY = null;
    const CONTROLLER_NAMESPACE = null;
    const REPOSITORY_NAMESPACE = null;
    const ENTITY_NAMESPACE = null;
    const TYPE_NAMESPACE = null;
    const PLURAL_NAME = null;
    const SINGULAR_NAME = null;
    const BUNDLE_NAME = "App";


    /**
     * Gets a collection
     * @param Request $request
     * @Route("/", methods={"GET"})
     * @return JsonResponse
     *
     */
    public function getAction(Request $request)
    {
        $code = $request->headers->get('Authorization');
        $user = $this->getAuthorization($code);

        if(!$user){
            return $this->getAuthorizationError();
        }
        $queryBuilder = $this->getRepository()->createQueryBuilder('e');

        list($filterForm, $queryBuilder) = $this->filter($queryBuilder, $request);
        list($entities, $pagerHtml) = $this->paginator($queryBuilder, $request);

        $totalOfRecordsString = $this->getTotalOfRecordsString($queryBuilder, $request);

        $data = [
            "code"	                        => Response::HTTP_OK,
            'totalOfRecordsString'          => $totalOfRecordsString,
            'entities'                      => $entities,
        ];

        $json = json_encode($data);
        return JsonResponse::fromJsonString($json);
    }

    /**
     * Gets a collection
     * @param Request $request
     * @param null $id
     * @Route("/{id}", methods={"GET"})
     * @return JsonResponse
     *
     */
    public function cgetAction(Request $request, $id)
    {
        $code = $request->headers->get('Authorization');
        $user = $this->getAuthorization($code);

        if(!$user){
            return $this->getAuthorizationError();
        }

        $entity =$this->getRepository()->find($id);

        if (!$entity) {
            return $this->getErrorResponseNull();
        }

        $data = [
            "code"	 => Response::HTTP_OK,
            "data"  => $entity
        ];

        $json = json_encode($data);
        return JsonResponse::fromJsonString($json);
    }

    /**
     * @Route("/", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function postAction(Request $request)
    {
        $code = $request->headers->get('Authorization');
        $user = $this->getAuthorization($code);

        if(!$user){
            return $this->getAuthorizationError();
        }

        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return $this->getErrorResponseNull();
        }

        $fields = $this->getRepository()->getFields();
        $fieldsNotNull = $this->getRepository()->getNotBlankFields();

        $entityName = $this::ENTITY_NAMESPACE;
        $entity = new $entityName();
        $formComplete = true;

        foreach($fieldsNotNull as $field){
            if(!array_key_exists($field, $data)){
                $formComplete = false;
            }
        }

        if(!$formComplete){
            return $this->getErrorIncompleteForm();
        }

        foreach($fields as $field){
            if(array_key_exists($field, $data)){
                if(!is_null($field) and $field != 'id'){
                    $method = 'set'.$field;
                    if (!method_exists($entity, $method)) {
                        throw new \Exception('Something bad with methods on entity ');
                    }
                    $entity->$method($data[$field]);
                }
            }
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        $data = [
            "code"	 => Response::HTTP_CREATED,
            "msg"	 => "Created succesfully",
            "id"	 => $entity->getId(),
        ];

        $json = json_encode($data);
        return JsonResponse::fromJsonString($json);
    }

    /**
     * @Route("/{id}", methods={"PUT"})
     * @param Request $request
     * @param int     $id
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function putAction(Request $request, $id)
    {
        $code = $request->headers->get('Authorization');
        $user = $this->getAuthorization($code);

        if(!$user){
            return $this->getAuthorizationError();
        }

        $entity = $this->getRepository()->find($id);
        $data = json_decode($request->getContent(), true);

        if (!$entity || !$data) {
            return $this->getErrorResponseNull();
        }

        $fields = $this->getRepository()->getFields();
        $formComplete = true;

        foreach($data as $field => $value){
            if(!array_key_exists($field, $fields)){
                $formComplete = false;
            }
        }

        if(!$formComplete){
            return $this->getErrorResponseNull();
        }
        foreach($data as $field => $value){
            if(array_key_exists($field, $fields)){
                if(!is_null($field) and $field != 'id'){
                    $method = 'set'.$field;
                    if (!method_exists($entity, $method)) {
                        throw new \Exception('Something bad with methods on entity ');
                    }
                    $entity->$method($value);
                }
            }
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        $data = [
            "code"	 => Response::HTTP_ACCEPTED,
            "msg"	 => "Entity edited successfully",
        ];
        $json = json_encode($data);
        return JsonResponse::fromJsonString($json);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     *
     */
    public function deleteAction(Request $request,  $id)
    {
        $code = $request->headers->get('Authorization');
        $user = $this->getAuthorization($code);

        if(!$user){
            return $this->getAuthorizationError();
        }
        $entity = $this->getRepository()->find($id);
        if (!$entity) {
            return $this->getErrorResponseNull();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        if(!$entity){
            return $this->getErrorResponseError();
        }

        $data = [
            "code"	 => Response::HTTP_ACCEPTED,
            "msg"	 => "Deleted successfully",
        ];
        $json = json_encode($data);
        return JsonResponse::fromJsonString($json);
    }

    /**
     * @return ObjectRepository
     */
    private function getRepository()
    {
        $em = $this->getDoctrine()->getManager();
        return  $em->getRepository('App:'.$this::ENTITY_NAME);
    }

    /**
     * @param $code
     * @return User|object|null
     */
    public function getAuthorization($code)
    {
        $em = $this->getDoctrine()->getManager();

        return $em->getRepository('App:User')->findOneBy(
            [
                'token' => $code
            ]
        );
    }

    /**
     * @return JsonResponse
     */
    public function getAuthorizationError()
    {
        $routeOptions = [
            "code" => Response::HTTP_FAILED_DEPENDENCY,
            "message" => 'User unauthorized'
        ];
        $json = json_encode($routeOptions);
        return JsonResponse::fromJsonString($json);
    }

    /**
     * @return JsonResponse
     */
    public function getErrorMessage($message)
    {
        $routeOptions = [
            "code" => Response::HTTP_INTERNAL_SERVER_ERROR,
            "message" => $message
        ];
        $json = json_encode($routeOptions);
        return JsonResponse::fromJsonString($json);
    }

    /**
     * @return JsonResponse
     */
    public function getErrorResponseNull()
    {

        $routeOptions = [
            "code" => Response::HTTP_UNPROCESSABLE_ENTITY,
            "message" => 'Null Response'
        ];
        $json = json_encode($routeOptions);
        return JsonResponse::fromJsonString($json);
    }

    /**
     * @return JsonResponse
     */
    public function getUnauthorized()
    {

        $routeOptions = [
            "code" => Response::HTTP_UNAUTHORIZED,
            "message" => 'NO ACCESS '
        ];
        $json = json_encode($routeOptions);
        return JsonResponse::fromJsonString($json);
    }


    /**
     * @return JsonResponse
     */
    public function getErrorIncompleteForm()
    {
        $routeOptions = [
            "code" => Response::HTTP_UNPROCESSABLE_ENTITY,
            "message" => 'Require fields missings'
        ];
        $json = json_encode($routeOptions);
        return JsonResponse::fromJsonString($json);
    }

    /**
     * @return JsonResponse
     */
    public function getErrorResponseError()
    {
        $routeOptions = [
            "code" => Response::HTTP_CONFLICT,
            "message" => 'Incomplete Action'
        ];
        $json = json_encode($routeOptions);
        return JsonResponse::fromJsonString($json);
    }

    /**
     * @param $queryBuilder
     * @param $request
     * @return array|JsonResponse
     */
    public function filter($queryBuilder, $request)
    {
        $filterForm = $request->get('search');

        if($filterForm) {
            return $this->getErrorIncompleteForm();
        }

        return array($filterForm, $queryBuilder);
    }

    /**
     * @param $queryBuilder
     * @param $request
     * @return string
     */
    public function getTotalOfRecordsString($queryBuilder, $request)
    {
        $totalOfRecords = $queryBuilder->select('COUNT(e.id)')->getQuery()->getSingleScalarResult();
        $show = $request->get('show', 10);
        $page = $request->get('page', 1);

        $startRecord = ($show * ($page - 1)) + 1;
        $endRecord = $show * $page;

        if ($endRecord > $totalOfRecords) {
            $endRecord = $totalOfRecords;
        }
        return "Showing $startRecord - $endRecord of $totalOfRecords records.";
    }

    /**
     * @param $queryBuilder
     * @param Request $request
     * @return array
     */
    public function paginator($queryBuilder, Request $request)
    {
        //sorting
        $sortCol = $queryBuilder->getRootAlias().'.'.$request->get('sort_col', 'id');
        $queryBuilder->orderBy($sortCol, $request->get('sort_order', 'asc'));
        // Paginator
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage($request->get('show' , 10));

        try {
            $pagerfanta->setCurrentPage($request->get('page', 1));
        } catch (\Pagerfanta\Exception\OutOfRangeCurrentPageException $ex) {
            $pagerfanta->setCurrentPage(1);
        }

        $entities = $pagerfanta->getCurrentPageResults();

        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me, $request)
        {
            $requestParams = $request->query->all();
            $requestParams['page'] = $page;
            return $me->generateUrl($this::getRoutesForEntity()['get'], $requestParams);
        };

        // Paginator - view
        $view = new TwitterBootstrap3View();
        $pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
            'proximity' => 3,
            'prev_message' => 'Anterior ',
            'next_message' => ' Siguiente',
        ));

        return array($entities, $pagerHtml);
    }

    /**
     * @return array
     */
    public function getRoutesForEntity()
    {
        $entityName = $this::ENTITY_NAMESPACE;
        if ($entityName->getRoutesForEntity()) {
            return $entityName->getRoutesForEntity();
        } else {
            return [
                'get'     => strtolower($this::BUNDLE_NAME)."_".strtolower($this::ENTITY_NAME)."_get",
                'cget'      => strtolower($this::BUNDLE_NAME)."_".strtolower($this::ENTITY_NAME)."_cget",
                'post'       => strtolower($this::BUNDLE_NAME)."_".strtolower($this::ENTITY_NAME)."_post",
                'put'      => strtolower($this::BUNDLE_NAME)."_".strtolower($this::ENTITY_NAME)."_put",
                'patch'      => strtolower($this::BUNDLE_NAME)."_".strtolower($this::ENTITY_NAME)."_patch",
                'delete'    => strtolower($this::BUNDLE_NAME)."_".strtolower($this::ENTITY_NAME)."_delete",
            ];
        }
    }
}

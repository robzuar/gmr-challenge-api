<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Job controller.
 *
 * @Route("job")
 *
 * @author Roberto Zuñiga Araya <roberto.zuniga.araya@gmail.com>
 */
class JobController extends CrudController
{
    const ENTITY_NAME = "Job";
    const ENTITY_REPOSITORY = "JobRepository";
    const ENTITY_NAMESPACE = "App\\Entity\\Job";
    const REPOSITORY_NAMESPACE = "App\\Entity\\Job";
    const CONTROLLER_NAMESPACE= "App\\Controler\\JobController";
    const TYPE_NAMESPACE = "App\\Form\\JobType";
    const SINGULAR_NAME = "JOB";
    const PLURAL_NAME = "JOBS";

    /**
     * @return ObjectRepository
     */
    private function getRepository()
    {
        $em = $this->getDoctrine()->getManager();
        return $repository = $em->getRepository('App:'.$this::ENTITY_NAME);
    }

    /**
     * @return array
     */
    public function getRoutesForEntity():array
    {
        return [
            'get'     => strtolower($this::BUNDLE_NAME)."_".strtolower($this::ENTITY_NAME)."_get",
            'cget'      => strtolower($this::BUNDLE_NAME)."_".strtolower($this::ENTITY_NAME)."_cget",
            'post'       => strtolower($this::BUNDLE_NAME)."_".strtolower($this::ENTITY_NAME)."_post",
            'put'      => strtolower($this::BUNDLE_NAME)."_".strtolower($this::ENTITY_NAME)."_put",
            'atch'      => strtolower($this::BUNDLE_NAME)."_".strtolower($this::ENTITY_NAME)."_patch",
            'delete'    => strtolower($this::BUNDLE_NAME)."_".strtolower($this::ENTITY_NAME)."_delete",
        ];
    }

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

        $queryBuilder = $this->getRepository()->getJobsBySubmitter($user);

        list($entities, $queryBuilder) = $this->filter($queryBuilder, $request);
        list($entities) = $this->paginator($queryBuilder, $request);

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

        $submitter = $em->getRepository('App:User')->findOneBy(
            [
                'token' => $code
            ]
        );
        $entity->setSubmitter($submitter);
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
     * @Route("/process", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function processAction(Request $request)
    {
        $code = $request->headers->get('Authorization');
        $user = $this->getAuthorization($code);

        if(!$user){
            return $this->getAuthorizationError();
        }
        $em = $this->getDoctrine()->getManager();

        $processor = $em->getRepository('App:User')->findOneBy(
            [
                'token' => $code
            ]
        );

        $currentJob = $this->getRepository()->findOneBy(
            [
                'processor' => $processor,
                'status'    => 'PROCESSING'
            ]
        );

        if(!is_null($currentJob)){
            return $this->getErrorMessage('User already processing a Job.');
        }

        $job = $this->getRepository()->findOneBy(
            [
                'status' => 'PENDING'
            ],
            [
                'id'    => 'ASC'
            ]
        );

        if(!$job){
            return $this->getErrorMessage('No available Jobs.');
        }

        $now = new \DateTime();
        $job->setProcessor($processor);
        $job->setStartAt($now);
        $job->setStatus('PROCESSING');
        $em = $this->getDoctrine()->getManager();
        $em->persist($job);
        $em->flush();

        $data = [
            "code"	 => Response::HTTP_ACCEPTED,
            "id"  => $job->getId()
        ];

        $json = json_encode($data);
        return JsonResponse::fromJsonString($json);
    }

    /**
     * @Route("/finish", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function finishAction(Request $request)
    {
        $code = $request->headers->get('Authorization');
        $user = $this->getAuthorization($code);

        if(!$user){
            return $this->getAuthorizationError();
        }
        $em = $this->getDoctrine()->getManager();

        $processor = $em->getRepository('App:User')->findOneBy(
            [
                'token' => $code
            ]
        );

        $currentJob = $this->getRepository()->findOneBy(
            [
                'processor' => $processor,
                'status'    => 'PROCESSING'
            ]
        );

        if(is_null($currentJob)){
            return $this->getErrorMessage('No Jobs in progress.');
        }

        $now = new \DateTime();
        $currentJob->setProcessor($processor);
        $currentJob->setEndAt($now);
        $currentJob->setStatus('FINISHED');
        $em = $this->getDoctrine()->getManager();
        $em->persist($currentJob);
        $em->flush();

        $data = [
            "code"	 => Response::HTTP_ACCEPTED,
            "id"  => $currentJob->getId()
        ];

        $json = json_encode($data);
        return JsonResponse::fromJsonString($json);
    }
}

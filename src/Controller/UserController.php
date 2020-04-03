<?php
namespace App\Controller;

use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\Routing\Annotation\Route;

/**
 * User controller.
 *
 * @Route("users")
 *
 * @author Roberto Zuñiga Araya <roberto.zuniga.araya@gmail.com>
 */
class UserController extends CrudController
{

    const ENTITY_NAME = "User";
    const ENTITY_REPOSITORY = "UserRepository";
    const ENTITY_NAMESPACE = "App\\Entity\\User";
    const REPOSITORY_NAMESPACE = "App\\Entity\\User";
    const CONTROLLER_NAMESPACE= "App\\Controler\\UserController";
    const TYPE_NAMESPACE = "App\\Form\\UserType";
    const SINGULAR_NAME = "USER";
    const PLURAL_NAME = "USERS";
    /**
     * @return ObjectRepository
     */
    private function getRepository():ObjectRepository
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
            'patch'      => strtolower($this::BUNDLE_NAME)."_".strtolower($this::ENTITY_NAME)."_patch",
            'delete'    => strtolower($this::BUNDLE_NAME)."_".strtolower($this::ENTITY_NAME)."_delete"
        ];
    }
}

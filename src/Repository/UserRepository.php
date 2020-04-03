<?php
namespace App\Repository;

class UserRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @return array
     */
    public function getFields():array
    {
        return ['id', 'name','email', 'token'];
    }

    /**
     * @return array
     */
    public static function getNotBlankFields():array
    {
        return ['name', 'email'];
    }

}

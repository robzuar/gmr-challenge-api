<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class JobRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function getFields():array
    {
        return ['id', 'submitter', 'processor', 'status', 'command'];
    }

    /**
     * @return array
     */
    public static function getNotBlankFields():array
    {
        return ['command'];
    }

    /**
     * @param $user
     * @return QueryBuilder
     */
    public function getJobsBySubmitter($user):QueryBuilder
    {
        $em = $this->getEntityManager();

       $jobs  = $em->getRepository('App:Job');
        $id = $user->getId();

        return $jobs->createQueryBuilder('e')
            ->select('e')
            ->where("e.submitter = :user AND e.status = :status")
            ->setParameter('user', $id)
            ->setParameter('status', 'PENDING')
            ;
    }

}

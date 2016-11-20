<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Trainings\LearningPath;
use Doctrine\ORM\Query\Expr;

class PersonRepository extends \Doctrine\ORM\EntityRepository
{
    public function findLearningPathTrainers(LearningPath $learningPath)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->leftJoin('p.courses', 'c')
            ->leftJoin('c.sessions', 's')
            ->andWhere('s INSTANCE OF :class')
            ->setParameter('class', $this->getEntityManager()->getClassMetadata('AppBundle\Entity\Sessions\LearningPathSession'))
            ->andWhere($qb->expr()->eq('s.learningPath', $learningPath->getId()))
        ;
//            , Expr\Join::WITH,
//        dump($qb->getQuery()->);

        return $qb->getQuery()->getResult();
    }
}

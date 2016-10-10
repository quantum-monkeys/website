<?php

namespace AppBundle\Manager;

use AppBundle\Repository\LocationRepository;
use Doctrine\ORM\EntityManager;

class LocationManager
{
    /**
     * @var LocationRepository
     */
    protected $repository;

    public function __construct(EntityManager $em)
    {
        $this->repository = $em->getRepository('AppBundle:Location');
    }

    public function getAvailableCities()
    {
        $cities = [];

        $qb = $this->repository->createQueryBuilder('l');

        $qb
            ->select('l.city')
            ->distinct(true);

        $locations = $qb->getQuery()->getResult();

        foreach ($locations as $location) {
            $cities[] = $location['city'];
        }

        return $cities;
    }
}

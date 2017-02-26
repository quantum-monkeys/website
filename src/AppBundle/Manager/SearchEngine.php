<?php

namespace AppBundle\Manager;


use AppBundle\Objects\EventSearch;
use AppBundle\Repository\EventOccurrenceRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr;
use Symfony\Component\HttpFoundation\Request;

class SearchEngine
{
    /**
     * @var EventOccurrenceRepository
     */
    protected $eventOccurenceRepository;

    public function __construct(EntityManager $em)
    {
        $this->eventOccurenceRepository = $em->getRepository('AppBundle:EventOccurrence');
    }

    public function getEventSearch(Request $request = null): EventSearch
    {
        $searchData = $request ? $request->get('event_search') : [];

        $eventSearch = new EventSearch();
        $eventSearch
            ->setCity(!empty($searchData['city']) ? $searchData['city'] : null)
            ->setLang(!empty($searchData['lang']) ? $searchData['lang'] : null)
            ->setFree(isset($searchData['free']) ? intval($searchData['free']) > 0 ? true : false : false)
        ;

        return $eventSearch;
    }

    public function getResults(EventSearch $eventSearch, int $limit = 20)
    {
        $qb = $this->eventOccurenceRepository->createQueryBuilder('eo');
        $qb->andWhere($qb->expr()->gt('eo.begin', ':now'));
        $qb->setParameter('now', new \DateTime());

        if ($eventSearch->isFree()) {
            $qb->andWhere($qb->expr()->eq('eo.free', true));
        }

        if (!is_null($eventSearch->getCity())) {
            $qb->innerJoin(
                'AppBundle\Entity\Location', 'l',
                Expr\Join::WITH, $qb->expr()->andX(
                    $qb->expr()->eq('l.id', 'eo.location'),
                    $qb->expr()->eq('l.city', ':city')
                )
            );
            $qb->setParameter('city', $eventSearch->getCity());
        }

        if (!is_null($eventSearch->getLang())) {
            $qb->andWhere($qb->expr()->like('eo.languages', ':language'));
            $qb->setParameter('language', '%' . $eventSearch->getLang() . '%');
        }

        $qb->orderBy('eo.begin', 'ASC');
        $qb->setMaxResults($limit);

        return $qb->getQuery()->getResult();
    }
}

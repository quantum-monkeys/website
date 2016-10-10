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

    public function getEventSearch(Request $request): EventSearch
    {
        $searchData = $request->get('event_search');

        $eventSearch = new EventSearch();
        $eventSearch
            ->setContent(!empty($searchData['content']) ? $searchData['content'] : null)
            ->setCity(!empty($searchData['city']) ? $searchData['city'] : null)
            ->setLang(!empty($searchData['lang']) ? $searchData['lang'] : null)
            ->setFree(isset($searchData['free']) ? intval($searchData['free']) > 0 ? true : false : false)
        ;

        return $eventSearch;
    }

    public function getResults(EventSearch $eventSearch)
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

        if (!is_null($eventSearch->getContent()) || !is_null($eventSearch->getLang())) {
            $qb->innerJoin(
                'AppBundle\Entity\Event', 'e',
                Expr\Join::WITH, $qb->expr()->eq('e.id', 'eo.event')
            );

            if (!is_null($eventSearch->getContent())) {
                $qb->andWhere($qb->expr()->orX(
                    $qb->expr()->like('e.name', ':content'),
                    $qb->expr()->like('e.description', ':content')
                ));
                $qb->setParameter('content', '%' . $eventSearch->getContent() . '%');
            }

            if (!is_null($eventSearch->getLang())) {
                $qb->andWhere($qb->expr()->like('e.lang', ':lang'));
                $qb->setParameter('lang', '%' . $eventSearch->getLang() . '%');
            }
        }

        $qb->orderBy('eo.begin', 'ASC');

        return $qb->getQuery()->getResult();
    }
}

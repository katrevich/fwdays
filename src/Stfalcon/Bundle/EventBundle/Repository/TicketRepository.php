<?php

namespace Stfalcon\Bundle\EventBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Bundle\UserBundle\Entity\User;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TicketRepository extends EntityRepository
{

//    /**
//     * @return array
//     */
//    public function findAllPaid()
//    {
//        $qb = $this->getEntityManager()
//                ->createQueryBuilder()
//                ->add('select', 't')
//                ->add('from', 'StfalconEventBundle:Ticket t')
//                ->where('t.status = :status')
//                ->setParameter('status', 'paid')
//                ->add('orderBy', 't.status DESC');
//
//        return $qb->getQuery()->getResult();
//    }

    /**
     * Find tickets of active events for some user
     *
     * @param User $user
     *
     * @return array
     */
    public function findTicketsOfActiveEventsForUser(User $user)
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT t
                FROM StfalconEventBundle:Ticket t
                JOIN t.event e
                WHERE e.active = TRUE
                    AND t.user = :user
            ')
            ->setParameter('user', $user)
            ->getResult();
    }
}

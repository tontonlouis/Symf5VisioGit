<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @return Query
     */
    public function findAllVisible(PropertySearch $search): Query
    {

        $query = $this->createQueryBuilder('p')
                    ->andWhere('p.sold = :val')
                    ->setParameter('val', false);

        if($search->getMaxPrice())
        {
            $query->andWhere('p.price <= :max')
                  ->setParameter('max', $search->getMaxPrice());
        }

        if($search->getMinSurface())
        {
            $query->andWhere('p.surface >= :min')
                  ->setParameter('min', $search->getMinSurface());
        }

        if($search->getOptions()->count() > 0 )
        {
            foreach($search->getOptions() as $k => $option){
                $query = $query
                            ->andWhere(":option$k MEMBER OF p.options")
                            ->setParameter(":option$k", $option);

            }
        }
       return $query->getQuery();
            
    }

    /**
     * @return Property[] Returns an array of Property objects
     */
    public function findLastProperty(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.sold = :val')
            ->setParameter('val', false)
            ->setMaxResults(6)
            ->orderBy('p.created_at', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Categorie;
use App\Entity\Production;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Production::class);
    }

    // /**
    //  * @return Categorie[] Returns an array of Categorie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function statsAlveoleParSeance($seance = false, $date = false, $week_start = false, $week_end = false, $month_start = false, $month_end = false)
    {
        $query = $this->createQueryBuilder('production')
            ->select('sum(production.quantite) as quantiteTotale, sum(production.prixUnitaire * production.quantite ) as montantTotal')
//            ->groupBy('production.id')
        ;

        if ($seance == "journaliere")
            $query->andWhere('production.date = :paramDate')->setParameter('paramDate', $date);

        if ($seance == "hebdomadaire")
            $query->andWhere('production.date between :paramWeekStart and :paramWeekEnd')->setParameters(['paramWeekStart'=>$week_start, 'paramWeekEnd'=>$week_end]);

        if ($seance == "mensuelle")
            $query->andWhere('production.date between :paramMonthStart and :paramMonthEnd')->setParameters(['paramMonthStart'=>$month_start, 'paramMonthEnd'=>$month_end]);

        return $query->getQuery()->getResult();
    }

}

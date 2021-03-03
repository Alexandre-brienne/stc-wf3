<?php

namespace App\Repository;

use App\Entity\Messagerie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Messagerie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Messagerie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Messagerie[]    findAll()
 * @method Messagerie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessagerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Messagerie::class);
    }

    // /**
    //  * @return Messagerie[] Returns an array of Messagerie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function MpUser($expediteur,$destinataire)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m
            FROM App\Entity\Messagerie m
            JOIN App\Entity\user u
            WHERE m.expediteur  = :id AND m.destinataire = :id2  OR m.expediteur  = :id2 AND m.destinataire = :id 
            ORDER BY m.date_envoi ASC'
        )->setParameter('id', $expediteur)
            ->setParameter('id2', $destinataire);
        return $query->getResult();
    }

    // public function SelectMpsUser($expediteur,$destinataire)
    // {


    //     $conn = $this->getEntityManager()->getConnection();
    //     $sql = "SELECT user.username as messagede ,des.username as name2,messagerie.message,messagerie.expediteur_id,messagerie.date_envoi FROM `messagerie` 
    //              left JOIN user ON messagerie.expediteur_id = user.id
    //             left JOIN user as des on messagerie.destinataire_id = des.id
    //             WHERE user.username = ':expediteur' AND des.username = ':destinataire' OR user.username = 'alexandra' AND des.username = 'destinataire2'
    //             ORDER BY `messagerie`.`date_envoi` ASC
        
    //      ";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->execute([
    //         ':expediteur' => $expediteur,
    //         ':expediteur2' => $expediteur,
    //         ':destinataire' => $destinataire,
    //         ':destinataire2' => $destinataire
    //     ]);
    //     return $stmt->fetchAllAssociative();
    // }
}

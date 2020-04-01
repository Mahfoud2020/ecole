<?php

namespace App\Repository;

use App\Entity\User;
//use App\Entity\Role as trole;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

  /*  
    public function findOneByName($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function findJoin(): array
    {
        // automatically knows to select users joined with Roles
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.price > :price')
            ->setParameter('price', $price)
            ->orderBy('p.price', 'ASC')
            ->getQuery();

        return $qb->execute();

        // to get just one result:
        // $product = $qb->setMaxResults(1)->getOneOrNullResult();
    }
    // requete par utilisateur
    public function ByUserName($name)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT u.id, u.roles, u.username, u.email, u.password, r.nom '
        . 'FROM App\Entity\User u '
        . 'JOIN App\Entity\Role r '
        . 'where r.id = u.role ');

        if ($name != null) {
        $query = $em->createQuery('SELECT u.id, u.roles, u.username, u.email, u.password, r.nom '
        . 'FROM App\Entity\User u '
        . 'JOIN App\Entity\Role r '
        . 'where r.id = u.role '
        . 'and u.username = :p ')
        ->setParameter('p',$name);
        } 
       return $query->getResult();
    }

// requete par role
    public function getUsersRoles($role) {

        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT u.id, u.roles, u.username, u.email, u.password, r.nom '
        . 'FROM App\Entity\User u '
        . 'JOIN App\Entity\Role r '
        . 'where r.id = u.role ');
        if ($role != null) {
            $query = $em->createQuery('SELECT u.id, u.roles, u.username, u.email, u.password, r.nom '
            . 'FROM App\Entity\User u '
            . 'JOIN App\Entity\Role r '
            . 'where r.id = u.role '
            . 'and r.nom = :p ')
            ->setParameter('p',$role); 
        }
        return $query->getResult();
      }
    // requete
}

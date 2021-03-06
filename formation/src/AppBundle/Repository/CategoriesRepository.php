<?php

namespace AppBundle\Repository;

/**
 * CategoriesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoriesRepository extends \Doctrine\ORM\EntityRepository
{

    public function getCategories()
    {
        $query = $this->createQueryBuilder('categories')
            ->select('categories.name')
            ->getQuery()
            ->getResult(); // Renvoie un tableau dans un tableau
            //->getSingleResult(); // Renvoie un simple tableau
        return $query;
    }

}

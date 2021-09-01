<?php


namespace App\Filtres;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;

use ApiPlatform\Core\Api\FilterInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractFilter;
use App\Entity\Counter;
use Doctrine\ORM\EntityManagerInterface;


use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;


final class TestFilter extends AbstractFilter
{

    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        
        $queryBuilder
        ->innerJoin('App\Entity\Counter','c',Join::WITH,'o = c.image')
        ->orderBy('c.image','DESC');
    }
    
    public function getDescription(string $resourceClass): array
    {

        $description = [];

            $description['popular for week'] = [

                'type' => 'bool',
                'required' => false,
                
                'swagger' => [
                    'description' => 'Filter using a regex. This will appear in the Swagger documentation!',
                    'name' => 'Custom name to use in the Swagger documentation',
                    'type' => 'Will appear below the name in the Swagger documentation',
                ],
            ];


        return $description;
    }

    

}
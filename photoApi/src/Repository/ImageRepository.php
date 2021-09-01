<?php

namespace App\Repository;

use App\Entity\Image;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Image|null find($id, $lockMode = null, $lockVersion = null)
 * @method Image|null findOneBy(array $criteria, array $orderBy = null)
 * @method Image[]    findAll()
 * @method Image[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageRepository extends ServiceEntityRepository implements ImageRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * ImageRepository constructor.
     * @param ManagerRegistry $registry
     * @param EntityManagerInterface $manager
     */
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        parent::__construct($registry, Image::class);
    }

    /**
     * @param Image $image
     * @return object
     */
    public function setCreate(Image $image): object
    {

        $image->setIsNew(true);
        $image->setIsPopular(false);
        $this->manager->persist($image);
        $this->manager->flush();
        return $image;
    }

    /**
     * @param int $idImage
     * @return object
     */
    public function getOne(int $idImage): object
    {
        return parent::find($idImage);
    }

    /**
     * @param Image $category
     */
    public function setDelete(Image $image)
    {
        $this->manager->remove($image);
        $this->manager->flush();
    }
}

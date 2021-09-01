<?php

namespace App\Repository;

use App\Entity\File;
use App\Services\FileManagerServiceInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method File|null find($id, $lockMode = null, $lockVersion = null)
 * @method File|null findOneBy(array $criteria, array $orderBy = null)
 * @method File[]    findAll()
 * @method File[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FileRepository extends ServiceEntityRepository implements FileRepositoryInterface
{
    private $manager;


    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        parent::__construct($registry, File::class);
    }


    public function setCreate(File $file): object
    {
        $this->manager->persist($file);
        $this->manager->flush();
        return $file;
    }

    public function getOne(int $idFile): object{

        return parent::find($idFile);
    }

    public function setDelete(File $file)
    {
        $this->manager->remove($file);
        $this->manager->flush();
    }
}

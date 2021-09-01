<?php


namespace App\Repository;


use App\Entity\File;

interface FileRepositoryInterface
{
    /**
     * @param File $file
     * @return object
     */
    public function setCreate(File $file): object;

    /**
     * @param int $idFile
     * @return object
     */
    public function getOne(int $idFile): object;

    /**
     * @param File $file
     * @return mixed
     */
    public function setDelete(File $file);
}
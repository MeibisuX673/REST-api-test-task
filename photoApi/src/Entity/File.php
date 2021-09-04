<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *      itemOperations={
 *          "get"={
 *               "normalization_context"={"groups"="normalization:item:get"}
 *          },
 *         
 *          
 *       },
 *      collectionOperations={
 *          "get"={
 *               "normalization_context"={"groups"="normalization:collection:get"}
 *           },
 * },
 * attributes={"pagination_items_per_page"=12},
 * )
 * @ApiFilter(SearchFilter::class, properties={"id": "exact"})
 * @ORM\Entity(repositoryClass=FileRepository::class)
 *
 */
class File
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"normalization:item:get","normalization:collection:get"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"normalization:item:get","normalization:collection:get"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $path;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }



}

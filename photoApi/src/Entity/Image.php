<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use App\Repository\ImageRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use App\Controller\GetItemImageOperationAction;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\CreateImageActionController;
use App\Controller\DeleteImageActionController;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;


/**
 * @ApiResource(
 *      itemOperations={
 *      "get" = {
 *          "normalization_context"={"groups"="normalization:item:get"},
 *          "method" = "GET",
 *          "controller" = GetItemImageOperationAction::class,
 *     },
 *      "patch",
 *      "delete" = {
 *          "controller"=DeleteImageActionController::class
 *      },
 * },
 *      collectionOperations={
 *      "get" = {
 *           "normalization_context"={"groups"="normalization:collection:get"},
 *      },
 *     "post"={
 *             "normalization_context"={"groups"="normalization:collection:post"},
 *             "controller"=CreateImageActionController::class,
 *             "deserialize"=false,

 *             "validation_groups"={"Default", "media_object_create"},
 *             "openapi_context"={
 *                 "requestBody"={
 *                     "content"={
 *                         "multipart/form-data"={
 *                             "schema"={
 *                                 "type"="object",
 *                                 "properties"={
 *
 *                                     "file"={
 *                                         "type"="string",
 *                                         "format"="binary"
 *                                     },
 *                                      "name"={
 *                                         "type"="string"
 *
 *                                     },
 *
 *                                      "description"={
 *                                         "type"="string",
 *
 *                                     }
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             }
 *
 *         },
 *
 *
 *      },
 *
 *      denormalizationContext={"groups"={"write"}},
 * 
 *      attributes={"pagination_items_per_page"=3},
 * )
 *  @ApiFilter(SearchFilter::class, properties={"id": "exact","name": "start"})
 *  @ApiFilter(OrderFilter::class, properties={"id": "DESC"})
 *  @ApiFilter(BooleanFilter::class, properties={"is_new","is_popular"})
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"normalization:item:get,"normalization:collection:get","normalization:collection:post"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"write","normalization:item:get,"normalization:collection:get","normalization:collection:post"})
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     * @Groups({"write","normalization:item:get","normalization:collection:get","normalization:collection:post"})
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"normalization:item:get"})
     */
    private $is_new;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read","normalization:item:get"})
     *
     */
    private $is_popular;

    /**
     * @ORM\OneToOne(targetEntity=File::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"normalization:collection:get","normalization:item:get","normalization:collection:post"})
     */
    private $file;



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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsNew(): ?bool
    {
        return $this->is_new;
    }

    public function setIsNew(bool $is_new): self
    {
        $this->is_new = $is_new;

        return $this;
    }

    public function getIsPopular(): ?bool
    {
        return $this->is_popular;
    }

    public function setIsPopular(bool $is_popular): self
    {
        $this->is_popular = $is_popular;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(File $file): self
    {
        $this->file = $file;

        return $this;
    }

    
    private int $counter = 0;

    public function setCounter(int $counter){
        $this->counter = $counter;

    }
    /**
     * @Groups({"normalization:item:get"})
     */
    public function getCounter(): int
    {
        return $this->counter;
    }
}

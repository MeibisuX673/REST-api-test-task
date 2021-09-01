<?php


namespace App\Services\Counter;



use App\Entity\Counter;
use App\Entity\Image;
use App\Repository\CounterRepositoryInterface;

/**
 * Class CounterService
 * @package App\Services\Counter
 */
class CounterService
{
    /**
     * @var CounterRepositoryInterface
     */
    private CounterRepositoryInterface $counterRepository;

    /**
     * CounterService constructor.
     * @param CounterRepositoryInterface $counterRepository
     */
    public function __construct(CounterRepositoryInterface $counterRepository)
    {
        $this->counterRepository = $counterRepository;
    }

    /**
     * @param Image $image
     */
    public function handleCreate(Image $image){
        $counter = new Counter();
        $counter->setImageId($image);
        $this->counterRepository->setCreate($counter);
    }

}
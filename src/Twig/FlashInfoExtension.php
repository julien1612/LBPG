<?php

namespace App\Twig;

use App\Repository\FlashInfoRepository;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class FlashInfoExtension extends AbstractExtension implements GlobalsInterface
{
    private $flashRepo;

    public function __construct(FlashInfoRepository $flashRepo)
    {
        $this->flashRepo = $flashRepo;
    }

    public function getGlobals(): array
    {
        return [
            'flash' => $this->flashRepo->findOneBy(['isActive' => true], ['id' => 'DESC']),
        ];
    }
}
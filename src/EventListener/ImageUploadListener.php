<?php

namespace App\EventListener;

use App\Entity\Image;
use App\Service\ImageOptimizer;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

#[AsEntityListener(event: Events::postPersist, method: 'processImage', entity: Image::class)]
#[AsEntityListener(event: Events::postUpdate, method: 'processImage', entity: Image::class)]
class ImageUploadListener
{
    public function __construct(
        private ImageOptimizer $imageOptimizer,
        private string $targetDirectory
    ) {}

    public function processImage(Image $entity, LifecycleEventArgs $args): void
    {
        $filename = $entity->getNom(); 

        if ($filename && !str_ends_with($filename, '.webp')) {
            $fullPath = $this->targetDirectory . '/' . $filename;

            if (file_exists($fullPath)) {
                $newFilename = $this->imageOptimizer->convertToWebp($fullPath);
                
                $entity->setNom($newFilename);

                $args->getObjectManager()->flush();
            }
        }
    }
}
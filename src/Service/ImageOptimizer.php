<?php

namespace App\Service;

class ImageOptimizer
{
    public function convertToWebp(string $sourcePath): string
    {
        // 1. On vérifie si le fichier existe
        if (!file_exists($sourcePath)) {
            return basename($sourcePath);
        }

        $pathInfo = pathinfo($sourcePath);
        $dirname = $pathInfo['dirname'];
        $filename = $pathInfo['filename'];
        $extension = strtolower($pathInfo['extension']);

        // Si c'est déjà du webp, on ne fait rien
        if ($extension === 'webp') {
            return $pathInfo['basename'];
        }

        // 2. On crée la ressource image selon le type
        $image = match($extension) {
            'jpeg', 'jpg' => @imagecreatefromjpeg($sourcePath),
            'png'         => @imagecreatefrompng($sourcePath),
            'gif'         => @imagecreatefromgif($sourcePath),
            default       => null,
        };

        // Si le format n'est pas supporté ou l'image corrompue
        if (!$image) {
            return $pathInfo['basename'];
        }

        // 3. Préparation du nouveau chemin
        $destination = $dirname . '/' . $filename . '.webp';

        // 4. Gestion de la transparence (important pour PNG/GIF)
        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);

        // 5. Sauvegarde en WebP (Qualité 80 = excellent ratio poids/qualité)
        if (imagewebp($image, $destination, 80)) {
            imagedestroy($image);
            
            // 6. Suppression de l'original (JPG/PNG) pour gagner de la place
            unlink($sourcePath);
            
            return $filename . '.webp';
        }

        imagedestroy($image);
        return $pathInfo['basename'];
    }
}
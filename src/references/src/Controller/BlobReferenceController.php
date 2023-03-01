<?php

declare(strict_types=1);

namespace App\Controller;

use App\Helper\BlobReferenceCounterHelper;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlobReferenceController extends AbstractController
{
    #[Route('/reference/inconsistencies', name: 'reference_inconsistencies', methods: ['GET'])]
    #[Template('references/inconsistencies.html.twig')]
    public function viewReferencesInconsistencies(BlobReferenceCounterHelper $blobReferenceCounterHelper): array
    {
        return $blobReferenceCounterHelper->getReferencesInconsistencies();
    }
}
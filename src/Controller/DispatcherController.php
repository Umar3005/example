<?php

namespace App\Controller;

use App\Model\Command\RedirectCommand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class DispatcherController extends AbstractController
{
    protected EntityManagerInterface $entityManager;

    protected RedirectCommand $redirectCommand;

    public function __construct(EntityManagerInterface $entityManager, RedirectCommand $redirectCommand)
    {
        $this->entityManager = $entityManager;
        $this->redirectCommand = $redirectCommand;
    }

    /** @throws TransportExceptionInterface */
    #[Route('/{link}', name: 'dispatcher', requirements: ['link' => '\w+'])]
    public function index(?string $link): Response
    {
        $redirectUrl = $this->redirectCommand->execute($link);
        return $this->redirect($redirectUrl);
    }
}

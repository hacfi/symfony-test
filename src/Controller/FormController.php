<?php

namespace App\Controller;

use App\Form\ThemeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    #[Route('/form', name: 'form')]
    public function index(): Response
    {
        $form = $this->createForm(ThemeType::class);

        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
            'form' => $form->createView(),
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\BaseController;
use App\Entity\Contact;
use App\Entity\Project;
use App\Entity\Show;
use App\Entity\User;
use App\Form\ContactFormType;
use App\Repository\ContentEntityRepository;
use App\Repository\ProjectRepository;
use App\Repository\ShowRepository;
use App\Repository\VideoRepository;
use App\Repository\ZamuaFilesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MainController extends BaseController
{

    /**
     * @Route("/", name="app_homepage")
     */
    public function index(ProjectRepository $projectRepository,  Request $request, EntityManagerInterface $em): Response
    {

        $projects= $projectRepository->findBy([],
            [
                'priority' => 'ASC'
            ]
        );

        //Contact form
        // $contact = new Contact();
        // $form = $this->createForm(ContactFormType::class, $contact);

        // $form->handleRequest($request);

        // if($form->isSubmitted() && $form->isValid()){

        //     $contact = $form->getData();
        //     $contact
        //         ->setIsActive(true)
        //         ->setIsDone(false)
        //         ->setIsSent(false)
        //     ;
            
        //     $em->persist($contact);
        //     $em->flush();

        //     $this->addFlash('successMessage', 'Il tuo messaggio é stato inviato. Grazie!');
        //     return $this->redirectToRoute('app_home', ['_fragment' => 'contact-frame']);
        // }
        return $this->render('main/homepage.html.twig', [
            'activeName' => 'Home',
            'projects' => $projects,
            // 'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/encode", name="encode")
     */
    public function encodePass(UserPasswordEncoderInterface $passwordEncoderInterface)
    {
        $user = new User();
        $pass = 'helloAdmin!';
        $hashed = $passwordEncoderInterface->encodePassword($user, $pass );
        dd($hashed);

    }

}
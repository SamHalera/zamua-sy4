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
     * @Route("/", name="app_home")
     */
    public function index(ProjectRepository $projectRepository,  Request $request, EntityManagerInterface $em): Response
    {

        $projects= $projectRepository->findBy([],
            [
                'priority' => 'ASC'
            ]
        );

        //Contact form
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $contact = $form->getData();
            $contact
                ->setIsActive(true)
                ->setIsDone(false)
                ->setIsSent(false)
            ;
            
            $em->persist($contact);
            $em->flush();

            $this->addFlash('successMessage', 'Il tuo messaggio é stato inviato. Grazie!');
            return $this->redirectToRoute('app_home', ['_fragment' => 'contact-frame']);
        }
        return $this->render('main/homepage.html.twig', [
            'activeName' => 'Home',
            'projects' => $projects,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/biografia", name="app_bio")
     */
    public function biography(ZamuaFilesRepository $zamuaFilesRepository): Response
    {
        $media = $zamuaFilesRepository->findBy(
            [
                'isGalleryItem' => true
            ],
            [
                'priority' => 'ASC'
            ],
            10
        );
        return $this->render('main/bio.html.twig', [
            'activeName' => 'Bio',
            'media' =>$media
        ]);
    }
    
     /**
     * @Route("/contatti", name="app_contact")
     */
    public function contact(Request $request, EntityManagerInterface $em): Response
    {

        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $contact = $form->getData();
            $contact
                ->setIsActive(true)
                ->setIsDone(false)
                ->setIsSent(false)
            ;

           
            
            $em->persist($contact);
            $em->flush();

            $this->addFlash('successMessage', 'Il tuo messaggio é stato inviato. Grazie!');
            return $this->redirectToRoute('app_contact');

        }
        return $this->render('main/contact.html.twig', [
            'activeName' => 'Contatti',
            'form' => $form->createView()
        ]);
    }
    
     /**
     * @Route("/galleria", name="app_gallery")
     */
    public function gallery(ZamuaFilesRepository $zamuaFilesRepository): Response
    {
        $itemsGallery = $zamuaFilesRepository->findBy(
            [
                'isGalleryItem' => true
            ],
            [
                'priority' => 'ASC'
            ]
        );

        return $this->render('main/gallery.html.twig', [
            'activeName' => 'Galleria',
            'itemsGallery' => $itemsGallery
        ]);
    }
    
     /**
     * @Route("/i-miei-ascolti", name="app_listenings")
     */
    public function listenings(): Response
    {
        return $this->render('main/in-my-ears.html.twig', [
            'activeName' => 'I Miei ascolti'
        ]);
    }
    
     /**
     * @Route("/musica", name="app_music")
     */
    public function music(): Response
    {
        return $this->render('main/music.html.twig', [
            'activeName' => 'Musica'
        ]);
    }
    
    
     /**
     * @Route("/progetti", name="app_projects")
     */
    public function projects(ProjectRepository $projectRepository): Response
    {
        $projects= $projectRepository->findBy([],
            [
                'priority' => 'ASC'
            ]
        );
        
        return $this->render('main/projects.html.twig', [
            'activeName' => 'Progetti',
            'projects' => $projects,
            //'media' => $media
        ]);
    }
   
    /**
     * @Route("/shows", name="app_shows")
     */
    public function shows(ShowRepository $showRepository): Response
    {
        $shows = $showRepository->findAll();
        return $this->render('main/shows.html.twig', [
            'activeName' => 'Shows',
            'shows' => $shows
        ]);
    }
    
     /**
     * @Route("/video", name="app_video")
     */
    public function video(VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findBy([],
            [
                'priority' => 'ASC'
            ]
        );

        return $this->render('main/video.html.twig', [
            'activeName' => 'Video',
            'videos' => $videos
        ]);
    }

    /**
     * @Route("/cookies", name="app_cookies")
     */
    public function cookies()
    {
        return $this->render('main/cookies.html.twig');

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
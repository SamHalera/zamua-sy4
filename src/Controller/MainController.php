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
use Symfony\Component\CssSelector\XPath\TranslatorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Contracts\Translation\TranslatorInterface as TranslationTranslatorInterface;

use function Symfony\Component\String\u;

class MainController extends BaseController
{

    /**
     * @Route({
     *          "it": "/",
     *          "fr": "/",
     *          "en": "/"
     *      }, name="app_home")
     */
    public function index(ProjectRepository $projectRepository,  Request $request, EntityManagerInterface $em, TranslationTranslatorInterface $translator): Response
    {

        // $projects= $projectRepository->findBy([],
        //     [
        //         'priority' => 'ASC'
        //     ]
        // );

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

            $this->addFlash('successMessage', $translator->trans('message.send.success'));
            
            return $this->redirectToRoute('app_home', ['_fragment' => 'contact-frame']);
        }
        return $this->render('main/homepage.html.twig', [
            'activeName' => 'Home',
            // 'projects' => $projects,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(
     *      {
     *          "it": "/biografia",
     *          "fr": "/biographie",
     *          "en": "/biography"
     *      },
*           name="app_bio"
     * )
     */
    public function biography(ZamuaFilesRepository $zamuaFilesRepository, Request $request): Response
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
     * @Route({
     *          "it": "/contatti",
     *          "fr": "/contact",
     *          "en": "/contact"
     *      }, name="app_contact")
     */
    public function contact(Request $request, EntityManagerInterface $em, TranslationTranslatorInterface $translator): Response
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

            $this->addFlash('successMessage', $translator->trans('message.send.success'));

            return $this->redirectToRoute('app_contact');

        }
        return $this->render('main/contact.html.twig', [
            'activeName' => $translator->trans('active.name.contact'),
            'form' => $form->createView()
        ]);
    }
    
     /**
     * @Route({
     *          "it": "/foto",
     *          "fr": "/photos",
     *          "en": "/photos"
     *      }, name="app_gallery")
     */
    public function gallery(ZamuaFilesRepository $zamuaFilesRepository, TranslationTranslatorInterface $translator): Response
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
            'activeName' => $translator->trans('active.name.photo'),
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
     * @Route({
     *          "it": "/musica",
     *          "fr": "/musique",
     *          "en": "/music"
     *      },name="app_music")
     */
    public function music(TranslationTranslatorInterface $translator): Response
    {
        return $this->render('main/music.html.twig', [
            'activeName' => $translator->trans('active.name.music'),
        ]);
    }
    
    
     /**
     * @Route({
     *          "it": "/progetti",
     *          "fr": "/projets",
     *          "en": "/projects"
     *      }, name="app_projects")
     */
    public function projects(ProjectRepository $projectRepository, Request $request, TranslationTranslatorInterface $translator): Response
    {
        // $projects= $projectRepository->findBy([],
        //     [
        //         'priority' => 'ASC'
        //     ]
        // );
        $locale = $request->getLocale();
        
        $projects = $projectRepository->findProjectandTranslation();
        
        return $this->render('main/projects.html.twig', [
            'activeName' => $translator->trans('active.name.project'),
            'projects' => $projects,
            //'media' => $media
        ]);
    }
   
    /**
     * @Route({
     *          "it": "/concerti",
     *          "fr": "/concerts",
     *          "en": "/shows"
     *      }, name="app_shows")
     */
    public function shows(ShowRepository $showRepository, TranslationTranslatorInterface $translator): Response
    {
        $shows = $showRepository->findBy(
            [
                'isPassed' => true,
                'isCancelled' => true
            ]
        );
        return $this->render('main/shows.html.twig', [
            'activeName' => 'Shows',
            'shows' => $shows
        ]);
    }
    
     /**
     * @Route({
     *          "it": "/video",
     *          "fr": "/videos",
     *          "en": "/videos"
     *      }, name="app_video")
     */
    public function video(VideoRepository $videoRepository, TranslationTranslatorInterface $translator): Response
    {
        $videos = $videoRepository->findBy([],
            [
                'priority' => 'ASC'
            ]
        );

        return $this->render('main/video.html.twig', [
            'activeName' => $translator->trans('active.name.video'),
            'videos' => $videos
        ]);
    }

    /**
     * @Route({
     *          "it": "/playlists",
     *          "fr": "/playlists",
     *          "en": "/playlists"
     *      }, name="app_playlists")
     */
    public function playlists(TranslationTranslatorInterface $translator)
    {
        return $this->render('main/playlists.html.twig', [
            'activeName' => $translator->trans('active.name.playlists'),
        ]);
    }

    /**
     * @Route({
     *          "it": "/cookies",
     *          "fr": "/cookies",
     *          "en": "/cookies"
     *      }, name="app_cookies")
     */
    public function cookies()
    {
        return $this->render('main/cookies.html.twig', [
            'activeName' => 'Cookies'
        ]);

    }

    /**
     * @Route({
     *          "it": "/crediti",
     *          "fr": "/credits",
     *          "en": "/credits"
     *      }, name="app_credits")
     */
    public function credits(ZamuaFilesRepository $zamuaFilesRepository, TranslationTranslatorInterface $translator)
    {

        //$credits = $zamuaFilesRepository->findZamuaFilesCredits();

        $zamuaFiles = $zamuaFilesRepository->findBy(
            [
                'isGalleryItem' => true
            ],
            [
            'credit' => 'ASC'
            ]
        );
        
        $credits = [];

        foreach ($zamuaFiles as $file) {
            if(!is_null($file->getCredit()) && !is_null($file->getCreditLink())){
                $credits[] = [
                    'credit' => $file->getCredit(),
                    'link' => $file->getCreditLink()
                ]; 
            } elseif(!is_null($file->getCredit()) && is_null($file->getCreditLink())){
                $credits[] = [
                    'credit' => $file->getCredit()
                ]; 
            }
            
        }
        $allCredits = array_unique($credits, SORT_REGULAR);
        //dd($allCredits);
        return $this->render("main/credits.html.twig", [
            'zamuaFiles' => $allCredits,
            'activeName' => $translator->trans('active.name.credits')
        ]);
    }
    /**
     * @Route("/change_locale/{_locale}" , name="app_change_locale")
     */
    public function changeLocal(string $_locale, Request $request, RouterInterface $routerInterface)
    {
        // We keep the language into the session
        $request->getSession()->set('_locale', $_locale);

        $referer = $request->headers->get('referer');

        if($referer === null || u($referer)->ignoreCase()->startsWith($request->getSchemeAndHttpHost()) === false ){
            return $this->redirectToRoute('app_home');
        }

        $path = parse_url(
            $referer,
            PHP_URL_PATH
        );

        if(is_string($path) === false){
            throw new BadRequestHttpException();
        }

        try {
            $routerParameter = $routerInterface->match($path);

        } catch(\Exception $error){
            return $this->redirectToRoute('app_home', [
                '_locale' => $_locale
            ]);
        }

        return $this->redirectToRoute($routerParameter['_route'],
            [
                '_locale' => $_locale
            ]
        );
        
        
        //We come back to the previous page
        //return $this->redirect($request->headers->get('referer'));

        //return $this->redirectToRoute('app_home');
    }

    /**
     * @Route("/test/{_locale}/testTrans", name="test")
     */
    public function routeTest($locale, Request $request)
    {
        return $this->render('main/test.html.twig');
    }
    /**
     * @Route("/encode", name="encode")
     */
    public function encodePass(UserPasswordEncoderInterface $passwordEncoderInterface)
    {
        $user = new User();
        $pass = 'Mwaramutse!$';
        $hashed = $passwordEncoderInterface->encodePassword($user, $pass );
        dd($hashed);

    }


   
    

}
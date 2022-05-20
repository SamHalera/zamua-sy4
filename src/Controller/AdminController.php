<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\ContentEntity;
use App\Entity\Project;
use App\Entity\ProjectMember;
use App\Entity\ProjectTranslation;
use App\Entity\Show;
use App\Entity\TextContent;
use App\Entity\Video;
use App\Entity\ZamuaFiles;
use App\Form\ContentFormType;
use App\Form\EditMediaFormType;
use App\Form\FileFormType;
use App\Form\ProjectFormType;
use App\Form\ProjectMembersFormType;
use App\Form\ProjectTranslationFormType;
use App\Form\ShowFormType;
use App\Form\TextFieldFormType;
use App\Form\VideoFormType;
use App\Repository\ContactRepository;
use App\Repository\ContentEntityRepository;
use App\Repository\ProjectMemberRepository;
use App\Repository\ProjectRepository;
use App\Repository\ShowRepository;
use App\Repository\VideoRepository;
use App\Repository\ZamuaFilesRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'activeName' => 'ADMIN'
        ]);
    }
    

    
    /**
     * @Route("/admin/show/new", name="app_admin_show_new")
     */
    public function newShow(EntityManagerInterface $em, Request $request){

        
        $form = $this->createForm(ShowFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            /**
             * @var Show $show
             */
            $data = $form->getData();

            //dd($data->getDate());
            $show = new Show();

            $show
                ->setDate($data->getDate())
                ->setName($data->getName())
                ->setVenue($data->getVenue())
                ->setVenueUrl($data->getVenueUrl())
                ->setLocation($data->getLocation())
                ->setIsCancelled(false)
                ->setIsPassed(false)
            ;

            $em->persist($show);
            $em->flush();

            $this->addFlash('success', 'New show has been created');

            return $this->redirectToRoute('app_admin_show_list');
        }
        return $this->render('admin/new-show.html.twig', [
            'activeName' => 'ADMIN',
            'showForm' => $form->createView()
        ]);
    }

    
    /**
     * @Route("/admin/show/{id}/edit", name="app_admin_show_edit")
     */
    public function editShow(EntityManagerInterface $em, Request $request, Show $show){

        
        $form = $this->createForm(ShowFormType::class, $show);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            /**
             * @var Show $show
             */
            $show = $form->getData();
            $em->persist($show);
            $em->flush();

            $this->addFlash('success', 'The show has been updated');

            return $this->redirectToRoute('app_admin_show_list');
        }
        return $this->render('admin/edit-show.html.twig', [
            'activeName' => 'ADMIN',
            'showForm' => $form->createView()
        ]);
    }


    //#[Route('/admin/showList', name:'app_admin_show_list')]
    /**
    * @Route("/admin/showList", name="app_admin_show_list")
    */
    public function showList(EntityManagerInterface $em, ShowRepository $showRepository)
    {
        $shows = $showRepository->findAll();
        
        return $this->render('admin/show-list.html.twig', [
            'activeName' => 'ADMIN',
            'shows' => $shows
        ]);
    }

    
    /**
     * @Route("/admin/member/new", name="app_admin_member_new")
     */
    public function newMember(EntityManagerInterface $em, Request $request){

        
        $form = $this->createForm(ProjectMembersFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            /**
             * @var ProjectMember $projectMember
             */
            $data = $form->getData();

            //dd($data->getFirstName());
            $projectMember = new ProjectMember();

            $projectMemberFirstName = $data->getFirstName() ?? null;
            $projectMemberLastName = $data->getLastName() ?? null;
            $projectMemberArtirstName = $data->getArtistName() ?? null;
            $projectMember
                ->setFirstName($projectMemberFirstName)
                ->setLastName($projectMemberLastName)
                ->setArtistName($projectMemberArtirstName)
                ->setFeatures($data->getFeatures())
                ->setFeaturesIt($data->getFeaturesIt())
                ->setFeaturesFr($data->getFeaturesFr())
            
                ;

            $em->persist($projectMember);
            $em->flush();

            $this->addFlash('success', 'A new member has been created');
            return $this->redirectToRoute('app_admin_member_list');
        }
        return $this->render('admin/new-project-member.html.twig', [
            'activeName' => 'ADMIN',
            'memberForm' => $form->createView()
        ]);
    }
    

    /**
    * @Route("/admin/member/{id}/edit", name="app_admin_member_edit")
    */
    public function editMember(EntityManagerInterface $em, Request $request, ProjectMember $projectMember){

        
        $form = $this->createForm(ProjectMembersFormType::class, $projectMember);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            /**
             * @var ProjectMember $projectMember
             */
            $projectMember = $form->getData();

            $em->persist($projectMember);
            $em->flush();

            $this->addFlash('success', 'The member has been updated!');
            return $this->redirectToRoute('app_admin_member_list');
        }
        return $this->render('admin/new-project-member.html.twig', [
            'activeName' => 'ADMIN',
            'memberForm' => $form->createView()
        ]);
    }

    
    /**
    * @Route("/admin/memberList", name="app_admin_member_list")
    */
    public function memberList(EntityManagerInterface $em, ProjectMemberRepository $memberRepository)
    {
        $projectMembers= $memberRepository->findAll();
        
        return $this->render('admin/project-members-list.html.twig', [
            'activeName' => 'ADMIN',
            'projectMembers' => $projectMembers
        ]);
    }


    /**
    * @Route("/admin/project/new", name="app_admin_project_new")
    */
    public function newProject(EntityManagerInterface $em, Request $request, ProjectRepository $projectRepository)
    {
        $projects = $projectRepository->findAll();
        $priorityValue = count($projects) + 1;
        
        $form = $this->createForm(ProjectFormType::class);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){

            /**
             * @var Project $project
             */
            $data = $form->getData();

            $project = new Project();

            $projectFirstTitle = $data->getFirstTitle() ?? null;
            $projectSecondTitle = $data->getSecondTitle() ?? null;
            $project
                ->setMainTitle($data->getMainTitle())
                ->setFirstTitle($projectFirstTitle)
                ->setSecondTitle($projectSecondTitle)
                ->setContent($data->getContent())
                ->setPriority($data->getPriority())
            ;
            
            foreach($data->getMembers() as $oneMember){
                $project->addMember($oneMember);
            }
        
            $em->persist($project);
            $em->flush();

            $this->addFlash('success', 'A new project has been created');
            return $this->redirectToRoute('app_admin_project_list');
        }

        return $this->render('admin/new-project.html.twig', [
            'activeName' => 'ADMIN',
            'projectForm' => $form->createView(),
            'priorityValue' => $priorityValue,
            
        ]);
    }

    
    /**
    * @Route("/admin/project/{id}/edit", name="app_admin_project_edit")
    */
    public function editProject(EntityManagerInterface $em, Request $request, ProjectRepository $projectRepository, Project $project)
    {

        $projects = $projectRepository->findAll();
        $priorityValue = count($projects) + 1;
        $form = $this->createForm(ProjectFormType::class, $project);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){

            $data = $form->getData();

            $projectFirstTitle = $data->getFirstTitle() ?? null;
            $projectSecondTitle = $data->getSecondTitle() ?? null;
            $project
                ->setMainTitle($data->getMainTitle())
                ->setFirstTitle($projectFirstTitle)
                ->setSecondTitle($projectSecondTitle)
                ->setContent($data->getContent())
            ;

            $em->persist($project);
            $em->flush();

            $this->addFlash('success', 'The project has been updated');
            return $this->redirectToRoute('app_admin_project_list');
        }

        return $this->render('admin/edit-project.html.twig', [
            'activeName' => 'ADMIN',
            'projectForm' => $form->createView(),
            'priorityValue' => $priorityValue,
            
        ]);

    }

    /**
     * @Route("/admin/project/{id}/translate", name="app_admin_trans_project")
     */
    public function tnewTanslateProject(EntityManagerInterface $em, Project $project, Request $request)
    {   

        $form = $this->createForm(ProjectTranslationFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $projectTrans = new ProjectTranslation();

            $data = $form->getData();

            $projectTrans 
                ->setProject($project)
                ->setLanguage($data->getLanguage())
                ->setMainTitleTrans($data->getMainTitleTrans())
                ->setContentTrans($data->getContentTrans())
            ;

            $em->persist($projectTrans);
            $em->flush();

            $this->addFlash('success', 'The translation has been created!');

            return $this->redirectToRoute('app_admin_project_list');

        }

        return $this->render('admin/new-project-translate.html.twig', [
            'activeName' => 'ADMIN',
            'project' => $project,
            'projectTransForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/project/edit/{id}/translation", name="app_admin_edit_trans_project")
     */
    public function editTranslateProject(EntityManagerInterface $em, ProjectTranslation $projectTranslation, Request $request)
    {
        $form = $this->createForm(ProjectTranslationFormType::class, $projectTranslation);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){


            $projectTranslation = $form->getData();

            

            $em->persist($projectTranslation);
            $em->flush();

            $this->addFlash('success', 'The translation has been created!');

            return $this->redirectToRoute('app_admin_project_list');

        }

        return $this->render('admin/edit-project-translate.html.twig', [
            'activeName' => 'ADMIN',
            'projectTranslation' => $projectTranslation,
            'projectTransForm' => $form->createView()
        ]);
    }

    /**
    * @Route("/admin/projectList", name="app_admin_project_list")
    */
    public function projectList(EntityManagerInterface $em, ProjectRepository $projectRepository, Request $request)
    {
        // $projects= $projectRepository->findBy([],
        //     [
        //         'priority' => 'ASC'
        //     ]
        // );
        
        $projects = $projectRepository->findProjectandTranslation();
        
        return $this->render('admin/projects-list.html.twig', [
            'activeName' => 'ADMIN',
            'projects' => $projects
        ]);
    }
    
    /**
    * @Route("/admin/video/new", name="app_admin_video_new")
    */
    public function newVideo(EntityManagerInterface $em, Request $request, VideoRepository $videoRepository)
    {

        $videos = $videoRepository->findAll();
        $videoPriority = count($videos) + 1;

        $videoForm = $this->createForm(VideoFormType::class);

        $videoForm->handleRequest($request);
        if($videoForm->isSubmitted() && $videoForm->isValid()){


            $data = $videoForm->getData();

            $video = new Video();

            $video
                ->setSrc($data->getSrc())
                ->setPriority($data->getPriority())
            ;

            $em->persist($video);
            $em->flush();

            $this->addFlash('success', 'A new video has been created');
            return $this->redirectToRoute('app_admin_video_list');

        }

        return $this->render('admin/new-video.html.twig', [
            'activeName' => 'ADMIN',
            'videoForm' => $videoForm->createView(),
            'videoPriority' => $videoPriority
        ]);

    }
    
    /**
    * @Route("/admin/video/{id}/edit", name="app_admin_video_edit")
    */
    public function editVideo(EntityManagerInterface $em, Request $request, Video $video, VideoRepository $videoRepository)
    {

        $videos = $videoRepository->findAll();
        $videoPriority = count($videos) + 1;

        $videoForm = $this->createForm(VideoFormType::class, $video);

        $videoForm->handleRequest($request);
        if($videoForm->isSubmitted() && $videoForm->isValid()){


            /**
             * @var Video $video
             */
            $video = $videoForm->getData();

            $em->persist($video);
            $em->flush();

            $this->addFlash('success', 'The video has been updated');
            return $this->redirectToRoute('app_admin_video_list');

        }

        return $this->render('admin/edit-video.html.twig', [
            'activeName' => 'ADMIN',
            'id' => $video->getId(),
            'videoForm' => $videoForm->createView(),
            'videoPriority' => $videoPriority
        ]);

    }

    
    /**
    * @Route("/admin/video/{id}/delete", name="app_admin_video_delete")
    */
    public function deleteVideo(EntityManagerInterface $em, Request $request, Video $video)
    {
        /**
         * @var Video $video
         */
        
        $em->remove($video);
        $em->flush();

        $this->addFlash('warning', 'The video has been deleted');
        return $this->redirectToRoute('app_admin_video_list');

    }

    
    /**
    * @Route("/admin/videoList", name="app_admin_video_list")
    */
    public function videoList(VideoRepository $videoRepository)
    {
        $videos = $videoRepository->findBy([],
            [
                'priority' => 'ASC'
            ]
        );

        return $this->render('admin/video-list.html.twig', [
            'videos' => $videos
        ]);
    }

    
    /**
    * @Route("/admin/media-manager", name="app_admin_media_manager")
    */
    public function mediaManager(ZamuaFilesRepository $zamuaFilesRepository, ProjectRepository $projectRepository,  Request $request, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $allFiles = $zamuaFilesRepository->findAll();
        
        $allProjects = $projectRepository->findAll();
        

        $formUpload = $this->createForm(FileFormType::class);

        $formUpload->handleRequest($request);

       

        if($formUpload->isSubmitted() && $formUpload->isValid()){
        
            
            $uploadedFiles = $formUpload->get('newFiles')->getData();
            
            //dd($uploadedFiles);
            
            /**
            * @var UploadedFile $uploadedFile
             */
     
            foreach ($uploadedFiles as $uploadedFile) {
               
                
                $file = new ZamuaFiles();
                
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads/' . $file::UPLOADS_FILES_FOLDER;

                $originalFileName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);

                $newFileName =  bin2hex(random_bytes(8)). '-' .uniqid().'.'.$uploadedFile->guessExtension();

                //dd($uploadedFile->move($destination));
                try {
                    $uploadedFile->move(
                        $destination,
                        $newFileName,
                        $file
                    );
                } catch (FileException $e) {
                    
                    $e->getMessage();
                }
                
                
                $file
                    ->setFilename($newFileName)
                    ->setIsGalleryItem(false);          
                ;
            
                $em->persist($file);
                $em->flush();
            }

            $this->addFlash('success', 'The file has been uploaded!');
            
            return $this->redirectToRoute('app_admin_media_manager', [
                'files' =>$allFiles
            ]);
        }

        
        return $this->render('admin/media-manager.html.twig', [
            'files' =>$allFiles,
            'projects' => $allProjects,
            'formUpload' => $formUpload->createView()
        ]);
    }

    
    /**
    * @Route("/admin/media/{id}/delete", name="app_admin_media_delete")
    */
    public function deleteMedia(ZamuaFiles $zamuaFiles, EntityManagerInterface $em)
    {
       
        /**
         * @var Zamuafiles $zamuaFiles
         */
        $em->remove($zamuaFiles);
        $em->flush();
        
        $this->addFlash('success', 'The file has been deleted!');
        return $this->redirectToRoute('app_admin_media_manager');
    }

    
    /**
    * @Route("/admin/media/{id}/edit", name="app_admin_media_edit")
    */
    public function isGalleryItem(ZamuaFiles $zamuaFiles, EntityManagerInterface $em, Request $request, ZamuaFilesRepository $zamuaFilesRepository, ProjectRepository $projectRepository)
    {
        $allFiles = $zamuaFilesRepository->findBy([
            'isGalleryItem' => true
        ]);
        $filePosition = count($allFiles) + 1;

        $form = $this->createForm(EditMediaFormType::class, $zamuaFiles);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

           
            $zamuaFiles = $form->getData();
            // dd($data->getProjects());
            //$zamuaFiles->setIsGalleryItem($data->getIsGalleryItem());

            // foreach ($data->getProjects() as $aProject) {
            //     $projectToPersist = $projectRepository->find($aProject->getId());

            //     // $projectToPersist->addMedium($zamuaFiles);
            //     // $em->persist($projectToPersist);
            //     // $em->flush();

            //     // $zamuaFiles->addProject($projectToPersist);
            // }

            $em->persist($zamuaFiles);
            $em->flush();
            
            $this->addFlash('success', 'The video has been updated');
            return $this->redirectToRoute('app_admin_media_manager');


        }
        return $this->render('admin/edit-media.html.twig', [
            'file' => $zamuaFiles,
            'form' => $form->createView(),
            'filePosition' => $filePosition
        ]);

    }




    
    /**
    * @Route("/admin/contactManager", name="app_admin_contact_manager")
    */
    public function contactManager(ContactRepository $contactRepository)
    {

        $contacts = $contactRepository->findBy(
            [
                'isActive' => true
            ]
        );

        return $this->render('admin/contacts-manager.html.twig', [
            'contacts' => $contacts
        ]);

    }


    
    /**
    * @Route("/admin/{id}/contact", name="app_admin_contact_ui")
    */
    public function singleContact(Contact $contact)
    {
        return $this->render('admin/single-contact.html.twig', [
            'contact' => $contact
        ]);

    }

    
    /**
    * @Route("/admin/{id}/contactTreat", name="app_admin_contact_treat")
    */
    public function singleContactTreat(Contact $contact, EntityManagerInterface $em)
    {
        if($contact->getIsDone() === true){
            $contact->setIsDone(false);
        } elseif ($contact->getIsDone() === false) {
            $contact->setIsDone(true);
        }

        $em->persist($contact);
        $em->flush();
        

        return $this->render('admin/single-contact.html.twig', [
            'contact' => $contact
        ]);

    }
    
    /**
    * @Route("/admin/{id}/contactDelete", name="app_admin_contact_delete")
    */
    public function singleContactDelete(Contact $contact, EntityManagerInterface $em)
    {
        $contact->setIsActive(false);
        $em->persist($contact);
        $em->flush();
        return $this->redirectToRoute('app_admin_contact_manager');

    }

}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml", name="app_sitemap", defaults={"_format"="xml"})
     */
    public function index(Request $request): Response
    {
        $hostName = $request->getSchemeAndHttpHost();
        $urls = [];
        $urls[] = ['loc' => $this->generateUrl('app_home')];
        $urls[] = ['loc' => $this->generateUrl('app_bio')];
        $urls[] = ['loc' => $this->generateUrl('app_music')];
        $urls[] = ['loc' => $this->generateUrl('app_gallery')];
        $urls[] = ['loc' => $this->generateUrl('app_shows')];
        $urls[] = ['loc' => $this->generateUrl('app_contact')];
        $urls[] = ['loc' => $this->generateUrl('app_listenings')];
        $urls[] = ['loc' => $this->generateUrl('app_video')];
        $urls[] = ['loc' => $this->generateUrl('app_cookies')];
        $urls[] = ['loc' => $this->generateUrl('app_projects')];
        $urls[] = ['loc' => $this->generateUrl('app_credits')];
        
        $response = new Response(
            $this->renderView('sitemap/index.html.twig', [
                'urls'      => $urls,
                'hostName'  => $hostName
            ]),
            200
        );
        $response->headers->set('Content-type', 'text/xml');
        return $response;
    }
}

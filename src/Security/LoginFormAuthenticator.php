<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use App\Repository\UserRepository;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{

    use TargetPathTrait;

    private $userRepository;
    private $router;
    private $csrfTokenManagerInterface;
    private $passwordEncoder;

    public function __construct(UserRepository $userRepository, RouterInterface $router, CsrfTokenManagerInterface $csrfTokenManagerInterface, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->router = $router;
        $this->csrfTokenManagerInterface = $csrfTokenManagerInterface;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function supports(Request $request)
    {
        // do your work when we're POSTing to the login page
        return $request->attributes->get('_route') === 'app_login'
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        $credentials =  [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['email']
        );

        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManagerInterface->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }
        return $this->userRepository->findOneBy(['email' => $credentials['email']]);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // only needed if we need to check a password - we'll do that later!
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {

        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }
        
        return new RedirectResponse($this->router->generate('app_home'));
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('app_login');
    }

    
}

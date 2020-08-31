<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class LocaleListener implements EventSubscriberInterface
{
    public function onKernelRequest(RequestEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();

        /// in

        $locales = ['it', 'de', 'fr', 'se'];

        $randomKey = array_rand($locales);
        $locale = $locales[$randomKey];

        $request->getSession()->set('_locale', $locale);
        $request->setLocale($locale);

        return;
        /// out

        if (!$request->hasPreviousSession()) {
            return;
        }

        if (!$token = $this->tokenStorage->getToken()) {
            return;
        }

        if (!$token->isAuthenticated()) {
            return;
        }

        /** @var User $user */
        if (!$user = $token->getUser()) {
            return;
        }

        if ($user === 'anon.') {
            return;
        }

        if ($user->getLocale()) {
            $request->getSession()->set('_locale', $user->getLocale());
            $request->setLocale($user->getLocale());
//            dump($request);
        }
//        dump($request->getSession());
    }

    public static function getSubscribedEvents()
    {
        return [
            // Needs to be called before Symfony\Component\HttpKernel\EventListener\LocaleListener
            KernelEvents::REQUEST => [['onKernelRequest', 32]],
        ];
    }
}

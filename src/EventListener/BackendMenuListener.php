<?php

declare(strict_types=1);

/*
 * Web-Tools Bundle for Contao Open Source CMS
 *
 * Copyright (c) 2022 pdir / digital agentur // pdir GmbH
 *
 * @package    webtools-bundle
 * @link       https://pdir.de/contao-webtools/
 * @license    LGPL-3.0-or-later
 * @author     Mathias Arzberger <develop@pdir.de>
 * @author     Christian Mette <develop@pdir.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pdir\ContaoWebtoolsBundle\EventListener;

use Contao\BackendUser;
use Contao\CoreBundle\Event\MenuEvent;
use Contao\CoreBundle\Framework\ContaoFramework;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Contracts\Translation\TranslatorInterface;
use Terminal42\ServiceAnnotationBundle\Annotation\ServiceTag;

/**
 * @ServiceTag("kernel.event_listener", event="contao.backend_menu_build", priority=-255)
 */
class BackendMenuListener
{
    private Security $security;
    private RouterInterface $router;
    private RequestStack $requestStack;
    private TranslatorInterface $translator;
    private ContaoFramework $framework;

    public function __construct(Security $security, RouterInterface $router, RequestStack $requestStack, TranslatorInterface $translator, ContaoFramework $framework)
    {
        $this->security = $security;
        $this->router = $router;
        $this->requestStack = $requestStack;
        $this->translator = $translator;
        $this->framework = $framework;
    }

    public function __invoke(MenuEvent $event): void
    {
        $user = $this->security->getUser();

        if (!$user instanceof BackendUser) {
            return;
        }

        // Add back end link
        if (!isset($_ENV['WEBTOOLS_ALLOW_PURGE']) && 'true' !== $_ENV['WEBTOOLS_ALLOW_PURGE']) {
            return;
        }

        $name = $event->getTree()->getName();

        if ('headerMenu' === $name) {
            $this->buildHeaderMenu($event, $user);
        }
    }

    private function buildHeaderMenu(MenuEvent $event, BackendUser $user): void
    {
        $request = $this->requestStack->getCurrentRequest();
        $factory = $event->getFactory();
        $tree = $event->getTree();

        $purgeTitle = $this->translator->trans('MSC.purge', [], 'contao_default');

        $purge = $factory
            ->createItem('purge')
            ->setLabel($purgeTitle)
            ->setUri($request->getScheme().'://'.$request->getHost().'?scripts=purge')
            ->setLinkAttribute('class', 'icon-purge')
            ->setLinkAttribute('title', $purgeTitle)
            ->setLinkAttribute('target', '_blank')
            ->setExtra('safe_label', true)
            //->setExtra('translation_domain', false)
        ;

        $tree->addChild($purge);
    }
}

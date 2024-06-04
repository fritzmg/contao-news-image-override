<?php

declare(strict_types=1);

/*
 * This file is part of the Contao News Image Override extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoNewsImageOverride\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\CoreBundle\Image\Studio\Studio;
use Contao\FrontendTemplate;
use Contao\Module;
use Contao\NewsModel;
use Contao\StringUtil;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AsHook('parseArticles')]
class ContaoNewsImageOverrideListener
{
    public function __construct(
        private readonly Studio $studio,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function __invoke(FrontendTemplate $template, array $newsEntry, Module $module): void
    {
        if ($module->disallowOverride || !$template->addImage) {
            return;
        }

        if (!$news = NewsModel::findById($newsEntry['id'])) {
            return;
        }

        if (!$news->singleSRC) {
            return;
        }

        $size = StringUtil::deserialize($news->size, true);

        if ([] === array_filter($size)) {
            return;
        }

        $figureBuilder = $this->studio->createFigureBuilder();
        $figure = $figureBuilder
            ->from($template->singleSRC)
            ->setSize($size)
            ->enableLightbox((bool) $news->fullsize)
            ->setOverwriteMetadata($news->getOverwriteMetadata())
            ->buildIfResourceExists()
        ;

        if ('external' === $template->source && $template->target) {
            $figureBuilder->setLinkAttribute('target', '_blank');
        }

        if ($figure) {
            // Rebuild with link to event if none is set
            if ($template->href && !$figure->getLinkHref()) {
                $figure = $figureBuilder
                    ->setLinkHref($template->href)
                    ->setLinkAttribute('title', StringUtil::specialchars(sprintf($this->translator->trans('MSC.readMore', [], 'contao_default'), $news->headline)))
                    ->build()
                ;
            }

            $figure->applyLegacyTemplateData($template, floating: $news->floating);
        }
    }
}

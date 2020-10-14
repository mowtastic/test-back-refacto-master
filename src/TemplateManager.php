<?php

/**
 * Class TemplateManager
 */
class TemplateManager
{
    /**
     * @var QuoteRepository
     */
    private $quoteRepository;

    /**
     * @var SiteRepository
     */
    private $siteRepository;

    /**
     * @var DestinationRepository
     */
    private $destinationRepository;

    /**
     * @var ApplicationContext
     */
    private $applicationContext;

    /**
     * TemplateManager constructor.
     */
    public function __construct()
    {
        $this->quoteRepository = QuoteRepository::getInstance();
        $this->siteRepository = SiteRepository::getInstance();
        $this->destinationRepository = DestinationRepository::getInstance();
        $this->applicationContext = ApplicationContext::getInstance();
    }


    /**
     * @param Template $tpl
     * @param array    $data
     *
     * @return Template
     */
    public function getTemplateComputed(Template $tpl, array $data)
    {
        $duplicatedTemplate = clone($tpl);
        $duplicatedTemplate->setSubject($this->computeText($duplicatedTemplate->getSubject(), $data));
        $duplicatedTemplate->setContent($this->computeText($duplicatedTemplate->getContent(), $data));

        return $duplicatedTemplate;
    }

    /**
     * @param       $text
     * @param array $data
     *
     * @return string|string[]
     */
    private function computeText($text, array $data)
    {
        $quote = $data['quote'];

        if ($quote instanceof Quote)
        {
            $quoteFromRepository = $this->quoteRepository->getById($quote->getId());
            $site = $this->siteRepository->getById($quote->getSiteId());
            $destinationOfQuote = $this->destinationRepository->getById($quote->getDestinationId());

            if(strpos($text, '[quote:destination_link]') !== false){
                $destination = DestinationRepository::getInstance()->getById($quote->getDestinationId());
            }

            $containsSummaryHtml = strpos($text, '[quote:summary_html]');
            $containsSummary     = strpos($text, '[quote:summary]');

            if ($quoteFromRepository !== null) {
                if ($containsSummaryHtml !== false) {
                    $text = str_replace(
                        '[quote:summary_html]',
                        Quote::renderHtml($quoteFromRepository),
                        $text
                    );
                }
                if ($containsSummary !== false) {
                    $text = str_replace(
                        '[quote:summary]',
                        Quote::renderText($quoteFromRepository),
                        $text
                    );
                }
            }

            if (strpos($text, '[quote:destination_name]') !== false) {
                $text = str_replace('[quote:destination_name]',$destinationOfQuote->getCountryName(),$text);
            }
        }

        $textToReplace = '';
        if (isset($destination) && $quoteFromRepository !== null) {
            $textToReplace = $site->getUrl() . '/' . $destination->getCountryName() . '/quote/' . $quoteFromRepository->getId();
        }
        $text = str_replace('[quote:destination_link]', $textToReplace, $text);

        $user  = (isset($data['user']) instanceof User)  ? $data['user']  : $this->applicationContext->getCurrentUser();
        if ($user !== null) {
            if (strpos($text, '[user:first_name]') !== false){
                $text = str_replace('[user:first_name]', ucfirst(strtolower($user->getFirstname())), $text);
            }
        }

        return $text;
    }
}

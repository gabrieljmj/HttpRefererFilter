<?php
namespace Gabrieljmj\HttpRefererFilter\BlockerAction;

use Gabrieljmj\HttpRefererFilter\BlockerAction\HttpRefererBlockerActionInterface;
use Symfony\Component\HttpFoundation\Response;

class PageContent implements HttpRefererBlockerActionInterface
{
    /**
     * HTTP response
     *
     * @var \Symfony\Component\HttpFoundation\Response
    */
    protected $response;

    /**
     * Content to add
     *
     * @var string
    */
    private $pageContent;

    /**
     * @param string                                     $content
     * @param \Symfony\Component\HttpFoundation\Response $response
    */
    public function __construct($content, Response $response)
    {
        $this->pageContent = $content;
        $this->response = $response;
    }

    /**
     * Executes the action
    */
    public function execute()
    {
        $this->response->setContent($this->pageContent);
        $this->response->send();
    }
}
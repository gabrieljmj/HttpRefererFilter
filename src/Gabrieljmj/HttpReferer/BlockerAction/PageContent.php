<?php
namespace Gabrieljmj\HttpRefererFilter\BlockerAction;

use Gabrieljmj\HttpRefererFilter\BlockerAction\HttpRefererBlockerActionInterface;

class PageContent implements HttpRefererBlockerActionInterface
{
    /**
     * HTTP response
     *
     * @var \Symfony\Component\HttpFoundation\Response
    */
    protected $response;

    /**
     * @param string                                     $content
     * @param \Symfony\Component\HttpFoundation\Response $response
    */
    public function __construct($content, Response $response)
    {
        $this->pageContent;
        $this->response = $response;
    }

    /**
     * Executes the action
    */
    public function execute()
    {
        $this->response->setContent($this->content);
        $this->response->send();
    }
}
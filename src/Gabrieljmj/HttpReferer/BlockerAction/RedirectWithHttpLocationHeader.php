<?php
namespace Gabrieljmj\HttpRefererFilter\BlockerAction;

use Gabrieljmj\HttpRefererFilter\BlockerAction\HttpRefererBlockerActionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectWithHttpLocationHeader implements HttpRefererBlockerActionInterface
{
    /**
     * Redirect response
     *
     * @var \Symfony\Component\HttpFoundation\RedirectResponse
    */
    protected $redirectResponse;

    /**
     * @param \Symfony\Component\HttpFoundation\RedirectResponse $redirectResponse
    */
    public function __construct(RedirectResponse $redirectResponse)
    {
        $this->redirectResponse = $redirectResponse;
    }

    /**
     * Executes the action
    */
    public function execute()
    {
        $this->redirectResponse->send();
    }
}
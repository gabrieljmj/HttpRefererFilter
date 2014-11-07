<?php
namespace Gabrieljmj\HttpRefererFilter;

use Gabrieljmj\HttpRefererFilter\Exception\HttpRefererException;
use Gabrieljmj\HttpRefererFilter\BlockerAction\HttpRefererBlockerActionInterface;
use Gabrieljmj\HttpRefererFilter\HttpRefererFilterInterface;
use Symfony\Component\HttpFoundation\Request;

class HttpRefererAllower implements HttpRefererFilterInterface
{
    /**
     * Allowed referers
     *
     * @var array
    */
    private $allowed;

    /**
     * Action to execute when the validation failures
     *
     * @var \Gabrieljmj\HttpRefererFilter\HttpRefererBlockerActionInterface
    */
    private $actionToBlockeds;

    /**
     * @param \Gabrieljmj\HttpRefererFilter\HttpRefererBlockerActionInterface $action
    */
    public function __construct(HttpRefererBlockerActionInterface $action)
    {
        $this->setActionToBlockeds($action);
    }

    /**
     * Sets the action to execute when the validation failures
     *
     * @param \Gabrieljmj\HttpRefererFilter\HttpRefererBlockerActionInterface $action
    */
    public function setActionToBlockeds(HttpRefererBlockerActionInterface $action)
    {
        $this->actionToBlockeds = $action;
    }

    /**
     * Adds a HTTP referer to block
     *
     * @param string $referer
     * @return \Gabrieljmj\HttpRefererFilter\AbstractHttpRefererValidator
    */
    public function add($referer)
    {
        $this->allowed[] = $referer;
        return $this;
    }

    /**
     * Validates the current HTTP referer
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
    */
    public function validate(Request $request)
    {
        if (!$request->server->has('HTTP_REFERER')) {
            throw new HttpRefererException('Define an HTTP referer');
        }
        
        $referer = $request->server->get('HTTP_REFERER');

        return !in_array($referer, $this->allowed) ? $this->actionToBlockeds->execute() : true;
    }
}
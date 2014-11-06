<?php
namespace Gabrieljmj\HttpRefererFilter;

use Gabrieljmj\HttpRefererFilter\Exception\HttpRefererException;
use Gabrieljmj\HttpRefererFilter\BlockerAction\HttpRefererBlockerActionInterface;
use Gabrieljmj\HttpRefererFilter\HttpRefererFilterInterface;
use Symfony\Component\HttpFoundation\Request;

class HttpRefererBlocker implements HttpRefererFilterInterface
{
    /**
     * Blocked referers
     *
     * @var array
    */
    private $blocked;

    /**
     * Adds a HTTP referer to block
     *
     * @param string                                                          $referer
     * @param \Gabrieljmj\HttpRefererFilter\HttpRefererBlockerActionInterface $action
     * @return \Gabrieljmj\HttpRefererFilter\AbstractHttpRefererValidator
    */
    public function add($referer, HttpRefererBlockerActionInterface $action)
    {
        $this->blocked[] = array('referer' => $referer, 'action' => $action);
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

        foreach ($this->blocked as $blockedReferer)
        {
            if ($referer == $blockedReferer['referer']) {
                $action = $blockedReferer['action'];
                return $action->execute();
            }
        }

        return true;
    }
}
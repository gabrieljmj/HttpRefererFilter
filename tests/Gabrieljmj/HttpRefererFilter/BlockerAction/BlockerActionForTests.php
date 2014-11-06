<?php
namespace Test\Gabrieljmj\HttpRefererFilter\BlockerAction;

use Gabrieljmj\HttpRefererFilter\BlockerAction\HttpRefererBlockerActionInterface;

class BlockerActionForTests implements HttpRefererBlockerActionInterface
{
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    public function execute()
    {
        return $this->msg;
    }
}
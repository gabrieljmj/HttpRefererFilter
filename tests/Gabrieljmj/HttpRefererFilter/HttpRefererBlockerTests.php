<?php
namespace Test\Gabrieljmj\HttpRefererFilter;

use Gabrieljmj\HttpRefererFilter\HttpRefererBlocker;
use Test\Gabrieljmj\HttpRefererFilter\BlockerAction\BlockerActionForTests;
use Test\Gabrieljmj\HttpRefererFilter\AbstractFilterTest;

/**
 * @covers \Gabrieljmj\HttpRefererFilter\HttpRefererAllower\HttpRefererAllower
*/
class HttpRefererBlockerTests extends AbstractFilterTest
{
    /**
     * @var string
    */
    protected $urlToFail = 'http://not-pass.com';

    /**
     * @var string
    */
    protected $urlToPass = 'http://pass.com';

    /**
     * @var string
    */
    protected $msg = 'Invalid referer';

    protected function setUp()
    {
        parent::setUp();
        $action = new BlockerActionForTests($this->msg);
        $this->filter = new HttpRefererBlocker();
        $this->filter->add('http://not-pass.com', $action);
    }
}
<?php
namespace Test\Gabrieljmj\HttpRefererFilter;

use Gabrieljmj\HttpRefererFilter\HttpRefererAllower;
use Test\Gabrieljmj\HttpRefererFilter\BlockerAction\BlockerActionForTests;
use Test\Gabrieljmj\HttpRefererFilter\AbstractFilterTest;

/**
 * @covers \Gabrieljmj\HttpRefererFilter\HttpRefererAllower\HttpRefererAllower
*/
class HttpRefererAllowerTests extends AbstractFilterTest
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

    /**
     * @var \Test\Gabrieljmj\HttpRefererFilter\BlockerAction\BlockerActionForTests
    */
    private $action;

    protected function setUp()
    {
        parent::setUp();
        $this->action = new BlockerActionForTests($this->msg);
        $this->filter = new HttpRefererAllower($this->action);
        $this->filter->add('http://pass.com');
    }

    /**
     * @covers \Gabrieljmj\HttpRefererFilter\HttpRefererAllower::$actionToBlockeds
    */
    public function assertAttr()
    {
        $this->assertAttributeEquals($this->action, 'actionToBlockeds', $this->filter);
    }
}
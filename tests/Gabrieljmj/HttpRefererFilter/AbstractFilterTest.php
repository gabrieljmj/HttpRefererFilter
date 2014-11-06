<?php
namespace Test\Gabrieljmj\HttpRefererFilter;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Test\Gabrieljmj\HttpRefererFilter\AbstractFilterTest;

abstract class AbstractFilterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Symfony\Component\HttpFoundation\Response
    */
    protected $response;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
    */
    protected $request;

    /**
     * @var string
    */
    protected $urlToFail;

    /**
     * @var string
    */
    protected $urlToPass;

    /**
     * @var string
    */
    protected $msg;

    /**
     * @var \Gabrieljmj\HttpRefererFilter\HttpRefererFilterInterface
    */
    protected $filter;

    protected function setUp()
    {
        $this->response = new Response();
        $this->request = Request::createFromGlobals();
    }

    /**
     * @covers \Gabrieljmj\HttpRefererFilter\HttpRefererAllower\HttpRefererFilterInterface::validate
    */
    public function testReferingAnInvalidUrl()
    {
        $this->request->server->set('HTTP_REFERER', $this->urlToFail);
        $this->assertEquals($this->filter->validate($this->request), $this->msg);
    }

    /**
     * @covers \Gabrieljmj\HttpRefererFilter\HttpRefererAllower\HttpRefererFilterInterface::validate
    */
    public function testReferingAValidUrl()
    {
        $this->request->server->set('HTTP_REFERER', $this->urlToPass);
        $this->assertTrue($this->filter->validate($this->request));
    }
}
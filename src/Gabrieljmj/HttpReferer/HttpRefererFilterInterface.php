<?php
namespace Gabrieljmj\HttpRefererFilter;

use Symfony\Component\HttpFoundation\Request;

interface HttpRefererFilterInterface
{
    /**
     * Validates the current HTTP referer
     *
     * @param \Symfony\Component\HttpFoudation\Request $request
    */
    public function validate(Request $request);
}
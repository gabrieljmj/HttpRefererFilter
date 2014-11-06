Gabrieljmj\HttpRefererFilter
============================
Filter to allow or block HTTP referers.

##Blocker actions
Blocker actions are actions to be executed when a referer not allowed try a request.
* ```\Gabrieljmj\HttpRefererFilter\BlockerAction\RedirectWithHttpLocationHeader```: Redirects to some address. Pass on constructor an instance of ```\Symfony\Component\HttpFoundation\RedirectResponse```.
* ```\Gabrieljmj\HttpRefererFilter\BlockerAction\PageContent```: Add on the page a content. Pass on constructor the content (string) and an instance of ```\Symfony\Component\HttpFoundation\RedirectResponse```.

##Blocking
You can block specifc HTTP referers.
####Example
```php
use Gabrieljmj\HttpRefererFilter\HttpRefererBlocker;
use Gabrieljmj\HttpRefererFilter\BlockerAction\RedirectWithHttpLocationHeader;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

$action = new RedirectWithHttpLocationHeader(new RedirectResponse('http://mydomain.com/invalid-referer');
$blocker = new HttpRefererBlocker();
$blocker->add('http://example.com', $action)
        ->add('http://example2.com', $action);
$request = new Request($_GET, $_POST, [], $_COOKIE, $_FILES, ['HTTP_REFERER' => 'http://example_valid.com']);
var_dump($blocker->validate($request)); //bool(true)
```
If the domain (referer) **is** in the list, redirects to ```http://mydomain.com/invalid-referer```.

##Allowing
With it, allow the request just for specif domains.
```php
use Gabrieljmj\HttpRefererFilter\HttpRefererAllower;
use Gabrieljmj\HttpRefererFilter\BlockerAction\RedirectWithHttpLocationHeader;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

$action = new RedirectWithHttpLocationHeader(new RedirectResponse('http://mydomain.com/invalid-referer');
$blocker = new HttpRefererAllower($action);
$blocker->add('http://example.com')
        ->add('http://example2.com');
$request = new Request($_GET, $_POST, [], $_COOKIE, $_FILES, ['HTTP_REFERER' => 'http://example1.com']);
var_dump($blocker->validate($request)); //bool(true)
```
If the domain (referer) **is not** in the list, redirects to ```http://mydomain.com/invalid-referer```.
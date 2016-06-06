<?php

namespace TiBian\BrowserRequirement;

use Closure;
use Illuminate\Http\Request;
use Sinergi\BrowserDetector\Os;
use Sinergi\BrowserDetector\Browser;

/**
 * Class BrowserRequirement
 *
 * @package TiBian\BrowserRequirement
 */
class BrowserRequirement
{
    /**
     * Minimum Version of Supported Browsers
     *
     * @var array
     */
    protected $supportedVersions = [];

    /**
     * Redirect Route on Unsupported Browser
     *
     * @var string
     */
    protected $routeUnsupportedBrowser;

    /**
     * Redirect Route on Supported Browser
     *
     * @var string
     */
    protected $routeSupportedBrowser;

    /**
     * Current Page
     *
     * @var string
     */
    protected $currentPage;

    /**
     * Is Unsupported Browser
     *
     * @var bool
     */
    protected $isUnsupportedBrowser;

    /**
     * OS Object
     *
     * @var object Os
     */
    protected $os;

    /**
     * Browser Object
     *
     * @var object Browser
     */
    protected $browser;

    /**
     * BrowserRequirement constructor.
     *
     * @param Browser $browser
     * @param Os $os
     */
    public function __construct(Browser $browser, Os $os)
    {
        $this->supportedVersions = config('browser.requirement');
        $this->routeUnsupportedBrowser = route(config('browser.routeUnsupportedBrowser'));
        $this->routeSupportedBrowser = route(config('browser.routeSupportedBrowser'));
        $this->currentPage = request()->url();

        $this->os = $os;
        $this->browser = $browser;

        $this->isUnsupportedBrowser();
    }

    /**
     * Determine if the Browser is Unsupported
     *
     * @return bool
     */
    private function isUnsupportedBrowser()
    {
        if (array_key_exists($this->os->getName(), $this->supportedVersions)) {

            $browsers = $this->supportedVersions[$this->os->getName()];

            foreach ($browsers as $browser => $version) {
                if ($this->browser->getName() === $browser &&
                    $this->browser->getVersion() < $version
                ) {
                    return $this->isUnsupportedBrowser = true;
                }
            }
        }

        return $this->isUnsupportedBrowser = false;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->isUnsupportedBrowser) {
            if ($this->currentPage != $this->routeUnsupportedBrowser) {
                return redirect($this->routeUnsupportedBrowser);
            }
        } else {
            if ($this->currentPage == $this->routeUnsupportedBrowser) {
                return redirect($this->routeSupportedBrowser);
            }
        }

        return $next($request);
    }
}

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
     * @var \Sinergi\BrowserDetector\Os
     */
    protected $os;

    /**
     * @var \Sinergi\BrowserDetector\Browser
     */
    protected $browser;

    /**
     * BrowserRequirement constructor.
     *
     * @param \Sinergi\BrowserDetector\Browser $browser
     * @param \Sinergi\BrowserDetector\Os $os
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
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->isUnsupportedBrowser) {
            if (! $this->isUnsupportedPage()) {
                return redirect($this->routeUnsupportedBrowser);
            }
        } else {
            if ($this->isUnsupportedPage()) {
                return redirect($this->routeSupportedBrowser);
            }
        }

        return $next($request);
    }

    /**
     * @return bool
     */
    protected function isUnsupportedBrowser()
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
     * @return bool
     */
    protected function isUnsupportedPage()
    {
        return $this->currentPage == $this->routeUnsupportedBrowser;
    }
}

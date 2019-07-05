<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\DomCrawler\Crawler;

class FilterIfPjax
{
    /**
     * The DomCrawler instance.
     *
     * @var Crawler
     */
    protected $crawler;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (! $request->pjax() || $response->isRedirection()) {
            return $response;
        }

        $this->filterResponse($response, $request->header('X-PJAX-Container'))
            ->setUriHeader($response, $request)
            ->setVersionHeader($response, $request);

        return $response;
    }

    /**
     * @param Response $response
     * @param          $container
     *
     * @return $this
     */
    protected function filterResponse(Response $response, $container)
    {
        $crawler = $this->getCrawler($response);

        $response->setContent(
            $this->makeTitle($crawler).
            $this->fetchContainer($crawler, $container)
        );

        return $this;
    }

    /**
     * @param Crawler $crawler
     *
     * @return string|void
     */
    protected function makeTitle(Crawler $crawler)
    {
        $pageTitle = $crawler->filter('head > title');

        if (! $pageTitle->count()) {
            return;
        }

        return "<title>{$pageTitle->html()}</title>";
    }

    /**
     * @param Crawler $crawler
     * @param string  $container
     *
     * @return string
     */
    protected function fetchContainer(Crawler $crawler, string $container)
    {
        $content = $crawler->filter($container);

        if (! $content->count()) {
            abort(422);
        }

        return $content->html();
    }

    /**
     * @param Response $response
     * @param Request  $request
     *
     * @return $this
     */
    protected function setUriHeader(Response $response, Request $request)
    {
        $response->header('X-PJAX-URL', $request->getRequestUri());

        return $this;
    }

    /**
     * @param Response $response
     * @param Request  $request
     *
     * @return $this
     */
    protected function setVersionHeader(Response $response, Request $request)
    {
        $crawler = $this->getCrawler($this->createResponseWithLowerCaseContent($response));
        $node = $crawler->filter('head > meta[http-equiv="x-pjax-version"]');

        if ($node->count()) {
            $response->header('x-pjax-version', $node->attr('content'));
        }

        return $this;
    }

    /**
     * Get the DomCrawler instance.
     *
     * @param Response $response
     *
     * @return Crawler
     */
    protected function getCrawler(Response $response)
    {
        if ($this->crawler) {
            return $this->crawler;
        }

        return $this->crawler = new Crawler($response->getContent());
    }

    /**
     * Make the content of the given response lowercase.
     *
     * @param Response $response
     *
     * @return Response
     */
    protected function createResponseWithLowerCaseContent(Response $response)
    {
        $lowercaseContent = strtolower($response->getContent());

        return Response::create($lowercaseContent);
    }
}

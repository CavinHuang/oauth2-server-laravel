<?php

/*
 * This file is part of OAuth 2.0 Laravel.
 *
 * (c) Luca Degasperi <packages@lucadegasperi.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Streamlabs\OAuth2Server\Middleware;

use Closure;
use Streamlabs\OAuth2Server\Authorizer;

/**
 * This is the check auth code request middleware class.
 *
 * @author Luca Degasperi <packages@lucadegasperi.com>
 */
class CheckAuthCodeRequestMiddleware
{
    /**
     * The authorizer instance.
     *
     * @var \Streamlabs\OAuth2Server\Authorizer
     */
    protected $authorizer;

    /**
     * Create a new check auth code request middleware instance.
     *
     * @param \Streamlabs\OAuth2Server\Authorizer $authorizer
     */
    public function __construct(Authorizer $authorizer)
    {
        $this->authorizer = $authorizer;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request  $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->authorizer->setRequest($request);

        $this->authorizer->checkAuthCodeRequest();

        return $next($request);
    }
}

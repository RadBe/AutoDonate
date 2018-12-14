<?php

namespace App\Http\Middleware;

use App\Services\Auth\Authenticator;
use Closure;
use Illuminate\Http\Request;

class Auth
{
    /**
     * @var Authenticator
     */
    private $authenticator;

    /**
     * Auth constructor.
     *
     * @param Authenticator $authenticator
     */
    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    /**
     * @param string $ip
     * @return bool
     */
    private function checkIP(string $ip): bool
    {
        $allowedIPs = config('site.allowed_ips');

        if (empty($allowedIPs)) {
            return true;
        }

        $split = explode('.', $ip);

        foreach ($allowedIPs as $allowedIP)
        {
            $allowedSplit = explode('.', $allowedIP);

            $result = 0;

            for ($i = 0; $i < 4; $i++)
            {
                if (isset($allowedSplit[$i]) && ($allowedSplit[$i] == $split[$i] || $allowedSplit[$i] == '*')) {
                    ++$result;
                }
            }

            if ($result == 4) {
                return true;
            }
        }

        return false;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  null|string $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ?string $role = null)
    {
        if (is_null($role)) {
            if (!$this->authenticator->authenticate()->isInit()) {
                return redirect('/');
            }

            if (!$this->checkIP($request->ip())) {
                $this->authenticator->logout();
                return redirect('/');
            }

            return $next($request);
        }

        $session = $this->authenticator->authenticate();
        if(!$session->isInit() || $session->getRole() != $role) {
            return redirect('/');
        }

        if (!$this->checkIP($request->ip())) {
            $this->authenticator->logout();
            return redirect('/');
        }

        return $next($request);
    }
}

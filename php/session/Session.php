<?

class Session
{
    function sessionStart($lifetime, $path, $domain, $secure, $httpOnly)
    {
        session_set_cookie_params($lifetime, $path, $domain, $secure, $httpOnly);
        session_start();
    }
}
<?php

class Router
{
    private $request = [];
    protected array $routes = [
        "GET" => [],
        "POST" => []
    ];
// nicht in Verwendung
    private $regexSubstitutes = [
        ":str" => "([a-zA-Z]+?)",
        ":int" => "([0-9]+?)",
        ":si" => "([a-zA-Z0-9]+?)"
    ];

    function __construct()
    {
    }
    // ! bislang keine Methode die $callback aufruft vorhanden
    public function get($path, $callback=null)
    {
        $regexPath = $this->createRegexPattern(($path));
        array_push($this->routes["GET"], $regexPath);
    }

    public function post($path, $callback=null)
    {
        $regexPath = $this->createRegexPattern(($path));
        array_push($this->routes["POST"], $regexPath);
    }

    private function createRegexPattern($path)
    {

        $regexPattern = preg_replace("/\//", "\\/", $path);
        $regexPattern = preg_replace('/\{([a-z0-9-]+)\}/', '(?\'\1\'[a-z-_0-9]+)', $regexPattern);
        $regexPattern = "/^". $regexPattern. "/";
        // echo $regexPattern;
        return $regexPattern;
    }

    public function matchRoute($route, $method)
    {
        $this->setRequest("routeExists", false);
        /* CHANGE: "mvc_test" muss, wenn implementiert in Hotel-Seite wsl
        ** durch "Präfix" der Hotel URL ersetzt werden (zB "ipsumhotel")
        **/
        $route = str_replace("/mvc_test", "", $route);
        $this->setRequest("method", strtoupper($method));
        $this->setRequest("view", "");
        
        foreach($this->routes[$method] as $pattern)
        {
            if (preg_match($pattern, $route, $matches))
            {
                $this->request["routeExists"] = true;
                // var_dump($matches);
                $namedGroupMatches = array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY);

                foreach($namedGroupMatches as $key=>$value)
                {
                    // echo "\n". $matches["view"];
                    $this->setRequest($key, $value);
                }
            }
        }
        return $this->request;
    }
    protected function setRequest($key, $value)
    {
        $this->request[$key] = $value;
    }

    public function dispatch($route, $method)
    {
        // get query-params here?
        $this->request = $this->matchRoute($route, $method);

        return $this->request;
    }
}
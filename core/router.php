<?php

class Router
{
    private $routingInfo = [];
    protected array $routes = [
        "GET" => [],
        "POST" => []
    ];
    // (noch) nicht in Verwendung
    private $regexSubstitutes = [
        ":str" => "([a-zA-Z]+?)",
        ":int" => "([0-9]+?)",
        ":si" => "([a-zA-Z0-9]+?)"
    ];

    function __construct()
    {
    }

    public function get($path, $callback)
    {
        $regexPath = $this->createRegexPattern(($path));
        array_push($this->routes["GET"], $regexPath);
    }

    public function post($path, $callback)
    {
        $regexPath = $this->createRegexPattern(($path));
        array_push($this->routes["POST"], $regexPath);
    }

    private function createRegexPattern($path)
    {

        $regexPattern = preg_replace("/\//", "\\/", $path);
        $regexPattern = preg_replace('/\{([a-z]+)\}/', '(?\'\1\'[a-z-_]+)', $regexPattern);
        $regexPattern = "/^". $regexPattern. "/";
        // echo $regexPattern;
        return $regexPattern;
    }

    public function matchRoute($route, $method)
    {
        
        $this->setRoutingInfo("routeExists", false);
        /* CHANGE: "mvc_test" muss, wenn implementiert in Hotel-Seite wsl
        ** durch "Präfix" der Hotel URL ersetzt werden (zB "ipsumhotel")
        **/
        $route = str_replace("/mvc_test", "", $route);
        
        foreach($this->routes[$method] as $pattern)
        {
            if (preg_match($pattern, $route, $matches))
            {
                $this->routingInfo["routeExists"] = true;
                // var_dump($matches);
                $namedGroupMatches = array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY);

                foreach($namedGroupMatches as $key=>$value)
                {
                    // echo "\n". $matches["view"];
                    $this->setRoutingInfo($key, $value);
                }
            }
        }
        return $this->routingInfo;
    }
    protected function setRoutingInfo($key, $value)
    {
        $this->routingInfo[$key] = $value;
    }

    public function dispatch($route, $method)
    {
        // get query-params here?
        $this->routingInfo = $this->matchRoute($route, $method);

        return $this->routingInfo;
    }
}
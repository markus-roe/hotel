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
    public function get($path)
    {
        $regexPath = $this->createRegexPattern(($path));
        array_push($this->routes["GET"], $regexPath);
    }

    public function post($path)
    {
        $regexPath = $this->createRegexPattern(($path));
        array_push($this->routes["POST"], $regexPath);
    }

    public function createRegexPattern($path)
    {
        $regexPattern = preg_replace("/\//", "\\/", $path);
        $regexPattern = preg_replace('/\:([a-z0-9-]+)/', '(?\'\1\'[a-z-_0-9]+)', $regexPattern);
        $regexPattern = "/^". $regexPattern. "\/?$/";
        // echo $regexPattern;
        return $regexPattern;
    }
    //BUG Routing nicht eindeutig
    public function matchRoute($route, $method)
    {
        $this->setRequest("routeExists", false);
        /* CHANGE: "mvc_test" muss, wenn implementiert in Hotel-Seite wsl
        ** durch "Präfix" der Hotel URL ersetzt werden (zB "ipsumhotel")
        **/
        $route = preg_replace("/(\?[a-z=]+)/", "", $route);
        $route = str_replace("/mvc_test", "", $route);
        $this->setRequest("method", strtoupper($method));
        $this->setRequest("view", "");
        $this->setRequest("res", "");
        $this->request = array_merge($this->request, $_GET);
        $counter = -1;
        preg_match_all("/([a-z-]+)/", $route, $controllerAndView);
        // var_dump($controllerAndView);
        $this->setRequest("controller", $controllerAndView[0][0]);
        $this->setRequest("view", $controllerAndView[0][1]);
        
        foreach($this->routes[$method] as $pattern)
        {
            ++$counter;
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
                return $this->request;
                break;

            }
        }
    }
    protected function setRequest($key, $value)
    {
        $this->request[$key] = $value;
    }

    private function getUri(): string
    {
        return str_replace("/hotel", "." , $_SERVER["REQUEST_URI"]);
    }

    public function dispatch($route, $method)
    {
        // get query-params here?
        $this->setRequest("current_uri", $this->getUri());
        $this->request = $this->matchRoute($route, $method);

        return $this->request;
    }
}
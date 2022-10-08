<?php

// INSPIRATION https://www.php.net/manual/en/language.oop5.overloading.php

// FIXME wie $templatePath angeben?
class View
{
    public $templates = [];
    protected $params = [];
    // IMPROVE params die Konstruktor übergeben werden
    // direkt über assignNecessaryParams gefiltert in $params speichern
    protected $externalParams = [];
    public $name;
    protected $view = '';

    protected $views;

    /* ? in View::params ist festgelegt welche Parameter
    ** View sich im Kontext einer Komposit-Templates (zB Home)
    ** herauspicken soll, damit nicht immer über alle
    ** Parameter beim Rendern iteriert werden muss
    */

    // IMPROVE Constructor is voll hässlich
    function __construct($params = null, $fileName=null)
    {
        $this->templatePath = getcwd()."/public/templates/";

        $this->name = $fileName;
        if ($fileName != null)
        {
            $this->view = $this->readFromFile($fileName);
        }

        if ($params != null)
        {
            $this->setParams($params);
        }

    }

    public function readFromFile($templateName)
    {
        $fileName = $this->templatePath.$templateName.".php";
        if (file_exists($fileName))
        {
            return file_get_contents($fileName);
        }
        throw new Exception("File ". $fileName. " not found...");
    }

     public static function renderTemplate($template, $params=null)
    {
        if ($params == null || count($params) <= 0) 
        {
            return $template;
        }
        $renderedTemplate = $template;

        foreach($params as $key=>$value)
            {
                $renderedTemplate = preg_replace("/(\{\{". $key ."\}\})/", htmlspecialchars($value), $renderedTemplate);

            }
        
        return $renderedTemplate;
    }

    public function render() 
    {
        $this->before();
        if ($this->view == "")
        {
            $rawTemplate = $this->readFromFile($this->name);
            $this->view = View::renderTemplate($rawTemplate, $this->params);
            return 0;
        }

        $this->view = View::renderTemplate($this->view, $this->params);
        $this->after();
        // var_dump($this->params);
        return 1;
    }

    public function display()
    {
        if ($this->view == "")
        {
            return 0;
        }
        echo $this->view;
        
        
        return 1;
    }

    public function displayAll()
    {
        if (count($this->views) == 0)
        {
            return 0;
        }

        foreach ($this->views as $name=>$viewObj)
        {
            $viewObj->display();
        }

        return 1;
    }

    // TODO noch nicht in Verwendung

    protected function assignNessecaryParams($externalParams)
    {
        foreach($this->params as $param)
        {
            if (in_array($param, $externalParams))
            {
                $this->params[$param] = $externalParams[$param];
            }
        }
    }

    public function before()
    {
    }

    public function after()
    {
    }

    public function getView()
    {
        return $this->view;
    }

    public function setName($newName)
    {
        $this->name = $newName;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function changeParam($key, $value)
    {
        $this->params[$key] = $value;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }
}
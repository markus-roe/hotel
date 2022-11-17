<?php

class View
{
    public $templates = [];
    protected $params = [];
    protected $externalParams = [];
    protected $requiredParams = [];
    public $name;
    protected $view = '';

    function __construct($fileName=null, $requiredParams = null)
    {
        $this->requiredParams = $requiredParams;
        $this->name = $fileName;
        if ($fileName != null)
        {
            $templatePathPrefix = getcwd()."/public/templates/";
            $this->view = View::readFromFile($templatePathPrefix.$fileName);
        }
    }

    public static function readFromFile($templateName)
    {
        $fileName = $templateName.".php";
        if (file_exists($fileName))
        {
            return file_get_contents($fileName);
        }
        throw new Exception("File ". $fileName. " not found...");
    }

     public static function parseTemplate($template, $params=null)
    {
        // if ($params == null || count($params) <= 0) 
        // {
        //     return $template;
        // }
        $renderedTemplate = $template;

        foreach($params as $key=>$value)
            {
                $renderedTemplate = preg_replace("/(\{\{". $key ."\}\})/", $value, $renderedTemplate);
            }
        
        // ! ersetzt leere Slots (die in $params nicht definiert wurden) durch leeren String
        $renderedTemplate = preg_replace("/(\{\{[a-zA-Z0-9-]+\}\})/", "", $renderedTemplate);
        
        return $renderedTemplate;
    }

    public function parse($params)
    {
        $this->extractRequiredParams($params);

        $this->view = View::parseTemplate($this->view, $this->params);
    }

    public function render() 
    {
        $this->before();
        echo html_entity_decode($this->view);
        $this->after();

        return 1;
    }

    public function display() 
    {
        if ($this->view == "")
        {
            return 0;
        }
        echo html_entity_decode($this->view);
        
        
        return 1;
    }
    // OBSOLETE
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

    // IMPROVE Conditions könnten hübscher sein
    protected function extractRequiredParams($externalParams)
    {
        // if (count($this->requiredParams) == 0)
        // {
        //     $this->setParams($externalParams);
        //     return;
        // }
        if ($this->requiredParams == null)
        {
            return 0;
        }
        foreach($this->requiredParams as $requiredParamKey => $requiredParamValue)
        {
            // wenn Array nur Namen der Schlüssel aber keine vordefinierten Values enthält,
            // ist $requiredParamKey automatisch Index im Array -> gettype...
            // echo gettype($requiredParamKey);
            if (gettype($requiredParamKey) == "integer" && array_key_exists($requiredParamValue, $externalParams))
            {
                $this->params[$requiredParamValue] = $externalParams[$requiredParamValue];
                continue;
            }
            else
            {
                $this->params[$requiredParamKey] = $requiredParamValue;

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

    public function updateParam($key, $value)
    {
        $this->params[$key] = $value;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }
}
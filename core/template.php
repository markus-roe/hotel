<?php

class Template
{
    // public $templates = [];
    protected $params = [];
    protected $externalParams = [];
    protected $requiredParams = [];
    public $name;
    protected $template = '';

    function __construct($fileName=null, $requiredParams = null)
    {
        $this->requiredParams = $requiredParams;
        $this->name = $fileName;
        if ($fileName != null)
        {
            $templatePathPrefix = getcwd()."/public/templates/";
            $this->template= Template::readFromFile($templatePathPrefix.$fileName);
        }
    }

    public static function readFromFile($templateName): string
    {
        $fileName = $templateName.".php";
        if (file_exists($fileName))
        {
            return file_get_contents($fileName);
        }
        throw new Exception("File ". $fileName. " not found...");
    }

     public static function parseTemplate($template, $params=null): string
    {
        // if ($params == null || count($params) <= 0) 
        // {
        //     return $template;
        // }
        $renderedTemplate = $template;
        
        if ($params != null)
        {
            foreach($params as $key=>$value)
            {
                $renderedTemplate = preg_replace("/(\{\{". $key ."\}\})/", $value, $renderedTemplate);
            }
        }
        
        // ! ersetzt leere Slots (die in $params nicht definiert wurden) durch leeren String
        $renderedTemplate = preg_replace("/(\{\{[a-zA-Z0-9-]+\}\})/", "", $renderedTemplate);
        
        return $renderedTemplate;
    }

    public function parse($params=null): void
    {
        $this->extractRequiredParams($params);

        $this->template= Template::parseTemplate($this->template, $this->params);
    }

    public function render(): void
    {
        $this->before();
        echo html_entity_decode($this->template);
        $this->after();

    }

    public function display() 
    {
        if ($this->template== "")
        {
            return 0;
        }
        echo html_entity_decode($this->template);
        
        
        return 1;
    }
    // OBSOLETE
    public function displayAll()
    {
        if (count($this->templates) == 0)
        {
            return 0;
        }

        foreach ($this->templates as $name=>$viewObj)
        {
            $viewObj->display();
        }

        return 1;
    }

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

    public function getTemplate()
    {
        return $this->template;
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
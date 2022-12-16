<?php

require_once getcwd()."/core/template.php";
class Component extends Template
{
    protected $params = [];
    protected $extractedTemplates = [];
    protected $templates = [];
    protected $template = "";
    protected $templatesAlreadyExtracted = false;
    protected $templateRootPath = "./public/views/";

    function __construct()
    {
    }

    public function extractTemplatesFromComponents(): void
    {
        // gibt Views in extractedViews-Array
        // checkt ob Objekt vom Typ View ist oder Component
        // extrahiert View-Objekt falls es sich um Component handelt
        $this->filterTemplates($this->templates);
        $this->templatesAlreadyExtracted = true;
    }
    

    public function parse($params=[]): void
    {
        $this->params = $params;
        $this->extractTemplatesFromComponents();

        foreach($this->extractedTemplates as $template)
        {
            $template->parse($params);
        }
    }

    public function render(): void
    {
        ob_start();
        $this->before();
        if (!$this->templatesAlreadyExtracted)
        {
            $this->extractTemplatesFromComponents();
        }
        foreach($this->extractedTemplates as $template)
        {
            $template->render();
        }

        $this->after();
        ob_flush();
    }

    protected function requireTemplate($templateName): bool
    {
        $templatePath = $this->templateRootPath;
        $templatePath .= $templateName.".php";
        try{
            require_once $templatePath;
            return 1;
        }
        catch (\Throwable $th) {
            echo $th;
        }
        

        return 0;
    }

    public function insert($componentName, $newComponent): bool
    {
        if (array_key_exists($componentName, $this->templates))
        {
            $this->templates[$componentName] = $newComponent;
            return 1;
        }
        return 0;
    }


    // extrahiert View-Objekte aus Component-Objekten
    public function filterTemplates($templateObj): void
    {
        foreach($templateObj as $template)
        {
            if ($template == null) continue;
            if (get_class($template) != "Template")
            {
                $this->filterTemplates($template->templates);
            }
            else
            {
                array_push($this->extractedTemplates, $template);
            }
        }
    }
}

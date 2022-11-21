<?php

require_once getcwd()."/core/view.php";
class Component extends View
{
    protected $params = [];
    protected $extractedViews = [];
    protected $views = [];
    protected $view = "";
    protected $viewsAlreadyExtracted = false;
    protected $viewRootPath = "./public/views/";

    function __construct()
    {
    }

    public function extractViewsFromComponents()
    {
        // gibt Views in extractedViews-Array
        // checkt ob Objekt vom Typ View ist oder Component
        // extrahiert View-Objekt falls es sich um Component handelt
        $this->filterViews($this->views);
        $this->viewsAlreadyExtracted = true;
    }
    

    public function parse($params=[])
    {
        $this->params = $params;
        $this->extractViewsFromComponents();

        foreach($this->extractedViews as $view)
        {
            $view->parse($params);
        }
    }

    public function render()
    {
        $this->before();
        if (!$this->viewsAlreadyExtracted)
        {
            $this->extractViewsFromComponents();
        }
        foreach($this->extractedViews as $view)
        {
            $view->render();
        }

        $this->after();

    }

    protected function requireView($viewName)
    {
        $viewPath = $this->viewRootPath;
        $viewPath .= $viewName.".php";
        
        if (file_exists($viewPath))
        {
            require_once $viewPath;
            return 1;
        }

        return 0;
    }

    public function insert($componentName, $newComponent)
    {
        if (array_key_exists($componentName, $this->views))
        {
            $this->views[$componentName] = $newComponent;
            return 1;
        }
        return 0;
    }


    // extrahiert View-Objekte aus Component-Objekten
    public function filterViews($viewObj)
    {
        foreach($viewObj as $view)
        {
            if (get_class($view) != "View")
            {
                $this->filterViews($view->views);
            }
            else
            {
                array_push($this->extractedViews, $view);
            }
        }
    }
}

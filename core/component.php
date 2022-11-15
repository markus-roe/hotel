<?php

require_once getcwd()."/core/view.php";

class Component extends View
{
    protected $params = [];
    protected $extractedViews = [];
    protected $views = [];
    protected $view = "";
    protected $viewsAlreadyExtracted = false;

    function __construct()
    {
    }

    public function extractViewsFromComponents()
    {
        // gibt Views in extractedViews-Array
        // checkt ob Objekt vom Typ View ist oder Component
        // extrahiert View-Objekt falls es sich um Component handelt
        $this->extractedViews = [];
        foreach ($this->views as $viewNameKey => $viewObj) {
            if (get_class($viewObj) != "View") {
                foreach ($viewObj->views as $viewComponentEl) {
                    $view = $this->filterViews($viewComponentEl);
                    // $view->render();
                    array_push($this->extractedViews, $view);
                }
            } else {
                array_push($this->extractedViews, $viewObj);
            }
        }
        $this->viewsAlreadyExtracted = true;
    }
    

    public function parse($params=[])
    {
        $this->params = $params;
        $this->extractViewsFromComponents();

        foreach($this->extractedViews as $view)
        {
            $view->parse($params);
            // $this->view .= $view->getView();
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
        // parent::display();
        $this->after();

    }

    public function insertComponent($componentName, $newComponent)
    {
        if (in_array($componentName, $this->views))
        {
            $this->views[$componentName] = $newComponent;
            return 1;
        }
        return 0;
    }


    // extrahiert View-Objekte aus Component-Objekten
    public function filterViews($viewObj)
    {
        if (get_class($viewObj) != "View") {
            return $this->filterViews(array_shift($viewObj->views));
        }

        return $viewObj;
    }
}

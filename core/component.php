<?php

require_once getcwd()."/core/view.php";

class Component extends View
{
    protected $params = [];
    protected $virtualViews = [];
    protected $views = [];
    protected $view = "";
    protected $viewsAlreadyExtracted = false;

    function __construct()
    {
    }

    // IMPROVE voll hässlich und unübersichtlich
    // ? bei nested-components -> sollte jeder component sich selbst rendern und
    // parent-component nur resultat (eigenes $virtualViews) returnen?
    public function extractViewsFromComponents()
    {
        // gibt Views in virtualViews-Array
        // checkt ob Objekt vom Typ View ist oder Component
        // extrahiert View-Objekt falls es sich um Component handelt
        if ($this->viewsAlreadyExtracted)
        {
            return;
        }
        foreach ($this->views as $viewNameKey => $viewObj) {
            if (get_class($viewObj) != "View") {
                foreach ($viewObj->views as $viewComponentEl) {
                    $view = $this->filterViews($viewComponentEl);
                    // $view->render();
                    array_push($this->virtualViews, $view);
                }
            } else {
                array_push($this->virtualViews, $viewObj);
            }

        }
        $this->viewsAlreadyExtracted = true;
    }
    

    public function parse($params)
    {
        $this->params = $params;
        $this->extractViewsFromComponents();

        foreach($this->virtualViews as $view)
        {
            $view->parse($params);
            $this->view .= $view->getView();
        }
    }

    public function render()
    {
        $this->before();
        parent::display();
        $this->after();

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

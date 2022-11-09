<?php

require_once getcwd()."/core/view.php";

function displayArr($arr)
{
    echo "<pre>";
    var_dump($arr);
    echo "</pre>";
}

class Compound extends View
{
    protected $params = [];
    protected $virtualViews = [];
    protected $views = [];
    protected $viewsAlreadyExtracted = false;

    function __construct()
    {
        // parent::__construct(null, null);
        // $this->params;
        // foreach ($this->views as $viewName => $viewEl) {
        //     $this->setName($viewName, $viewName);
        // }
    }

    // IMPROVE voll hässlich und unübersichtlich
    // ? bei nested-compounds -> sollte jeder compound sich selbst rendern und
    // parent-compound nur resultat (eigenes $virtualViews) returnen?
    public function extractViewsFromCompounds()
    {
        // gibt Views in virtualViews-Array
        // checkt ob Objekt vom Typ View ist oder Compound
        // extrahiert View-Objekt falls es sich um Compound handelt
        if ($this->viewsAlreadyExtracted)
        {
            return;
        }
        foreach ($this->views as $viewNameKey => $viewObj) {
            if (get_class($viewObj) != "View") {
                foreach ($viewObj->views as $viewCompoundEl) {
                    $view = $this->filterViews($viewCompoundEl);
                    // $view->render();
                    array_push($this->virtualViews, $view);
                }
            } else {
                array_push($this->virtualViews, $viewObj);
            }

            // $this->virtualViews[count($this->virtualViews) - 1]->render();
        }
        $this->viewsAlreadyExtracted = true;
    }

    public function render($params=null)
    {
        if (!$this->viewsAlreadyExtracted)
        {
            $this->extractViewsFromCompounds();
        }

        $this->before();

        foreach($this->virtualViews as $view)
        {
            $view->render($params);
        }
        $this->after();

        $this->display();
    }

    public function display()
    {
        if (!$this->viewsAlreadyExtracted)
        {
            return 0;
        }

        foreach ($this->virtualViews as $viewObj => $view) {
            $view->display();
        }
    }

    // extrahiert View-Objekte aus Compound-Objekten
    public function filterViews($viewObj)
    {
        if (get_class($viewObj) != "View") {
            return $this->filterViews(array_shift($viewObj->views));
        }

        return $viewObj;
    }

    // public function setName($viewEl, $name)
    // {
    //     $this->views[$viewEl]->name = $name;
    // }

    // TODO
    // protected function extractViewsFromCompound($compound)
    // {
    //     foreach($compound as $views=>)
    // }
}

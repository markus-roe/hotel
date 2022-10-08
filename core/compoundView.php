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

    function __construct($params)
    {
        parent::__construct($params, null);

        // foreach ($this->views as $viewName => $viewEl) {
        //     $this->setName($viewName, $viewName);
        // }
    }

    // IMPROVE voll hässlich und unübersichtlich
    // ? bei nested-compounds -> sollte jeder compound sich selbst rendern und
    // parent-compound nur resultat (eigenes $virtualViews) returnen?
    public function render()
    {
        $this->before();
        // gibt Views in virtualViews-Array
        // checkt ob Objekt vom Typ View ist oder Compound
        // extrahiert View-Objekt falls es sich um Compound handelt
        foreach ($this->views as $viewNameKey => $viewObj) {
            if (get_class($viewObj) != "View") {
                foreach ($viewObj->views as $viewCompoundEl) {
                    $view = $this->filterViews($viewCompoundEl);
                    $view->render();
                    array_push($this->virtualViews, $view);
                }
            } else {
                array_push($this->virtualViews, $viewObj);
            }

            $this->virtualViews[count($this->virtualViews) - 1]->render();
        }
        $this->after();
    }

    public function display()
    {
        foreach ($this->virtualViews as $viewObj => $view) {
            echo html_entity_decode($view->view);
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

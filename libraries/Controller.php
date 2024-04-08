<?php

class Controller
{
    protected function viewRender($view, $data = null)
    {
        require('views/admin/layouts/Header.php');
        require('views/' . $view . '.php');
        require('views/admin/layouts/Footer.php');
    }

    protected function modelRender($modelName)
    {
        require_once('models/' . ucfirst($modelName) . '.php');
        return $model = new $modelName;
    }
}

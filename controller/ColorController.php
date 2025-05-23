<?php

namespace controller;

use config\Connection;
use model\Color;

class ColorController
{
    private $color;

    public function __construct()
    {
        $connection = new Connection();
        $db = $connection->getConnection();
        $this->color = new Color($db);
    }

    public function getColors()
    {
        return $this->color->getAll();
    }

    public function edit($id)
    {
        return $this->color->getById($id);
    }

    public function update($id, $name)
    {
        return $this->color->update($id, $name);
    }

    public function store($name)
    {
        return $this->color->create($name);
    }

    public function delete($id)
    {
        return $this->color->delete($id);
    }
}

<?php
namespace controller;

abstract class controller
{
    /**
     * @param array $GET
     * @param array $POST
     * this function should handle the composition, creation, and variables needed within the page
     */
    abstract function render(array $GET, array $POST): void;
}
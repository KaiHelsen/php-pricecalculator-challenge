<?php
namespace controller;

class priceCalcController extends controller
{

    /**
     * @inheritDoc
     */
    function render(array $GET, array $POST): void
    {
        // TODO: Implement render() method.

        require ("view/priceCalcView.php");
    }
}
<?php
declare(strict_types=1);

require 'vendor/autoload.php';

require 'models/Customer.php';
require 'models/DbConnect.php';
require 'loaders/CustomerLoader.php';

declare(strict_types=1);

//require models
//require controllers
require_once("controllers/controller.php");
require_once("controllers/priceCalcController.php");

//navigational CONST values
//these tend to be a better idea than to rely on re-using the same strings
//declare a const once and reuse when needed. this allows for naming uniformity across the model
const PAGE = 'page';
const HOME = 'home';

$controller = new priceCalcController;
if (isset($GET[PAGE]))
{
    switch ($_GET[PAGE])
    {
        //implement other cases here if appropriate
        case(HOME):
        default:
            $controller = new priceCalcController;
            break;
    }
}

$controller->render($_GET, $_POST);

include("view/includes/header.php");

?>

<h1>Test</h1>

<?php
include("view/includes/footer.php");

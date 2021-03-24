<?php
declare(strict_types=1);

//require models

require_once 'models/Customer.php';
require_once 'models/DbConnect.php';

//require loaders
require_once 'loaders/CustomerLoader.php';
require_once 'loaders/loader.php';


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


echo loader::foo();
$controller->render($_GET, $_POST);

include("view/includes/header.php");

?>

<h1>Test</h1>

<?php
include("view/includes/footer.php");

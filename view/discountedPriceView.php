<?php
declare(strict_types=1);

const PERCENT = '%';
const EURO = '&euro; '

//var_dump($customer);
?>


<table class="table mx-0, my-5">
    <thead class="text-center">
    <tr>
        <th scope="col">Price per Item</th>
        <th scope="col">Quantity</th>
        <th scope="col">Bulk Price</th>
        <th scope="col">Personal Discount</th>
        <th scope="col">Group Discount</th>
        <th scope="col">New Price</th>
    </tr>
    </thead>
    <tbody>
    <tr class="text-center">
        <td><?php echo '&euro; ' . number_format(($product->getPrice() / 100), 2) ?></td>
        <td><?php echo $quantity . " pieces"; ?></td>
        <td><?php echo '&euro; ' . number_format((float)$bulkPriceDsp, 2); ?></td>
        <td><?php
            echo ($customer->getCustomerDiscount()->isFixed()) ? EURO : '';
            echo number_format($customer->getCustomerDiscount()->getAmount(), 2);
            echo ($customer->getCustomerDiscount()->isVariable()) ? PERCENT : '';
            ?></td>
        <td><?php
            echo ($groupDiscount->isFixed()) ? EURO : '';
            echo number_format($groupDiscount->getAmount(), 2);
            echo ($groupDiscount->isVariable()) ? PERCENT : '';
            ?></td>
        <td><?php echo '&euro; ' . number_format($newPrice, 2); ?></td>
    </tr>
    </tbody>
</table>

<div id="accordion" class="mb-5">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-outline-info" data-toggle="collapse"
                        data-target="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne">
                    See calculation of your price
                </button>
            </h5>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
             data-parent="#accordion">
            <div class="card-body text-center">
                <p>This part of our website is still under construction. It might be ready
                    by the time Elon has planted his flag on Mars. No promises though...</p>
            </div>
        </div>
    </div>
</div>


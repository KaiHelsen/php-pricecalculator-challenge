<?php
declare(strict_types=1);

const PERCENT = '%';
const EURO = '&euro; '

//var_dump($customer);
?>


<table class="table mx-0, my-5">
    <thead class="text-center">
    <tr>
        <th scope="col">Price</th>
        <th scope="col">Personal Discount</th>
        <th scope="col">Group Discount</th>
        <th scope="col">New Price</th>
    </tr>
    </thead>
    <tbody>
    <tr class="text-center">
        <td><?php echo '&euro; ' . $product->getPrice() / 100 ?></td>
        <td><?php
            echo ($customer->getCustomerDiscount()->isFixed()) ? EURO : '';
            echo $customer->getCustomerDiscount()->getAmount();
            echo ($customer->getCustomerDiscount()->isVariable()) ? PERCENT : '';
            ?></td>
        <td><?php
            echo ($groupDiscount->isFixed()) ? EURO : '';
            echo $groupDiscount->getAmount();
            echo ($groupDiscount->isVariable()) ? PERCENT : '';
            ?></td>
        <td><?php echo '&euro; ' . $newPrice ?></td>
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
            <div class="card-body">
                <ol>
                    <li>First we calculate which of your group discounts is the
                        highest: </li>
                    <li>Then we check your personal discount</li>
                    <li>Bla bla bla</li>
                </ol>
            </div>
        </div>
    </div>
</div>


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
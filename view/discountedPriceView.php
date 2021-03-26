<?php
declare(strict_types=1);

//var_dump($customer);
?>


<table class="table mx-0, my-5">
    <thead>
    <tr>
        <th scope="col">Price</th>
        <th scope="col">Personal Discount</th>
        <th scope="col">Group Discount</th>
        <th scope="col">New Price</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo '&euro; '.$product->getPrice()/100?></td>
        <td><?php echo '&euro; '.$customer->getCustomerDiscount()->getAmount()?></td>
        <td><?php echo '&euro; '?></td>
        <td><?php echo '&euro; '.$newPrice?></td>
    </tr>
    </tbody>
</table>
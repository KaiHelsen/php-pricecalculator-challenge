<?php
declare(strict_types=1);
//var_dump($allCustomers);
//var_dump($_GET);
?>
<h1>This is where we calculate things!</h1>

<form method="get">
    <table>
        <tr>
            <th><label for="customerId">Customer</label></th>
            <th><label for="productId">Customer</label></th>
        </tr>
        <tr>
            <td>
                <?php if(isset($allCustomers, $allProducts)):?>
                <select name="<?php echo self::CUSTOMER; ?>" id="customerId">
                    <?php foreach ($allCustomers as $customer): ?>
                        <option value="<?php echo $customer->getId(); ?>" <?php echo ($customer->getId() === (int)$GET['customerId']) ? 'selected' : ''; ?>><?php echo
                                $customer->getFirstName().' '.$customer->getLastName();
                        ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <select name="productId" id="productId">
                    <?php foreach ($allProducts as $product): ?>
                        <option value="<?php echo $product->getId(); ?>" <?php echo ($product->getId() === (int)$GET['productId']) ? 'selected' : ''; ?>><?php echo $product->getName(); ?></option>
                    <?php endforeach;
                    endif;?>
                </select>
            </td>
            <td>
                <button type="submit" class="">Submit!</button>
            </td>
        </tr>
    </table>

<?php if(isset($newPrice)): ?>
<p><?php echo $newPrice ?></p>

<?php endif; ?>

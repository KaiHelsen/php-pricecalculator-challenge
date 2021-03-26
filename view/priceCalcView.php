<?php
declare(strict_types=1);
//var_dump($allCustomers);
//var_dump($_POST);
?>
<h1>This is where we calculate things!</h1>

<form method="get">
    <table>
        <tr>
            <th><label for="<?php echo CUSTOMER_TAG; ?>">Customer</label></th>
            <th><label for="<?php echo PRODUCT_TAG; ?>">Product</label></th>
        </tr>
        <tr>
            <td>
                <?php if(isset($allCustomers, $allProducts)):?>
                <select name="<?php echo CUSTOMER_TAG; ?>" id="<?php echo CUSTOMER_TAG; ?>">
                    <?php foreach ($allCustomers as $customer): ?>
                        <option value="<?php echo $customer->getId(); ?>" <?php echo (isset($GET[CUSTOMER_TAG]) && $customer->getId() === (int)$GET[CUSTOMER_TAG]) ? 'selected' : ''; ?>><?php echo
                                $customer->getFirstName().' '.$customer->getLastName();
                        ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <select name="<?php echo PRODUCT_TAG; ?>" id="<?php echo PRODUCT_TAG; ?>">
                    <?php foreach ($allProducts as $product): ?>
                        <option value="<?php echo $product->getId(); ?>" <?php echo (isset($GET[PRODUCT_TAG]) && $product->getId() === (int)$GET[PRODUCT_TAG]) ? 'selected' : ''; ?>><?php echo $product->getName(); ?></option>
                    <?php endforeach;
                    endif;?>
                </select>
            </td>
            <td>
                <button type="submit" class="">Submit!</button>
            </td>
        </tr>
    </table>

</form>

<?php //if(isset($newPrice)): ?>
<!--<p>--><?php //echo $newPrice ?><!--</p>-->
<!---->
<?php //endif; ?>

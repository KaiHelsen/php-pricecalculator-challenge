<?php
declare(strict_types=1);
//var_dump($allCustomers);
//var_dump($_POST);
?>

<form method="get" class="mx-0, my-5">
    <table class="form-group">
        <tr>
            <th><label for="<?php echo CUSTOMER_TAG; ?>">Customer</label></th>
            <th><label for="<?php echo PRODUCT_TAG; ?>">Product</label></th>
        </tr>
        <tr>
            <td>
                <?php if (isset($allCustomers, $allProducts)): ?>
                <select class="form-control" name="<?php echo CUSTOMER_TAG; ?>"
                        id="<?php
                        echo
                        CUSTOMER_TAG; ?>">
                    <?php foreach ($allCustomers as $currentCustomer): ?>
                        <option value="<?php echo $currentCustomer->getId(); ?>" <?php echo (isset($GET[CUSTOMER_TAG]) && $currentCustomer->getId() === (int)$GET[CUSTOMER_TAG]) ? 'selected' : ''; ?>><?php echo
                                $currentCustomer->getFirstName() . ' ' . $currentCustomer->getLastName();
                            ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <select class="form-control" name="<?php echo PRODUCT_TAG; ?>"
                        id="<?php
                        echo
                        PRODUCT_TAG;
                        ?>">
                    <?php foreach ($allProducts as $product): ?>
                        <option value="<?php echo $product->getId(); ?>" <?php echo (isset($GET[PRODUCT_TAG]) && $product->getId() === (int)$GET[PRODUCT_TAG]) ? 'selected' : ''; ?>><?php echo $product->getName(); ?></option>
                    <?php endforeach;
                    endif; ?>
                </select>
            </td>
            <td>
                <button type="submit" class="btn btn-info">Submit!</button>
            </td>
        </tr>
    </table>
</form>

<?php //if(isset($newPrice)): ?>
<!--<p>--><?php //echo $newPrice ?><!--</p>-->
<!---->
<?php //endif; ?>

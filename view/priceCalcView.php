<?php
declare(strict_types=1);
//var_dump($allCustomers);
//var_dump($_POST);
?>

<form method="get" class="mx-0, my-5 justify-content-center">
    <table class="form-group mx-auto text-center">
        <tr>
            <th><label for="<?php echo CUSTOMER_TAG; ?>">Customer</label></th>
            <th><label for="<?php echo PRODUCT_TAG; ?>">Product</label></th>
            <th><label for="quantity">Quantity</label></th>
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
                <select class="form-control text-capitalize" name="<?php echo PRODUCT_TAG;
                ?>"
                        id="<?php
                        echo
                        PRODUCT_TAG;
                        ?>">
                    <?php foreach ($allProducts as $currentProduct): ?>
                        <option value="<?php echo $currentProduct->getId(); ?>" <?php echo (isset($GET[PRODUCT_TAG]) && $currentProduct->getId() === (int)$GET[PRODUCT_TAG]) ? 'selected' : ''; ?>><?php echo $currentProduct->getName(); ?></option>
                    <?php endforeach;
                    endif; ?>
                </select>
            </td>
            <td>
                <input type="number" name="quantity" id="quantity" value="<?php echo $quantity; ?>" min="1" max="40000" required>
            </td>
            <td>
                <button type="submit" class="btn btn-info">Submit!</button>
            </td>
        </tr>
    </table>
</form>

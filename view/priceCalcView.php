<?php
declare(strict_types=1);

require("view/includes/header.php");
?>
<h1>This is where we calculate things!</h1>

<form method="get">
    <table>
        <tr>
            <th><label for 'customer'>Customer</label></th>
            <th><label for 'customer'>Customer</label></th>
        </tr>
        <tr>
            <td>
                <?php if(isset($allCustomers, $allProducts)):?>
                <select name="customerId" id="customerId">
                    <?php foreach ($allCustomers as $customer): ?>
                        <option value="<?php echo $customer['id']; ?>"><?php echo
                                $customer['firstName'].' '.$customer['lastName'];
                        ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <select name="productId" id="productId">
                    <?php foreach ($allProducts as $product): ?>
                        <option value="<?php echo $product->getId(); ?>"><?php echo $product->getName(); ?></option>
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

<?php if(isset($newPrice)): ?>
<p><?php echo $newPrice ?></p>

<?php
endif;
require("view/includes/footer.php"); ?>

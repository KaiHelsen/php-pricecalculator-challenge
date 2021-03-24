<?php
declare(strict_types=1); ?>
<?php require("view/includes/header.php"); ?>
<h1>This is where we calculate things!</h1>

<form method="post">
    <table>
        <tr>
            <th><label for 'customer'>Customer</label></th>
            <th><label for 'customer'>Customer</label></th>
        </tr>
        <tr>
            <td>
                <select name="customerId" id="customerId">
                    <?php foreach ([1, 2, 3, 4, 5] as $item): ?>
                        <option value="<?php echo $item; ?>"><?php echo 'option ' . $item; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <select name="productId" id="productId">
                    <?php foreach ([1, 2, 3, 4, 5] as $item): ?>
                        <option value="<?php echo $item; ?>"><?php echo 'option ' . $item; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <button type="submit" class="">Submit!</button>
            </td>
        </tr>
    </table>

</form>
<?php require("view/includes/footer.php"); ?>

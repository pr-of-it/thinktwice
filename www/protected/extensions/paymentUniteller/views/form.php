Сумма: <?php echo $acquiring->Subtotal_P; ?>
<form action="https://wpay.uniteller.ru/pay/" method="POST">
    <input type="hidden" name="Shop_IDP" value="<?php echo $acquiring->Shop_IDP; ?>" />
    <input type="hidden" name="Order_IDP" value="<?php echo $acquiring->Order_IDP; ?>" />
    <input type="hidden" name="Subtotal_P" value="<?php echo $acquiring->Subtotal_P; ?>" />
    <input type="hidden" name="Lifetime" value="<?php echo $acquiring->Lifetime; ?>" />
    <input type="hidden" name="Customer_IDP" value="<?php echo $acquiring->Customer_IDP; ?>" />
    <input type="hidden" name="Signature" value="<?php echo $acquiring->Signature; ?>" />
    <input type="submit" name="Submit" value="Оплатить" />
    <input type="hidden" name="URL_RETURN_OK" value="<?php echo $acquiring->URL_RETURN_OK; ?>" />
    <input type="hidden" name="URL_RETURN_NO" value="<?php echo $acquiring->URL_RETURN_NO; ?>" />
    <input type="hidden" name="MeanType" value="<?php echo $acquiring->MeanType; ?>" />
    <input type="hidden" name="EMoneyType" value="<?php echo $acquiring->EMoneyType; ?>" />
</form>
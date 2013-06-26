<form action="https://wpay.uniteller.ru/pay/" method="POST">
    <input type="hidden" name="Shop_IDP" value="<?php echo $form->Shop_IDP; ?>">
    <input type="hidden" name="Order_IDP" value="<?php echo $form->Order_ID; ?>">
    <input type="hidden" name="Subtotal_P" value="<?php echo $form->Subtotal_P; ?>">
    <input type="hidden" name="Lifetime" value="<?php echo $form->Lifetime; ?>">
    <input type="hidden" name="Customer_IDP" value="<?php echo $form->Customer_IDP; ?>">
    <input type="hidden" name="Signature" value="<?php echo $form->Signature; ?>">
    <input type="submit" name="Submit" value="Оплатить">
    <input type="hidden" name="URL_RETURN_OK" value="<?php echo $form->$URL_RETURN_OK; ?>">
    <input type="hidden" name="URL_RETURN_NO" value="<?php echo $form->URL_RETURN_NO; ?>">
    <input type="hidden" name="MeanType" value="<?php echo $form->MeanType; ?>">
    <input type="hidden" name="EMoneyType" value="<?php echo $form->EMoneyType; ?>">
</form>
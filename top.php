//---------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------
//----------------------------------start customer id update value for old orders/invoice/shipments----------------------------------
//---------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------

$old_customer_id="25145";
$new_customer_id="25175";

//------------------------------old order-----------------------------------
$orders = Mage::getResourceModel('sales/order_collection')
    ->addFieldToSelect('*')
    ->addFieldToFilter('customer_id', $old_customer_id);
foreach ($orders as $order){
    $order->setCustomerId($new_customer_id);
    $order->save();
    var_dump("order update");
}

foreach ($orders as $order) {
    $orderObject = Mage::getModel('sales/order')->load($order->getId());
    $invoiceCollection = $orderObject->getInvoiceCollection();
    foreach ($invoiceCollection as $invoice) {
        $invoice->setCustomerId($new_customer_id);
        $invoice->save();
    }
    var_dump("invoice update");
}
foreach ($orders as $order){
    $order_ship = Mage::getModel('sales/order')->load($order->getId());
    foreach($order_ship->getShipmentsCollection() as $shipment){
        $shipment->setCustomerId($new_customer_id);
        $shipment->save();
        var_dump("shipment update");
    }
}
//------------------------------old order-----------------------------------







//------------------------------new order-----------------------------------
$orders = Mage::getResourceModel('sales/order_collection')
    ->addFieldToSelect('*')
    ->addFieldToFilter('customer_id', $new_customer_id);
$i=0;
foreach ($orders as $order){
    var_dump("-------------Order ".++$i."------------");
    var_dump($order->getId());
    var_dump($order->getCustomerId());


    $order_inv = Mage::getModel('sales/order')->load($order->getId());
    $invoiceCollection = $order_inv->getInvoiceCollection();
    foreach ($invoiceCollection as $invoice) {
        var_dump("-------------Invoice ".++$i."------------");
        var_dump($invoice->getId());
        var_dump($invoice->getCustomerId());
    }

    $order_ship = Mage::getModel('sales/order')->load($order->getId());
    foreach($order_ship->getShipmentsCollection() as $shipment) {
        var_dump("-------------Shipment ".++$i."------------");
        var_dump($shipment->getId());
        var_dump($shipment->getCustomerId());
    }
}
//------------------------------new order-----------------------------------




//---------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------
//----------------------------------end customer id update value for old orders/invoice/shipments----------------------------------
//---------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------
die("done and exit");

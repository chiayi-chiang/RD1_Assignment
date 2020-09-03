<?php
    private $_strInsertManyBase = "
    INSERT INTO `orderdetails`(`orderID`, `commodityID`, `orderCommodityPrice`, `orderCommodityQuantity`) VALUES";
    for ($i = 0; $i < count($orderDetails); $i++) {
    $this->_strInsertManyBase .= "(:orderID{$i},:commodityID{$i},:orderCommodityPrice{$i},:orderCommodityQuantity{$i})";
    
    }foreach ($orderDetails as $key => $item) {
    $sth->bindParam("orderID$key", $orderID);
    $sth->bindParam("commodityID$key", $item->getCommodityID());
    $sth->bindParam("orderCommodityPrice$key", $item->getOrderCommodityPrice());
    $sth->bindParam("orderCommodityQuantity$key", $item->getOrderCommodityQuantity());
    }
    $sth
?>

<?php

require_once 'Model/Model_Keranjang.php';

$ModelKeranjang = new ModelKeranjang();


echo '<pre>';
print_r($ModelKeranjang->getCartItems(2));
echo '</pre>';
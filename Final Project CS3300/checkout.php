<?php
session_start();
require_once 'config/database.php';
require_once 'config/security.php';
require_once 'models/Cart.php';
require_once 'models/Discount.php';


class Checkout {
    private $db;
    private $cart;
    private $order;
    private $discount;

    public function _construct($database) {
        $this->db = $database;
        $this->cart = new Cart($database);
        $this-> order = new Order($database);
        $this->discount = new Discount($database);

    }
}pricate function validShippingInfo($data) {
    $errors = [];

    if(empty($data['first_name'])) {
        $errors = [] = 'First name';
    }
    if(empty($data['last_name'])) {
        $errors = [] = 'Last name';
    }
    if(empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Email is required';
    }
    if(empty($data['adress']) {
        $error[] = 'Address is required';
    }
    if(empty($data['city']) {
        $error[] = 'City is required';
    }
    if(empty($data['postal_code']) {
        $error[] = 'Postal code is required';
     }
     if(empty($data['postal_code']) {
        $error[] = 'Postal code is required';
     }
     if(empty($data['country']) {
        $error[] = 'Country is required';
     }
     return $errors
}private function validatePaymentInfo($data) {
    $errors = [];
    return $errors;
}
public function applyDiscount($code, $total) {
    $discountDetails = $this->discount->validateDiscount($code);
    if($discountDetails) {
        $discountAmount = $total * ($discountDetails['value'] / 100);
    } else {
        $discountAmount = min($discountDetails['value'], $total);
    }
    return [
        'success' => true,
        'discount_amount' => $discountAmount,
        'final_total' => $total -$discountAmount
     ];
}
public function processOrder($shippingData, $paymentData, $discountCode = null) {
    $shippingErrors = $this->validateShippingInfo($shippingData); 
    $paymentErrors = $this->validatePaymentInfo($paymentData);
    if(!empty($shippingErrors) || !empty($paymentErrors)) {
        return [
            'success' =>false,
            'shipping_errors' => $shippingErrors,
            'payment_errors' => $paymentErrors
        ];
    }
}$cartItem = $this->cart->getUserCart($_SESSION['user_id']);
$subtotal = $this->cart->calculateTotal($cartItems);
$finalTotals =  $subtotal;
$discountAmount = 0;
if($discountCode) {
    $discountResult = $this->applyDiscount($discountCode, $subtotal);
    if($discountResult['success']) {
        $finalTotal = $discountResult['final_total'];
        $discountAmount = $discountResult['discount_amount'];
        
    }
}

}
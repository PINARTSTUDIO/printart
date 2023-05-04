<?php
if(isset($_POST['submit'])) {
    $to = "pinartstudioofficial@gmail.com";
    $subject = "New Order";
    
    // Get form data
    $width = $_POST['width'];
    $height = $_POST['height'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $design_cost = $_POST['design_cost'];
    $delivery = isset($_POST['delivery']) ? $_POST['delivery'] : "";
    
    // Calculate total cost
    $sq_feet = $width * $height;
    switch($category) {
        case "normal":
            $rate = 5;
            break;
        case "star":
            $rate = 7;
            break;
        case "backlight":
            $rate = 10;
            break;
        case "one_way_vision":
            $rate = 12;
            break;
        case "vinyl":
            $rate = 15;
            break;
        default:
            $rate = 0;
            break;
    }
    $total_cost = $sq_feet * $rate + $design_cost;
    
    // Email message
    $message = "New order details:\n\n";
    $message .= "Width: ".$width."\n";
    $message .= "Height: ".$height."\n";
    $message .= "Category: ".$category."\n";
    $message .= "Square Feet: ".$sq_feet."\n";
    $message .= "Design Cost: ".$design_cost."\n";
    $message .= "Delivery: ".$delivery."\n";
    $message .= "Total Cost: ".$total_cost."\n";
    $message .= "Description:\n".$description."\n";
    
    // Email headers
    $headers = "From: pinartstudioofficial@gmail.com\r\n";
    $headers .= "Reply-To: pinartstudioofficial@gmail.com\r\n";
    $headers .= "X-Mailer: PHP/".phpversion();
    
    // Send email
    if(mail($to, $subject, $message, $headers)) {
        header("Location: order-success.php");
        exit();
    } else {
        $error_message = "Sorry, there was an error processing your order. Please try again.";
    }
}
?>

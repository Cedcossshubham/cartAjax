<?php 
 
session_start();
//unset($_SESSION);

$products = array(array("id"=>101,"name"=>"Basket Ball","image"=>"basketball.png","price"=>150,"qnty"=>1,'tPrice'=>150),array("id"=>102,"name"=>"Football","image"=>"football.png","price"=>120,"qnty"=>1,'tPrice'=>120),array("id"=>103,"name"=>"Soccer","image"=>"soccer.png","price"=>110,"qnty"=>1,'tPrice'=>110),array("id"=>104,"name"=>"Table Tennis","image"=>"table-tennis.png","price"=>130,"qnty"=>1,'tPrice'=>130),array("id"=>105,"name"=>"Tennis","image"=>"tennis.png","price"=>100,"qnty"=>1,'tPrice'=>100));
 
productListing($products,$row);


if(isset($_REQUEST)){
    $action =isset($_REQUEST['action'])?$_REQUEST['action']:"404";
    $id =isset($_REQUEST['id'])?$_REQUEST['id']:"404";
    $qnty =isset($_REQUEST['qnty'])?$_REQUEST['qnty']:"404";

    switch($action){
        case 'onload' : onLoad();
        break;
        case 'add' : addProduct($id,$products);
        break;
        case 'remove' : removeProduct($id,$products);
        break;
        case 'edit' : updateQnty($id,$qnty);
        break;
    }
   
}


productListing($products,$row);

//add product to cart
function addProduct($id,$products){
    $cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
    foreach($products as $key=>$product){
        if($product['id'] == $id){
            if(isAdded($id)){
                array_push($cart,$product);
                $_SESSION['cart'] = $cart;
                echo json_encode($_SESSION['cart']);  
            } 

        }     
        
    }
}  


// //remove product from cart
function removeProduct($id){
    $cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();

    foreach($cart as $key => $product){
        if($product['id'] == $id){
            array_splice($cart,$key,1);

            $_SESSION['cart'] = $cart;

            echo json_encode($_SESSION['cart']);
        }
    }  
}


//check product is alreadyadded to the cart
function isAdded($id){
    $cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();

    foreach($cart as $key => $product){
        if($product['id'] == $id){
            $cart[$key]['qnty'] = $cart[$key]['qnty']+1;
            $cart[$key]['tPrice'] = $cart[$key]['qnty'] * $cart[$key]['price'];
            $_SESSION['cart'] = $cart;
            echo json_encode($_SESSION['cart']);
            return false;
        }
    }  
   return true;
}


// //product Listing function
function productListing($products,$row){

    foreach($products as $product){
        $row .= '<div id="'.$product['id'].'" class="product">
            <img src="./images/'.$product['image'].'"/>
            <h3 class="title"><a href="#">'.$product['name'].'</a></h3>
            <span>'.$product['price'].'</span>
            <a class="add-to-cart" id="add-to-cart" data-id="'.$product['id'].'" href="products.php?id='.$product['id'].'&action=addProduct" >Add To Cart</a>
            </div>'; 
    }
    return $row;
}


function onLoad(){
    if(!isset($_SESSION['cart'])){
        echo json_encode($_SESSION['cart']);
    }
}



?>


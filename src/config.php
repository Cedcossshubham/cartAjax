<?php 
 
 session_start();

 $products = array(array("id"=>101,"name"=>"Basket Ball","image"=>"basketball.png","price"=>150,"qnty"=>1,'tPrice'=>150),array("id"=>102,"name"=>"Football","image"=>"football.png","price"=>120,"qnty"=>1,'tPrice'=>120),array("id"=>103,"name"=>"Soccer","image"=>"soccer.png","price"=>110,"qnty"=>1,'tPrice'=>110),array("id"=>104,"name"=>"Table Tennis","image"=>"table-tennis.png","price"=>130,"qnty"=>1,'tPrice'=>130),array("id"=>105,"name"=>"Tennis","image"=>"tennis.png","price"=>100,"qnty"=>1,'tPrice'=>100));
 
 $_SESSION['cart'];
 $row="";
 $table ="";
 $subTotal =0;
 
productListing($products,$row);

$action =$_GET['action'];

switch($action){
    case 'addProduct': addProduct($products,$table);
    break;
    case 'removeProduct': removeProduct($_SESSION['cart']);
    break;
}

$action="";


if(isset($_GET['btn'])){
    updateQnty();
}

 //add product to cart
function addProduct($products,$table){
    foreach($products as $key=>$product){
        if($product['id'] == $_GET['id']){
            if(!isset( $_SESSION['cart'])){
                $_SESSION['cart']=array();
                array_push( $_SESSION['cart'],$product);
            }
            elseif(isAdded()){
                array_push( $_SESSION['cart'],$product);  
            }   
        } 
    } 
    displayProduct($table);
}


//remove product from cart
function removeProduct($table){
    foreach($_SESSION['cart'] as $key=>$product){
        if($product['id'] == $_GET['id']){
            unset($_SESSION['cart'][$key]);  
        }
    }  
    displayProduct($table);
}


//check product is alreadyadded to the cart
function isAdded(){
    foreach($_SESSION['cart'] as $key=>$product){
        if($product['id'] == $_GET['id']){
            $_SESSION['cart'][$key]['qnty']= $_SESSION['cart'][$key]['qnty']+1;
            $_SESSION['cart'][$key]['tPrice']= $_SESSION['cart'][$key]['qnty']*$_SESSION['cart'][$key]['price'];
            return false;
        }
    }  
   return true;
}

//display product function
function displayProduct($table){
    $table .= "<table><tr><th>Product Id</th><th>Product Name</th><th>Product Price</th><th>Product Qnty</th><th>Total Price</th><th>Remove</th><th>Edit Qnty</th></tr>";
    foreach($_SESSION['cart'] as $p){
        $table .= '<tr><td>'.$p['id'].'</td><td>'.$p['name'].'</td><td>'.$p['price'].'</td><td>'.$p['qnty'].'</td><td>'.$p['tPrice'].'</td><td><a class="add-to-cart" href="products.php?id='.$p['id'].'&action=removeProduct" >X</a></td><td><form method="get" action="products.php"><input type="text" id="'.$p['id'].'" name="editQnty"><input type="hidden" name="id" value="'.$p['id'].'" action="edit"><input type="submit"  name="btn" value="OK"></form></td></tr>';
    }
    $table .= '</table>';

    return $table;
}


//product Listing function
function productListing($products,$row){

    foreach($products as $product){
        $row .= '<div id="'.$product['id'].'" class="product">
            <img src="./images/'.$product['image'].'"/>
            <h3 class="title"><a href="#">'.$product['name'].'</a></h3>
            <span>'.$product['price'].'</span>
            <a class="add-to-cart" href="products.php?id='.$product['id'].'&action=addProduct" >Add To Cart</a>
            </div>'; 
    }
    return $row;
}


//calculate subproduct
function subTotal($subTotal){
    foreach($_SESSION['cart'] as $product){
        $subTotal += $product['tPrice'];
    }

    return $subTotal;
}



//update quantity
function updateQnty(){
     $qnty =  $_GET['editQnty'];
     $id =  $_GET['id'];

     foreach($_SESSION['cart'] as $key => $product){
         if($id == $product['id']){
             $_SESSION['cart'][$key]['qnty']=$qnty;
             $_SESSION['cart'][$key]['tPrice']= $_SESSION['cart'][$key]['qnty']*$_SESSION['cart'][$key]['price'];
             break;
         }
     }
}

?>


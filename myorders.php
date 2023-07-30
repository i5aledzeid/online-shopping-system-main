<?php
    include "db.php";
    include "order_header.php";                    
?>

<link href="css/myorders.css" rel="stylesheet"/>					
<section class="section main main-raised">       
	<div class="container-fluid ">
		<div class="wrap cf">
            <h1 class="projTitle">All Your Orders</h1>
            <div class="heading cf">
                <h1>My Orders</h1>
                <h1 style="margin-left:55%">qty</h1>
                <a href="store.php" class="continue">Continue Shopping</a>
            </div>
            <div class="cart">
                <ul class="cartWrap">
                <?php
                if (isset($_SESSION["uid"])) {
                    $sql="SELECT c.order_id,a.product_id,a.product_title,a.product_price,a.product_image,b.qty,b.amt,c.total_amt,b.order_pro_id FROM products a,order_products b,orders_info c WHERE a.product_id=b.product_id AND c.user_id='$_SESSION[uid]' AND b.order_id=c.order_id ORDER BY `c`.`order_id` DESC";
                    $query = mysqli_query($con,$sql);
                    //display cart item in dropdown menu
                    
                    $order_products = "SELECT order_pro_id FROM order_products";
                    
                    if (mysqli_num_rows($query) > 0) {
                        $prev_old = 0;
                        $prev_total = 0;
                        $i = 1;
                        $numRows = mysqli_num_rows($query);
                        while ($row=mysqli_fetch_array($query)) {
                            
                            $product_id = $row["product_id"];
                            $product_title = $row["product_title"];
                            $product_price = $row["product_price"];
                            $product_image = $row["product_image"];
                            $qty = $row["qty"];
                            $amt=$row["amt"];
                            $total_amt=$row["total_amt"];
                            $order_id=$row["order_id"];

                            $order_pro_id = $row['order_pro_id'];

                            $result = mysqli_query($con, "SELECT `order_id`, `user_id`, `f_name`, `email`, `address`, `city`, `state`, `zip`, `status`, `cardname`, `cardnumber`, `expdate`, `prod_count`, `total_amt`, `cvv` from orders_info  where order_id='$order_id'") or die("query 1 incorrect.......");
                            list($order_id, $product_type, $brand, $product_name, $price, $details, $state, $zip, $status, $cardname, $cardnumber, $expdate, $prod_count, $total_amt, $cvv) = mysqli_fetch_array($result);
                            $status_value = '';
                            if ($status == 0) {
                                $status_value = 'Confirm';
                            }
                            else if ($status == 1) {
                                $status_value = 'Shipped';
                            }
                            else if ($status == 2) {
                                $status_value = 'Deleverd';
                            }
                            else if ($status == 3) {
                                $status_value = 'Cancel';
                            }
                            
                            if ($prev_old==0 || $prev_old==$order_id){
                                $prev_old=$order_id;
                                $prev_total = $total_amt;
                                $i++;
                                echo '<li class="items even">
                                    <tr>
                                    <div class="infoWrap"> 
                                        <div class="cartSection">
                                        <img src="product_images/'.$product_image.'" alt="'.$product_title.'" class="itemImg" />
                                        <p class="itemNumber">#'.$product_id.'</p>
                                        <h3>'.$product_title.'</h3>
                                        
                                        <p> '.$qty.' x &#x20B9; '.$product_price.'</p>
                                        
                                        <p class="stockStatus"> '.$status_value.' </p>
                                        </div>  
                                    
                                        <div class="prodTotal cartSection"><p>'.$qty.'</p></div>
                                        <td>
                                        <div class="prodTotal cartSection">
                                        <p>&dollar; '.$product_price.'</p>
                                        </div>
                                        </td>
                                        <div class="cartSection removeWrap">
                                            <a href="delete_order.php?oid='.$order_pro_id.'&id='.$order_id.'" class="remove">x</a>
                                        </div>
                                    </div>
                                    </tr>
                            </li>';
                            
                            }else{
                                $prev_old=$order_id;
                                $i++;
                                echo'
                            </ul>
                        </div>  
                        <div class="special"><div class="specialContent">
                                Thanks for Using our Platform
                        </div></div>
                        <div class="subtotal cf">
                            <ul>
                            <li class="totalRow"><span class="label">Subtotal</span><span class="value">&#x20B9; '.$prev_total.'</span></li>
                            
                                <li class="totalRow"><span class="label">Shipping 1</span><span class="value">&#x20B9; 0.00</span></li>
                            
                                    <li class="totalRow"><span class="label">Tax</span><span class="value">&#x20B9; 0.00</span></li>
                                    <li class="totalRow final"><span class="label">Total</span><span class="value">&#x20B9;'.$prev_total.'</span></li>
                            
                            </ul>
                        </div>
            
                        
                        <div class="cart">
                            <ul class="cartWrap">
                                <li class="items even">
                                <tr>
                                    <div class="infoWrap"> 
                                        <div class="cartSection">
                                        <img src="product_images/'.$product_image.'" alt="'.$product_title.'" class="itemImg" />
                                        <p class="itemNumber">#'.$product_id.'</p>
                                        <h3>'.$product_title.'</h3>
                                        
                                        <p> '.$qty.' x &#x20B9; '.$product_price.'</p>
                                        
                                        <p class="stockStatus out"> '.$status_value.' </p>
                                        </div>  
                                    
                                        <div class="prodTotal cartSection"><p>'.$qty.'</p></div>
                                        <td>
                                        <div class="prodTotal cartSection">
                                        <p>&#x20B9; '.$product_price.'</p>
                                        </div>
                                        </td>
                                        <div class="cartSection removeWrap">
                                            <!--<a href="delete_order.php?id='. $order_id .'&oid='.$order_pro_id.'" class="remove">x</a>-->
                                            <a href="delete_order.php?oid='.$order_pro_id.'" class="remove">x</a>
                                        </div>
                                    </div>
                                    </tr>
                                </li>
                                ';
                                $prev_total = $total_amt;
                            }
                            if($i==$numRows+1){
                                echo '
                                 
                                    <div class="special"><div class="specialContent">
                                            Thanks for Using our Platform
                                    </div></div>
                                    <div class="subtotal cf">
                                        <ul>
                                        <li class="totalRow"><span class="label">Subtotal</span><span class="value">&#x20B9; '.$prev_total.'</span></li>
                                        
                                            <li class="totalRow"><span class="label">Shipping 3</span><span class="value">&#x20B9; 0.00</span></li>
                                        
                                                <li class="totalRow"><span class="label">Tax</span><span class="value">&#x20B9; 0.00</span></li>
                                                <li class="totalRow final"><span class="label">Total</span><span class="value">&#x20B9;'.$prev_total.'</span></li>
                                        
                                        </ul>
                                    </div>
                                ';
                            }
                            
                            
                        }
                    }else{
                    }
                }
                ?>
                
                
                </ul>
            </div> 
                <!--<li class="items even">Item 2</li>-->
            
                
        </div>
    </div>
 </section>

<?php
include "footer.php";
?>
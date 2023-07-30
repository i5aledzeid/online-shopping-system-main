<?php
include "db.php";

include "header.php";


                         
?>

<link href="css/myorders.css" rel="stylesheet"/>	
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<section class="section main main-raised">       
	<div class="container-fluid ">
		<div class="wrap cf">
            <h1 class="projTitle">My Accounts</h1>
            <div class="heading cf">
                <h1>My Account</h1>
                <h1 style="margin-left:15%">Email</h1>
                <h1 style="margin-left:15%">Phone</h1>
                <h1 style="margin-left:10%">Password</h1>
                <a href="store.php" class="continue">Continue Shopping</a>
            </div>
            <div class="cart">
                <ul class="cartWrap">
                <?php
                if (isset($_SESSION["uid"])) {
                    $sql="SELECT * FROM user_info WHERE user_id='$_SESSION[uid]' ORDER BY `user_id` DESC";
                    $query = mysqli_query($con,$sql);
                    //display cart item in dropdown menu
                    
                    if (mysqli_num_rows($query) > 0) {
                        $prev_old = 0;
                        $prev_total = 0;
                        $i = 1;
                        $numRows = mysqli_num_rows($query);
                        while ($row=mysqli_fetch_array($query)) {
                            
                            $product_id = $row["user_id"];
                            $product_title = $row["first_name"];
                            $product_price = $row["last_name"];
                            $email = $row["email"];
                            $product_image = 'user_icon.png';
                            $qty = $row["password"];
                            $amt=$row["mobile"];
                            $total_amt=$row["address1"];
                            $order_id=$row["address2"];
                            
                            if ($prev_old==0 || $prev_old==$order_id){
                                $prev_old=$order_id;
                                $prev_total = $total_amt;
                                $i++;
                                echo '<li class="items even">
                                    <tr>
                                    <div class="infoWrap"> 
                                        <div class="cartSection">
                                            <img src="img/'.$product_image.'" alt="'.$product_title.'" class="itemImg" />
                                            <p class="itemNumber">#'.$product_id.'</p>
                                            <h3>'.$product_title .' '. $product_price.'</h3>
                                            <p><br><br><br><br> &#128222;'.$amt.' <br><br> &#128681'.$total_amt. ', ' .$order_id.'</p>
                                        </div>  
                                        <div class="prodTotal cartSection"><p>'.$email.'</p></div>
                                        <div class="prodTotal cartSection"><p>'.$amt.'</p></div>
                                        <td>
                                        <div class="prodTotal cartSection">
                                            <p>'.$qty.'</p>
                                        </div>
                                        </td>
                                        <div class="cartSection removeWrap">
                                            <a href="#" class="remove">x</a>
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
                                        
                                        <p class="stockStatus out"> Shipping</p>
                                        </div>  
                                    
                                        <div class="prodTotal cartSection"><p>'.$qty.'</p></div>
                                        <td>
                                        <div class="prodTotal cartSection">
                                        <p>&#x20B9; '.$product_price.'</p>
                                        </div>
                                        </td>
                                        <div class="cartSection removeWrap">
                                            <a href="#" class="remove">x</a>
                                        </div>
                                    </div>
                                    </tr>
                                </li>
                                ';
                                $prev_total = $total_amt;
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
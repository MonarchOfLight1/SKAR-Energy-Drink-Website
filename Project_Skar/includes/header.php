<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();//start session to check login statrus if not already started
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo isset($title ) ? $title .' - SKAR' : 'SKAR'; ?></title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600;800&display=swap" rel="stylesheet">
<link href="css/test.css" rel="stylesheet">
<link href="css/bootstrap.css" rel="stylesheet">

</head>
<body>

<nav>
    <div style="font-size:28px; font-weight:800;">SKAR</div>
    <div>
        <a href="index.php">Home</a>
        <a href="shop.php">Shop</a>
        <a href="FYS.php">Find your SKAR</a>
        <a href="About.php">About</a>
        <a href="FAQ.php">FAQ</a>
    </div>
    <div class="auth-links">
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="logout.php">logout</a>
        <?php  else: ?>
            <a href="signIN.php">Sign In</a>
            <a href="signUP.php">Sign Up</a>
        <?php endif; ?>
         <a href="checkout.php" style="position:relative; margin-left:20px;">
            <img src="images/cart.png" style="height:30px;">
            <span id="cart-count"
                  style="
                    position:absolute;
                    top:-8px;
                    right:-10px;
                    background:red;
                    color:white;
                    font-size:12px;
                    padding:2px 6px;
                    border-radius:50%;
                  ">
                0
            </span>
        </a>

    </div>
    <script>
    //A script that loads in all pages, to change the cart icon
    async function updateCartCount() {
        try 
        {
            const res = await fetch('api/get_cart_count.php', 
            { 
                method: 'GET', 
                credentials: 'include' 
            });

            if (res.status === 401) {
                // User not logged in, set count to 0
                document.getElementById('cart-count').innerText = 0;
                return;
            }

            const data = await res.json();
            document.getElementById('cart-count').innerText = data.count ?? 0;

        } 
        catch (err) 
        {
            console.error('Failed to update cart count', err);
            document.getElementById('cart-count').innerText = 0;
        }
}


updateCartCount();
</script>
</nav>
<?php
$title = 'Shop';
require_once 'includes/header.php';
?>

<div class="shop-header">
    <h1>Shop SKAR Hydration</h1>
</div>

<div class="products">
    <div class="product-card">
        <h3>Red Surge</h3>
        <p>12-Pack • $29.99</p>
        <button onclick="addToCart(2,1)">Add to Cart</button>
    </div>

    <div class="product-card">
        <h3>Blue Ice</h3>
        <p>12-Pack • $29.99</p>
        <button onclick="addToCart(3,1)">Add to Cart</button>
    </div>

    <div class="product-card">
        <h3>Grape Shock</h3>
        <p>12-Pack • $29.99</p>
        <button onclick="addToCart(4,1)">Add to Cart</button>
    </div>

    <div class="product-card">
        <h3>Citrus Burst</h3>
        <p>12-Pack • $29.99</p>
        <button onclick="addToCart(5,1)">Add to Cart</button>
    </div>
</div>

<script>

async function addToCart(product_id, quantity = 1) {
    try {
        const res = await fetch('api/add_to_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ product_id, quantity }),
            credentials: 'include'
        });

        if (res.status === 401) {
            window.location.href = 'signIN.php';
            return;
        }

        // Refresh header cart count
        await updateCartCount();

        //reload the page to update cart count
        location.reload();  

    } catch (err) {
        console.error(err);
        alert('Network error');
    }
}
</script>
<?php
require_once 'includes/footer.php';
?>
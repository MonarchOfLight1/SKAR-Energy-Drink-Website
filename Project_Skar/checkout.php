<?php
session_start();
$title = 'Checkout';
require_once 'includes/header.php';
?>

<div class="container">
    <h1>Your Cart</h1>
    <div id="cart-items"></div>
    <div class="total">Total: $<span id="total-price">0.00</span></div>
    <button class="clear-btn" onclick="clearCart()">Clear Cart</button>
    <button class="pay-btn">Proceed to Payment</button>
</div>

<script>

async function loadCart() {
    const container = document.getElementById("cart-items");
    container.innerHTML = "Loading cart...";
    let total = 0;

    try {
        const res = await fetch('api/get_cart.php', { method: 'GET', credentials: 'include' });

        // Redirect to login if unauthorized
        if (res.status === 401) {
            window.location.href = 'signIN.php';
            return;
        }

        const data = await res.json();

        container.innerHTML = ""; // Clear container

        // Empty cart
        if (!data.cart || data.cart.length === 0) {
            container.innerHTML = "<p>Your cart is empty.</p>";
            document.getElementById("total-price").innerText = "0.00";
            return;
        }

        // each cart item
        data.cart.forEach(item => {
            const price = parseFloat(item.product_price); 
            const subtotal = price * item.quantity;
            total += subtotal;

            container.innerHTML += `
                <div class="cart-item">
                    <div class="item-info">
                        <strong>${item.product_name}</strong><br>
                        $${price.toFixed(2)}
                    </div>
                    <div class="qty-controls">
                        <button onclick="changeQty(${item.product_id}, -1)">-</button>
                        <span>${item.quantity}</span>
                        <button onclick="changeQty(${item.product_id}, 1)">+</button>
                    </div>
                    <div>$${subtotal.toFixed(2)}</div>
                </div>
            `;
        });

        document.getElementById("total-price").innerText = total.toFixed(2);

    } catch (err) {
        console.error(err);
        container.innerHTML = "<p>Failed to load cart.</p>";
    }
}

async function changeQty(product_id, amount) {
    try {
        if (amount < 0) {
            // Remove 1 quantity
            const res = await fetch('api/remove_item.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ product_id }),
                credentials: 'include'
            });

            if (res.status === 401) {
                window.location.href = 'signIN.php';
                return;
            }
        } else {
            // Add quantity
            const res = await fetch('api/add_to_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ product_id, quantity: amount }),
                credentials: 'include'
            });

            if (res.status === 401) {
                window.location.href = 'signIN.php';
                return;
            }
        }

        // Reload cart and update header count
        await loadCart();
        await updateCartCount();

    } catch (err) {
        console.error(err);
    }
}
async function clearCart() {
    try {
        const res = await fetch('api/clear_cart.php', {
            method: 'POST',
            credentials: 'include'
        });

        if (res.status === 401) {
            window.location.href = 'signIN.php';
            return;
        }

        await loadCart();
        location.reload(); 
    } catch (err) {
        console.error(err);
    }
}

// Initial load
loadCart();
</script>

<?php
require_once 'includes/footer.php';
?>
<?php
$title = 'Home';
require_once 'includes/header.php';
?>
<div class="hero">
    <h1>SKAR</h1>
    <p>Hydration Engineered for Performance</p>
    <button onclick="window.location.href='shop.php'">Shop Now</button>
</div>

<div class="flavors">
    <div class="flavor-card" style="background:#FF3B3B;">Red Surge</div>
    <div class="flavor-card" style="background:#00AEEF;">Blue Ice</div>
    <div class="flavor-card" style="background:#8A2BE2;">Grape Shock</div>
    <div class="flavor-card" style="background:#F7B500;">Citrus Burst</div>
</div>

<div class="about">
    <h2>What Makes SKAR Different?</h2>
    <p>
        SKAR Hydration is built for athletes who demand more from every bottle.
        With bold flavors, clean ingredients, and optimized electrolytes,
        SKAR fuels your grind — from training to recovery.
    </p>
</div>

<?php
require_once 'includes/footer.php';
?>

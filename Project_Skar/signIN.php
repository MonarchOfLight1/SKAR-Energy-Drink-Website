<?php
$title = 'Sign In';
require_once 'includes/header.php';
?>

<div class="container form-container">
    <h1 class="form-title">Sign In</h1>
    <form id="loginForm">
        <input name="email" type="email" placeholder="Email" required>
        <input name="password" type="password" placeholder="Password" required>
        <button class="form-btn" type="submit">Sign In</button>
    </form>

    <div id="tempBox" style="
        display:none;
        position: fixed;
        top: 20px;
        right: 20px;
        background: #333;
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        font-weight:600;
        z-index: 9999;
    ">
        <span id="tempMessage"></span>
    </div>
    <div id="response" style="margin-top:10px; font-weight:600;"></div>
    <p class="form-link">Don't have an account? <a href="signUP.php">Sign Up</a></p>
</div>



<script>
const form = document.getElementById('loginForm');
const responseBox = document.getElementById('response');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const data = {
        email: form.email.value,
        password: form.password.value
    };

    try {
        const res = await fetch('api/login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data),
            credentials: 'include'
        });

        const json = await res.json();

        // to clear form inputs after pressing the button
        form.email.value = '';
        form.password.value = '';
        responseBox.innerText = '';

        if (json.error) {
            // to display error below the form
            responseBox.innerText = json.error;
            responseBox.style.color = 'red';
        } else if (json.message) {
            
            document.body.innerHTML = `
                <div style="
                    height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background: white;
                    font-family: Arial, sans-serif;
                ">
                    <div style="
                        background: #0086C9;
                        color: white;
                        padding: 20px 30px;
                        border-radius: 10px;
                        font-weight: 600;
                        font-size: 18px;
                        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
                    ">
                        ${json.message}
                    </div>
                </div>
            `;

            // Redirect after 5 seconds
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 5000);
        }

    } catch (err) {
        responseBox.innerText = 'Network error';
        responseBox.style.color = 'red';
        console.error(err);
    }
});
</script>
<?php
$title = 'Sign Up';
require_once 'includes/header.php';
?>


<div class="container form-container">
     <h1 class="form-title">Create Account</h1>
    <form id="signupForm">
    <input name="username" type="text" placeholder="Username" required>
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Password" required>
    <button class="form-btn" type="submit">Sign Up</button>
    </form>
</div>

<div id="response"></div>

<script>
document.getElementById('signupForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const form = e.target;
    const data = {
        username: form.username.value,
        email: form.email.value,
        password: form.password.value
    };

    const res = await fetch('api/signup.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    });

    const json = await res.json();
    if(res.ok)
    {
        document.getElementById('response').innerText = json.message;

        // redirect to login after 2 second
        setTimeout(() => {
            window.location.href = 'signIN.php';
        }, 2000);

    }else{
        document.getElementById('response').innerText = json.error;
    }
});
</script>

</body>
</html>




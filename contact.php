<div class="container">
    <h2>Contact Us</h2>
    <form id="contactForm" action="index.php?page=contact_save" method="post" onsubmit="return validateForm()">
        <label>Name:</label>
        <input type="text" id="name" name="name">
        <label>Email:</label>
        <input type="text" id="email" name="email">
        <label>Message:</label>
        <textarea id="message" name="message" rows="5"></textarea>
        <button type="submit">Send Message</button>
    </form>
</div>

<script>
function validateForm() {
    let n = document.getElementById('name').value;
    let e = document.getElementById('email').value;
    let m = document.getElementById('message').value;
    if (n == "" || e == "" || m == "") {
        alert("All fields are required!");
        return false;
    }
    if (!e.includes("@")) {
        alert("Invalid email!");
        return false;
    }
    return true;
}
</script>
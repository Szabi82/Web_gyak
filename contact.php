<div class="container">
    <h2>📬 Kapcsolat</h2>
    <p style="color: #aaa; margin-bottom: 25px;">Küldjön nekünk üzenetet az alábbi űrlapon!</p>

    <div style="max-width: 600px;">
        <form id="contactForm" action="index.php?page=contact_save" method="post" onsubmit="return validateForm()" novalidate>
            <label>Név: <span style="color:#e50914">*</span></label>
            <input type="text" id="name" name="name" placeholder="Teljes neve">

            <label>Email cím: <span style="color:#e50914">*</span></label>
            <input type="text" id="email" name="email" placeholder="pelda@email.com">

            <label>Üzenet: <span style="color:#e50914">*</span></label>
            <textarea id="message" name="message" rows="6" placeholder="Írja ide üzenetét..."></textarea>

            <button type="submit" style="margin-top: 10px;">✉️ Üzenet küldése</button>
        </form>
    </div>
</div>

<script>
function validateForm() {
    // Mezők értékei
    var n = document.getElementById('name').value.trim();
    var e = document.getElementById('email').value.trim();
    var m = document.getElementById('message').value.trim();

    // Üres mező ellenőrzés
    if (n === "" || e === "" || m === "") {
        alert("Minden mező kitöltése kötelező!");
        return false;
    }

    // Email formátum ellenőrzés (regex)
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(e)) {
        alert("Kérem, adjon meg érvényes email címet!");
        return false;
    }

    // Minimum hossz
    if (n.length < 2) {
        alert("A névnek legalább 2 karakter hosszúnak kell lennie!");
        return false;
    }

    if (m.length < 5) {
        alert("Az üzenetnek legalább 5 karakter hosszúnak kell lennie!");
        return false;
    }

    return true;
}
</script>

<h2>📬 Kapcsolat</h2>
<p>Küldjön nekünk üzenetet az alábbi űrlapon!</p>

<div style="max-width: 600px;">
    <form id="contactForm" action="kapcsolat_ment" method="post" onsubmit="return validateForm()" novalidate>
        <label>Név: <span style="color:#e50914">*</span></label>
        <input type="text" id="knev" name="name" placeholder="Teljes neve">

        <label>Email cím: <span style="color:#e50914">*</span></label>
        <input type="text" id="kemail" name="email" placeholder="pelda@email.com">

        <label>Üzenet: <span style="color:#e50914">*</span></label>
        <textarea id="kuzenet" name="message" rows="6" placeholder="Írja ide üzenetét..." style="max-width:100%;"></textarea>

        <button type="submit" style="margin-top: 10px;">✉️ Üzenet küldése</button>
    </form>
</div>

<script>
function validateForm() {
    var n = document.getElementById('knev').value.trim();
    var e = document.getElementById('kemail').value.trim();
    var m = document.getElementById('kuzenet').value.trim();

    if (n === "" || e === "" || m === "") {
        alert("Minden mező kitöltése kötelező!");
        return false;
    }
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(e)) {
        alert("Kérem, adjon meg érvényes email címet!");
        return false;
    }
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

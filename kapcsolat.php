<h2>Kapcsolat</h2>
<form id="kapcsolatForm" action="index.php?oldal=kapcsolat_mentes" method="post" onsubmit="return ellenorzes()">
    <label>Név:</label><br>
    <input type="text" id="nev" name="nev"><br><br>
    
    <label>E-mail:</label><br>
    <input type="text" id="email" name="email"><br><br>
    
    <label>Üzenet:</label><br>
    <textarea id="szoveg" name="szoveg"></textarea><br><br>
    
    <button type="submit">Küldés</button>
</form>

<script>
function ellenorzes() {
    let nev = document.getElementById('nev').value;
    let email = document.getElementById('email').value;
    let szoveg = document.getElementById('szoveg').value;

    if (nev == "" || email == "" || szoveg == "") {
        alert("Minden mezőt ki kell tölteni!"); // Kliensoldali ellenőrzés [cite: 36]
        return false;
    }
    if (!email.includes("@")) {
        alert("Érvénytelen e-mail cím!");
        return false;
    }
    return true;
}
</script>
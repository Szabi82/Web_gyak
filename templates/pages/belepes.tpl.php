<h2>🔐 Bejelentkezés / Regisztráció</h2>

<div style="display:flex;gap:30px;flex-wrap:wrap;">
    <div style="flex:1;min-width:260px;">
        <form action="belep" method="post">
            <fieldset>
                <legend>Bejelentkezés</legend>
                <br>
                <label>Felhasználónév:</label>
                <input type="text" name="felhasznalo" placeholder="felhasználói név" required>
                <label>Jelszó:</label>
                <input type="password" name="jelszo" placeholder="jelszó" required>
                <br>
                <input type="submit" name="belepes" value="Belépés">
                <br>&nbsp;
            </fieldset>
        </form>
    </div>
    <div style="flex:1;min-width:260px;">
        <h3 style="color:#aaa;margin-top:0;">Még nem felhasználó? Regisztráljon!</h3>
        <form action="regisztral" method="post">
            <fieldset>
                <legend>Regisztráció</legend>
                <br>
                <label>Vezetéknév:</label>
                <input type="text" name="vezeteknev" placeholder="vezetéknév" required>
                <label>Utónév:</label>
                <input type="text" name="utonev" placeholder="utónév" required>
                <label>Felhasználói név:</label>
                <input type="text" name="felhasznalo" placeholder="felhasználói név" required>
                <label>Jelszó:</label>
                <input type="password" name="jelszo" placeholder="jelszó" required>
                <br>
                <input type="submit" name="regisztracio" value="Regisztráció">
                <br>&nbsp;
            </fieldset>
        </form>
    </div>
</div>

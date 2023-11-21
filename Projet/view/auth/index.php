{{ include('header.php', {title: 'Login'}) }}
<body>
    <div class="c-form">
        <form action="{{path}}login/auth" method="post">
            <h1>se connecter</h1>

            <span class="filling-errors">{{ errors | raw }} </span>
            <label>Utilisateur :
                <input type="text" name="username" value="{{user.username}}">
            </label>
            <label>Mot de passe :
                <input type="password" name="passwordd" value="">
            </label>
            <div class="login-btns">
                <input type="submit" value="Connecter" class="btn">
                <a href="{{path}}user/create"><input type="button" value="Créer un nouveau compte" class="btn-signup"></a>
            </div>
        </form>
    </div>
</body>
</html>
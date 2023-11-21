{{ include('header.php', {title: 'Nouveau Utilisateur'}) }}
<h1>Création de Nouveau compte</h1>
<div class="c-form">
    <form action="{{path}}user/store" method="POST">

        <span class="filling-errors"> {{ errors | raw }} </span>

        <label for="prenom"> Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="{{ user.prenom }}">

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="{{ user.nom }}">

        <label for="username"> Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" placeholder="exemple@exemple.com" value="{{ user.username }}"> 
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="passwordd" value="{{ user.passwordd }}"> 

        {% if session.privilege == 1 %}
        <label for="privilege">Privilege :</label>
        <select name="privilege_id" id="equipe">
            <option value="">---- Veuillez Selectionner un Privilege ----</option>
            {%  for privilege in privileges %}
            <option value="{{ privilege.id }}"  {% if privilege.id == user.privilege_id %} selected {% endif %}>{{ privilege.privilege }}</option>
            {% endfor %}

        </select>
        {% endif %}
        
        <input type="submit" value="Créer un compte">

    </form>
</div>
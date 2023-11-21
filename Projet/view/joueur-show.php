{{ include('header.php', {title: 'Profile du Joueur'}) }}
<body>
    <div class="container-joueur">
        <h1>Profile du joueur</h1>
        
        <img src="{{path}}/photoJoueurs/{{ joueur.photo }}">
        <p><strong>Prénom:</strong> {{ joueur.prenom|capitalize }}</p>
        <p><strong>Nom:</strong> {{ joueur.nom|capitalize }}</p>
        

        <p><strong>Age:</strong> {{ age }} ans</p>
        <p><strong>Addresse:</strong> {{ joueur.adresse }}</p>
        <p><strong>Equipe:</strong> {{ nom }}</p>
        {% if session.privilege == 1 %}
        <a href="{{path}}joueur/edit/{{ joueur.id }}" class="edit-button">Modifier</a>
        {% endif %}
    </div>
</body>
</html>
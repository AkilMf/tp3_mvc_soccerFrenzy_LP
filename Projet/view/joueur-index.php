{{ include('header.php', {title: 'Liste des Joueur'}) }}

<body>
{% if session.privilege == 1 %}
<a href="{{path}}joueur/create"><button class="add-button">Nouveau Joueur</button></a>
{% endif %}
<div class="player-list">

    {% for joueur in joueurs %}

        <div class="player-card">
            <h2> {{ joueur.prenom|capitalize }} {{ joueur.nom|capitalize }}</h2>
            <img src="photoJoueurs/{{ joueur.photo }}">
            
            <a href="{{path}}joueur/show/{{ joueur.id }}"><p>Voir plus..</p></a>

            {% if session.privilege == 1 %}
            <form action="{{path}}joueur/destroy" method="post">
                <input type="hidden" name="id" value="{{joueur.id}}">
                <input type="submit" value="Supprimer" class="delete-button">
            </form>
            {% endif %}
        </div>
    {% endfor %}

</div>
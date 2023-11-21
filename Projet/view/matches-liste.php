{{ include('header.php', {title: 'Liste des Matches'}) }}
<body>
    <h1>Liste des Matches</h1>
    <div class="game-list">
    {% if session.privilege == 1 %}
    <a href="{{path}}matche/create"><button class="add-button">Nouveau Matche</button></a>
    {% endif %}

    {% for matche in matches %}
        <div class="game">
            <div class="haw">
                <div class="home">Domicile</div>
                <div class="away">Extérieur </div>
            </div>
            <div class="teams">
                <span class="team-name"><!--j'obtiens le nom de l'equipe à partir de l'ID  - No Jointure Needed-->
                {% for equipe in equipes %}
                {% if matche.equipe_Domicile == equipe.id %} {{ equipe.nom|capitalize }} {% endif %}
                {% endfor %}
                </span>
                <span class="vs">vs</span>
                <span class="team-name">
                {% for equipe in equipes %}
                {% if matche.equipe_exterieur == equipe.id %} {{ equipe.nom|capitalize }} {% endif %}
                {% endfor %}
                </span>
            </div>
            <div class="score">
                <span class="label"></span> {{ matche.score_domicile }} - {{ matche.score_exterieur }}
            </div>
            <div class="details">
                <span class="label">Date:</span> {{ matche.match_date }}
            </div>
            <div class="details"><!--j'obtiens le nom de la competition à partir de l'ID-->
                <span class="label">Competition:</span>
                {% for competition in competitions %}
                {% if matche.Competition_id == competition.id %} {{ competition.nom|capitalize }} {% endif %}
                {% endfor %}
            </div>

            <div class="commentary">
                <span class="label">Commentaire:</span>{{ matche.commentaire }}
            </div>
        </div>
        {% endfor %}
        
    </div>
</body>
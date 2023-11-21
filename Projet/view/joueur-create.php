{{ include('header.php', {title: 'Nouveau Joueur'}) }}
<div class="c-form">
    <form action="{{path}}joueur/store" method="POST" enctype="multipart/form-data">

        <span class="filling-errors"> {{ errors | raw }} </span>
        <label for="prenom"> Prenom :</label>
        <input type="text" id="prenom" name="prenom" value="{{ joueur.prenom }}">

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="{{ joueur.nom }}"> 
        <!--img-->
        
        <label for="photo">Photo :</label>
        <input type="file" id="photo" name="photo" accept="image/*" value="" > 


        <label for="dateNaiss"> Date de Naissance :</label>
        <input type="date" id="dateNaiss" name="date_naissance" value="{{ joueur.date_naissance }}"> 
        <label for="adresse"> Addresse :</label>
        <textarea cols="30" rows="3" id="adresse" name="adresse"> {{ joueur.adresse }} </textarea>
        <label for="equipe">Equipe :</label>
        <select name="Equipe_id" id="equipe">
            <option value="">---- Veuillez Selectionner une Equipe ----</option>
            {%  for equipe in equipes %}
            <option value="{{ equipe.id }}"  {% if equipe.id == joueur.Equipe_id %} selected {% endif %}>{{ equipe.nom }}</option>
            
            {% endfor %}

        </select>
        
        <input type="submit" value="Ajouter">
    </form>
</div>
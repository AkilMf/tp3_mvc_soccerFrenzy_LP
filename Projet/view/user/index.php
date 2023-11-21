{{ include('header.php', {title: 'Liste des utilisateurs'}) }}
<body>
    
    <h1>Utilisateurs</h1>
    <table id="users-table">
        <tr>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Nom d'utilisateur</th>
            <th>Privilege</th>

        </tr>
        {% for user in users %}
            <tr>
                <td>{{ user.prenom }}</td>
                <td>{{ user.nom }}</td>
                <td>{{ user.username }}</td>
                <td>{{ user.privilege }}</td>

            </tr>
        {% endfor %}
    </table>
    <br><br>
    <a href="{{path}}user/create" class="edit-button">Ajouter</a>
    
    
</body>
</html>
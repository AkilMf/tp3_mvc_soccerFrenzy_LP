{{ include('header.php', {title: 'Journal de bord'}) }}
<body>
    
    <h1>Journal de bord</h1>
    <table id="users-table">
        <tr>
            <th>Utilisateur</th>
            <th>Adresse IP</th>
            <th>Page Visité</th>
            <th>Date/Time</th>

        </tr>
        {% for log in logs %}
            <tr>
                <td>{{ log.user }}</td>
                <td>{{ log.ip }}</td>
                <td>{{ log.page }}</td>
                <td>{{ log.date }}</td>

            </tr>
        {% endfor %}
    </table>

</body>
</html>
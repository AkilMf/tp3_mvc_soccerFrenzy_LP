<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="TP2-MVC">
        <meta name="author" content="Mostafa AKIL 2395282">
        <title>{{ title }}</title>
        <link rel="stylesheet" href="{{path}}/assets/css/style.css">
    </head>
    <nav>
        <aside>
            {% if guest == false %}
            Bienvenue, <strong>{{ session.prenom|capitalize }}</strong>
            {% endif %}
        </aside>
        <ul role="menu">
            <li role="menu-item" aria-label="Accueil"><a href="{{path}}">Accueil</a></li>
            
            {% if guest == false %}
            <li role="menu-item" aria-label="Sur nous"><a href="{{path}}joueur">Joueur</a></li>
            {% endif %}
            <li role="menu-item" aria-label="Services"><a href="{{path}}matche">Matches</a></li>

            {% if session.privilege == 1 %}
            <li role="menu-item" aria-label="Utilisateurs"><a href="{{path}}user">Utilisateurs</a></li>
            {% endif %}
            {% if guest %}
            <li role="menu-item" aria-label="Contacter"><a href="{{path}}login">Login</a></li>
            {% else %}
            <li role="menu-item" aria-label="Contacter"><a href="{{path}}login/logout">Logout</a></li>
            {% endif %}
            {% if session.privilege == 1 %}
            <li role="menu-item" aria-label="Journal"><a href="{{path}}log">Journal</a></li>
            {% endif %}
        </ul>
    </nav>
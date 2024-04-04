Support de développement :

· PHP8.*

· Symfony >= 5.4

Ce test consiste à concevoir et développer une application sous Symfony.

Dans une première phase, l'objectif est de mettre en place un système d'agrégation d'articles provenant de diverses sources telles que des API externes, des flux RSS et des fichiers locaux. Ces articles seront ensuite traités et stockés dans une base de données.

La deuxième phase du projet implique la mise en œuvre d'une API REST qui permettra d'accéder aux articles stockés en base.

Exemple de ressources : RSS : http://www.lemonde.fr/rss/une.xml

API : · https://newsapi.org/v2/top-headlines?country=fr&apiKey=5f5aacf4e2764c9fbc2e1f857e5cc229 · https://saurav.tech/NewsAPI/top-headlines/category/health/fr.json · https://api.spaceflightnewsapi.net/v3/articles

Tâches supplémentaires en fonction du temps disponible :

Mise à disposition d’un affichage simple des articles

· Ajouter à l’API la possibilité de modifier, supprimer et rechercher des articles

· Ajouter la prise en charge de l'authentification pour les sources de données qui le nécessitent.

· Intégrer un système de cache afin de limiter des requêtes répétitives vers les mêmes sources de données.

· Optimiser les performances de la classe pour gérer efficacement de grandes quantités d'articles provenant de différentes sources.

Merci de nous renvoyer le fichier/projet complété en précisant le temps que vous avez passé à réaliser le test ainsi que les tâches. 


# How Crawlers work : 

Use crawler command name --url --limitOfArticles

For RSS crawling `run bin/console app:crawl-rss http://www.lemonde.fr/rss/une.xml 5`

For API crawling, `run bin/console app:crawl-api https://api.spaceflightnewsapi.net/v3/articles 5`

# Using API : 

Go to /api to test all verbs without using any other program. You need to be authenticated to use POST, PUT and DELETE.

Go to /api/articles or /api/articles/id to use GET without any authentication. You need to fill database with crawlers before being able to expose any data.
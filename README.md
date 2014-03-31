Mini Projet de Base de donnée 
=============================

Voici notre projet de base de donnée réalisé en S3 à l'iut informatique de belfort

**Réalisé par :**

Cabrol Morgane et Glangine Geoffrey.

**Fonctionalités :**

-Permet d'afficher des requettes que nous avons étudiés en Traveaux dirigés 
-Permet de modifier les tables d'une gestion de manifestations sportives.

**Hebergement et production :**

le site est hébergé [ici](http://kwidz404.esy.es/Mini_projet/index.php) 

**Mémo commandes mysql :**

*pour exporter : *

myqsqldump -h serveur -u LOGIN -p --opt base > base.sql

*pour importer le code :*

mysql -u root -p base < script.sql

*pour importer un fichier txt dans la table *

mysqlimport -u LOGIN -p -d -L --fields-terminated-by=, BASE MATABLE.txt 
attention le fichier txt doit avopir le meme nom que la table

**Post-Scriptum : **

Nous avons rencontré un probleme avec notre serveur dédié j'ai donc du utiliser en dernière minute un hebergeur gratuit donc l'encodage de la base de donnée n'est pas en UTF8.

 
 

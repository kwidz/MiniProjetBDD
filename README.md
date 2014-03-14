pour exporter : 
myqsqldump -h serveur -u LOGIN -p --opt base > base.sql

pour importer le code (C4EST CELUI LA !! ) :
mysql -u root -p base < script.sql

pour importer un fichier txt dans la table
mysqlimport -u LOGIN -p -d -L --fields-terminated-by=, BASE MATABLE.txt 
 attention le fichier txt doit avopir le meme nom que la table
 
 le site est hébergé [ici](http://185.13.37.145/geoffrey/MiniProjetBDD/src/) 

# Back-end

Depuis l'app, on fait une requête. Il faut :
 - **endpoint** (string du type Class/function)
 - **data** [Optionnel] Sous forme d'un tableau [key=>value, key2=>value2, ...]

Ensuite le back-end appel la funtion *function* de la classe *Class*.
Le back-end est constitué d'un dossier *class* lui-même constitué de 2 sous dossiers
 - ***ext*** Les classes externes (pour nous aider genre MySQL, etc)
 - ***type*** Les classes reliées à la base de données et qui permettent les requêtes. Les attributes de ces classes doivent correspondrent au nom des colonnes de la base de données.

La base de données est utilisé grâce à une API trouvée sur GitHub : [PHP-MySQLi-Database-Class](https://github.com/joshcam/PHP-MySQLi-Database-Class#initialization). La variable global qui permet l'accès à la base de données est *$GLOBALS['db']*.
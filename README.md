# IUT M3104 | 2de année | Freenote
Projet Web - Développement d'un réseau social

## Présentation du projet
Réseau social d’un nouveau genre, FreeNote consiste à créer des fils de discussions comprenant
des messages participatifs au sein desquels chaque utilisateur ne peut ajouter qu’un ou deux mots.
Différentes fonctionnalités sont paramétrables sur le site pour modifier certaines fonctionnalitées


## Choix techniques
* Utilisation du MVC afin d'avoir une application modulaire et évolutive
* Utilisation de la Programmation Orientée Objet pour avoir des méthodes influant sur le comportant des objets tels que les utilisateurs, discussions...
* Autoload pour éviter les `require()` dans chaque contrôleur lors de l'instanciation d'un nouvel objet

## Mesures de sécurité mises en oeuvre
* Tous les mots de passes insérés dans la base de données sont hachés avec la fonction PHP `password_hash()` qui utilise un algorithme de hachage fort et irréversible et qui génère automatiquement un salt sécurisé.
  Pour savoir si deux mots de passe correspondent, on utilise la fonction PHP `password_verify()`.
* Pour chaques requête SQL, il y a une protection contre les injections SQL :
    * On lance une nouvelle transaction (`bdd->beginTransaction()`), on prépare (`bdd->prepare()`), on exécute (`bdd->execute()`), on commit (`bdd->commit()`)
      et en cas d'erreur, annulation et remise à l’état initial (`bdd->rollback()`)
    * Toutes les valeurs extérieures des requêtes sont soumises au `bindValue()` en fonction de leur type
* Pour chaque valeur transmise en POST et GET :
    * Protection contre la faille CRLF (Carriage Return Line Feed) :
    On supprime toutes les retours à la ligne, `"\n", "\r", PHP_EOL`, avec la fonction `str_replace()`
    * Protection contre la faille XSS (Cross-Site Scripting) :
        On converti en entités HTML tous les caracères spéciaux (' ; " ; & ...) et on encode tout en UTF-8 avec la fonction `htmlspecialchars()`
    * Des tests d'expressions régulières sont mis en place avec un message d'erreur le cas échéant
* Pour la génération des token :
    * La fonction `microtime()` retournant le timestamp Unix est hachée avec `password_hash()`
    * Le resultat haché est converti en hexadécimal avec `bin2hex()`
    * Seuls quarante caractères sont extraits de la chaîne en hexadécimal en commmençant l'extraction aléatoirement, avec `rand()`, en le 1er et le 20me caractère
    * Le token est valable uniquement la journée de sa création, au-delà, si l'utilisateur essaie de l'utiliser, il sera automatiquement détruit de la base.


## Configuration minimale requise
Pour la compatibilité avec flexbox (CSS) :

    Google chrome 29.0
    Internet explorer / Edge 11.0
    Mozilla Firefox 22.0
    Safari 10
    Opéra 48


## Configuration recommandée
    Google chrome 76.0
    Internet explorer / Edge 44.1
    Mozilla Firefox 70
    Safari 13.0
    Opéra 63.0
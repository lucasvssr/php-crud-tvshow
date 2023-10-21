# SAÉ 2.01 - Développement d’une application

## Auteurs
- VASSEUR Lucas : vass0047
- EL JARSSI Reda : el-j0009

### Serveur Web local :
Ouvrez un terminal à la racine du projet et lancez le serveur web local avec la commande suivante : <br>
*php -d display_errors -S localhost:8000 -t public/* <br>
Puis accédez à ce lien --> http://localhost:8000/index.php <br>
Veillez à changer le lien en remplaçant "index.php" par le nom du fichier de votre programme (placé dans le répertoire public) !<br>

La commande pour lancer le serveur web local peut être lancée grâce à :
*composer run-server*

### Style de codage :
Lancez une première vérification manuelle avec la commande : <br>
*php vendor/bin/php-cs-fixer fix --dry-run* <br>
Constatez quel fichier n'est pas valide. <br>

Lancez une nouvelle vérification manuelle avec la commande : <br>
*php vendor/bin/php-cs-fixer fix --dry-run --diff* <br>
Constatez en quoi consisterait la correction du fichier invalide. <br>

Lancez une dernière vérification manuelle avec la commande : <br>
*php vendor/bin/php-cs-fixer fix* <br>
Ouvrez le fichier concerné et constatez sa correction. <br>

Les commandes de vérification et de correction peuvent être lancées respectivement grâce à : <br>
*composer test:cs* <br>
ET <br>
*composer fix:cs*
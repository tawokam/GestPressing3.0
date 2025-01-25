Installation de l'application Gestpressing (version 3.0)
Cette application est propriétaire et protégée par une licence CLUF, et ne peut donc être téléchargée, copiée ou redistribuée sans l'accord du propriétaire (Achille Tawokam).

L'application peut être utilisée :
•  uniquement en local ;

•  en ligne ;

•  en local avec un système de synchronisation en ligne.

1. 
Installation en local
L'utilisation de cette application en local nécessite un environnement de développement web (XAMPP, WAMP, EasyPHP).
Dans le dossier DB, vous trouverez deux bases de données : pressing2 et pressingLine. Veuillez créer ces deux bases de données dans phpMyAdmin et les importer.
Copiez le dossier du projet (gestpressing3) et collez-le dans htdocs (si vous avez installé XAMPP) ou www (si vous avez installé WAMP ou EasyPHP).
Ouvrez le projet dans un navigateur en entrant l'adresse 127.0.0.1 ou localhost, qui est l'adresse locale permettant d'accéder à votre serveur local.
Sélectionnez le dossier gestpressing3 et l'application s'ouvrira et vous invitera à vous connecter.
Un utilisateur ayant le statut d'administrateur est créé par défaut. Vous pouvez l'utiliser pour vous connecter. Après connexion, créez votre compte avec un
statut administrateur et désactivez l'admin par défaut (afin qu'une tierce personne ne puisse l'utiliser pour accéder frauduleusement à votre application).

Utilisateur par défaut
Login : Technosoft
Mot de passe : version3

Vous avez la possibilité d'installer l'application directement depuis le navigateur.

Vous avez désormais un accès total à votre application Gestpressing afin de gérer votre pressing où que vous soyez.

2. Installation en ligne
Attention : si vous n'avez aucune connaissance dans l'hébergement en ligne, il est conseillé de faire appel à un développeur expérimenté afin qu'il vous aide à importer votre logiciel Gestpressing en ligne. Aucun aspect technique ne sera évoqué dans ce document.

Pour utiliser Gestpressing en ligne, vous devez disposer d'un hébergeur en ligne qui offre une base de données MySQL et Apache.
Dans le dossier DB, vous trouverez deux bases de données : pressing2 et pressingLine. Veuillez créer ces deux bases de données dans phpMyAdmin et les importer.
Importez tout le contenu du dossier gestpressing dans votre gestionnaire de fichiers offert par votre serveur (l'emplacement exact dépend de votre hébergeur).
Votre hébergeur, après la création de vos deux bases de données, vous a fourni des adresses vous permettant d'accéder à ces bases de données.
Afin que l'application accède à ces bases de données, quatre fichiers doivent être modifiés :
•  connect.php : modifiez l'adresse du serveur, le mot de passe, l'utilisateur et le nom de la table.

•  connectConnexion.php, connectOnLine.php et enfin le fichier synchronisation.php présent dans le dossier synchronisation.

Accédez à votre application en entrant dans un navigateur le nom de domaine de votre application.
Un utilisateur ayant le statut d'administrateur est créé par défaut. Vous pouvez l'utiliser pour vous connecter. Après connexion, créez votre compte avec un statut administrateur et désactivez l'admin par défaut (afin qu'une tierce personne ne puisse l'utiliser pour accéder frauduleusement à votre application).
Utilisateur par défaut
Login : Technosoft
Mot de passe : version3

Vous avez la possibilité d'installer l'application directement depuis le navigateur.

Vous avez désormais un accès total à votre application Gestpressing afin de gérer votre pressing où que vous soyez.

3. Utilisation en local avec un système de synchronisation en ligne
Ici, nous allons utiliser un environnement de développement web (XAMPP, WAMP, EasyPHP) pour la base de données en local et un hébergeur en ligne pour la base de données en ligne (la base de données en local se synchronise avec celle en ligne).

Dans le dossier DB, vous trouverez deux bases de données : pressing2 et pressingLine. Veuillez créer une base de données (nommée pressing2) dans phpMyAdmin et importer la base de données pressing2 (qui est votre base de données locale).
Copiez le dossier du projet (gestpressing3) et collez-le dans htdocs (si vous avez installé XAMPP) ou www (si vous avez installé WAMP ou EasyPHP).
Ensuite, créez une autre base de données (nommée pressingLine) dans phpMyAdmin de votre hébergeur web.

Afin que l'application accède à la base de données en ligne, trois fichiers doivent être modifiés :
•  connect.php : modifiez l'adresse du serveur, le mot de passe et l'utilisateur (ne modifiez que les connexions sur la base pressingLine).

•  connectOnLine.php et enfin le fichier synchronisation.php présent dans le dossier synchronisation.

Ouvrez le projet dans un navigateur en entrant l'adresse 127.0.0.1 ou localhost, qui est l'adresse locale permettant d'accéder à votre serveur local.
Sélectionnez le dossier gestpressing3 et l'application s'ouvrira et vous invitera à vous connecter.
Un utilisateur ayant le statut d'administrateur est créé par défaut. Vous pouvez l'utiliser pour vous connecter. Après connexion, créez votre compte avec un statut administrateur et désactivez l'admin par défaut (afin qu'une tierce personne ne puisse l'utiliser pour accéder frauduleusement à votre application).

Utilisateur par défaut
Login : Technosoft
Mot de passe : version3

Vous avez la possibilité d'installer l'application directement depuis le navigateur.

Vous avez désormais un accès total à votre application Gestpressing afin de gérer votre pressing où que vous soyez.

SI VOUS RENCONTREZ DES PROBLÈMES, VEUILLEZ CONTACTER LE SERVICE TECHNIQUE AFIN DE BÉNÉFICIER D'UNE ASSISTANCE :

Téléphone et WhatsApp : +237 699388115 / +237 672222260
Email : achilletawokam@gmail.com

AVERTISSEMENT :
SI VOUS AVEZ OBTENU CE LOGICIEL DE MANIÈRE ILLÉGALE, VOUS SEREZ POURSUIVI EN JUSTICE POUR VOL DE LA PROPRIÉTÉ INTELLECTUELLE. LE SEUL MOYEN D'UTILISER CE PROJET EST D'ACHETER LA LICENCE CHEZ ACHILLE TAWOKAM EN APPELANT L'UN DES NUMÉROS CI-DESSUS.

VOUS N'ÊTES PAS AUTORISÉS À :
•  MODIFIER LE CODE SOURCE DU PROJET (À L'EXCEPTION DES FICHIERS DE CONNEXION SERVEUR) ;

•  REDISTRIBUER LE LOGICIEL.

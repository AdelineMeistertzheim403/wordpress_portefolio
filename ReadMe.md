## Mon portfolio WordPress

Ce projet peut maintenant etre deploye automatiquement en production sans ecraser les donnees runtime de WordPress.

### Principe retenu

Le deploiement pousse uniquement le code et la configuration necessaires au site :

- `config/`
- `docker-compose.yml`
- `scripts/`
- `wp-content/themes/adeline-portfolio/`
- le reste du code versionne utile au site

Le workflow n'ecrase pas :

- `wp-content/uploads/`
- `wp-content/litespeed/`
- `wp-content/cache/`
- `wp-content/plugins/`
- les themes WordPress non custom
- `.env`
- les dumps SQL

Avant chaque mise a jour, le serveur cree un dump SQL dans `backups/db/`, puis relance proprement les conteneurs.

### Fichiers ajoutes

- `.github/workflows/deploy-production.yml` : pipeline GitHub Actions
- `scripts/deploy/remote-deploy.sh` : sauvegarde DB + redeploiement Docker sur le serveur

### Pre-requis cote serveur

Le serveur de production doit avoir :

- Docker et `docker compose`
- un dossier de deploiement, par exemple `/opt/wordpress_portefolio`
- un fichier `.env` deja present dans ce dossier
- les droits SSH pour l'utilisateur de deploiement

Le fichier `.env` ne doit pas etre versionne. Il reste uniquement sur le serveur.

### Secrets GitHub a creer

Dans le depot GitHub, ajoute ces secrets dans l'environnement `production` ou dans les secrets du depot :

- `SSH_HOST` : IP ou domaine du serveur
- `SSH_PORT` : port SSH, generalement `22`
- `SSH_USER` : utilisateur SSH
- `SSH_PRIVATE_KEY` : cle privee de deploiement
- `DEPLOY_PATH` : chemin absolu du projet sur le serveur, par exemple `/opt/wordpress_portefolio`

### Fonctionnement du deploiement

Chaque push sur `main` declenche :

1. une synchronisation du depot vers le serveur avec `rsync`
2. une exclusion explicite des donnees runtime WordPress
3. une sauvegarde SQL avant application
4. un `docker compose up -d` pour appliquer la mise a jour

### Premiere mise en service

1. Copier ce projet sur le serveur dans le dossier cible.
2. Creer le fichier `.env` de production dans ce dossier.
3. Verifier que `docker compose -f docker-compose.yml up -d` fonctionne manuellement.
4. Ajouter les secrets GitHub.
5. Faire un push sur `main` ou lancer le workflow manuellement.

Si le workflow affiche des erreurs `Permission denied` sur `wp-content/themes`, appliquer une fois sur le serveur :

```bash
sudo chown -R debian:debian /home/debian/wordpress/wp-content/themes/adeline-portfolio
sudo chmod -R u+rwX,go+rX /home/debian/wordpress/wp-content/themes/adeline-portfolio
```

### Conseils pour developper un theme personnalise

Pour la suite, le plus propre sera de developper ton theme dans un dossier dedie sous `wp-content/themes/`, par exemple `wp-content/themes/adeline-portfolio/`.

Le workflow de deploiement est deja compatible avec cette approche : des que ton theme est versionne dans le depot, il sera deploye automatiquement sans toucher aux uploads ni a la base.

# Migration local -> production (contenu + media + reglages)

Ce guide couvre 3 besoins:

- deploiement de plugins custom versionnes
- export/import controle des reglages Customizer + Elementor
- migration complete contenu (base + uploads)

## 1) Deployer des plugins custom precis

Le workflow lit la variable de repository `PLUGIN_SYNC_PATHS`.

Exemple de valeur:

wp-content/plugins/mon-plugin wp-content/plugins/mon-autre-plugin

Points importants:

- seuls les chemins commencant par `wp-content/plugins/` sont acceptes
- chaque chemin est synchronise avec `--delete` (la copie distante suit le repo)
- si la variable est vide, aucun plugin n est synchronise

## 2) Export / import controle des reglages UI

Scripts:

- `scripts/deploy/export-ui-state.sh`
- `scripts/deploy/import-ui-state.sh`

Export (depuis la source):

```bash
bash scripts/deploy/export-ui-state.sh
```

Genere 2 dumps SQL dans `backups/ui-state/`:

- options WordPress liees au theme et a Elementor
- donnees `elementor_library` (posts + postmeta)

Import (sur la cible):

```bash
bash scripts/deploy/import-ui-state.sh \
  backups/ui-state/ui-options-YYYY-mm-dd-HHMMSS.sql \
  backups/ui-state/ui-elementor-library-YYYY-mm-dd-HHMMSS.sql
```

Le script fait d abord une sauvegarde SQL complete de securite.

## 3) Migration complete contenu (base + media)

Scripts:

- `scripts/deploy/export-content-bundle.sh`
- `scripts/deploy/import-content-bundle.sh`

### Export du bundle sur la source

```bash
bash scripts/deploy/export-content-bundle.sh
```

Le bundle est cree dans `backups/content-bundles/bundle-<timestamp>/` et contient:

- `db.sql` (base complete)
- `uploads.tar.gz` (media)
- eventuellement les dumps UI si le script est executable

### Import du bundle sur la cible

Copier le dossier bundle sur le serveur de destination, puis:

```bash
bash scripts/deploy/import-content-bundle.sh backups/content-bundles/bundle-<timestamp>
```

Le script:

- sauvegarde la base actuelle
- sauvegarde les uploads actuels
- restaure la base depuis `db.sql`
- restaure les uploads depuis `uploads.tar.gz` si present

## Bonnes pratiques

- faire un test de restauration d abord sur preproduction
- verifier les permissions sur `wp-content/uploads`
- verifier le front et l admin (pages, medias, kits Elementor)
- conserver les dossiers `backups/` hors du web root public si possible

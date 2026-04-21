#!/usr/bin/env bash
set -Eeuo pipefail

APP_DIR="${APP_DIR:-$(pwd)}"
COMPOSE_FILE="${COMPOSE_FILE:-docker-compose.yml}"
BACKUP_DIR="${BACKUP_DIR:-${APP_DIR}/backups/db}"
RETENTION_DAYS="${RETENTION_DAYS:-14}"
DEPLOY_SHA="${DEPLOY_SHA:-manual}"

cd "${APP_DIR}"

if [[ ! -f .env ]]; then
  echo "[deploy] Missing .env in ${APP_DIR}" >&2
  exit 1
fi

if docker compose version >/dev/null 2>&1; then
  compose_cmd=(docker compose)
elif command -v docker-compose >/dev/null 2>&1; then
  compose_cmd=(docker-compose)
else
  echo "[deploy] docker compose is not available on the server" >&2
  exit 1
fi

mkdir -p "${BACKUP_DIR}"

timestamp="$(date +%Y-%m-%d-%H%M%S)"
backup_file="${BACKUP_DIR}/wordpress-prod-${timestamp}.sql"

echo "[deploy] Creating database backup at ${backup_file}"
"${compose_cmd[@]}" --env-file .env -f "${COMPOSE_FILE}" exec -T wordpress-db sh -lc \
  'exec mariadb-dump -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE"' > "${backup_file}"

echo "[deploy] Applying updated containers"
"${compose_cmd[@]}" --env-file .env -f "${COMPOSE_FILE}" up -d

printf '%s\n' "${DEPLOY_SHA}" > .deploy-sha

echo "[deploy] Cleaning backups older than ${RETENTION_DAYS} days"
find "${BACKUP_DIR}" -type f -name 'wordpress-prod-*.sql' -mtime +"${RETENTION_DAYS}" -delete

echo "[deploy] Deployment completed successfully"
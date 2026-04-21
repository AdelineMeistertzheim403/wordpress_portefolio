#!/usr/bin/env bash
set -Eeuo pipefail

APP_DIR="${APP_DIR:-$(pwd)}"
COMPOSE_FILE="${COMPOSE_FILE:-docker-compose.yml}"
BUNDLE_DIR="${1:-}"
BACKUP_DIR="${BACKUP_DIR:-${APP_DIR}/backups/pre-restore}"

detect_compose_cmd() {
  if docker compose version >/dev/null 2>&1; then
    echo "docker compose"
  elif command -v docker-compose >/dev/null 2>&1; then
    echo "docker-compose"
  else
    echo ""
  fi
}

cd "${APP_DIR}"

if [[ ! -f .env ]]; then
  echo "[content-import] Missing .env in ${APP_DIR}" >&2
  exit 1
fi

if [[ -z "${BUNDLE_DIR}" || ! -d "${BUNDLE_DIR}" ]]; then
  echo "Usage: $0 <bundle-directory>" >&2
  exit 1
fi

db_file="${BUNDLE_DIR}/db.sql"
uploads_file="${BUNDLE_DIR}/uploads.tar.gz"

if [[ ! -f "${db_file}" ]]; then
  echo "[content-import] Missing ${db_file}" >&2
  exit 1
fi

compose_cmd="$(detect_compose_cmd)"
if [[ -z "${compose_cmd}" ]]; then
  echo "[content-import] docker compose is not available" >&2
  exit 1
fi

mkdir -p "${BACKUP_DIR}"
timestamp="$(date +%Y-%m-%d-%H%M%S)"
backup_db="${BACKUP_DIR}/before-content-import-${timestamp}.sql"
backup_uploads="${BACKUP_DIR}/uploads-before-content-import-${timestamp}.tar.gz"

echo "[content-import] Creating safety DB backup at ${backup_db}"
${compose_cmd} --env-file .env -f "${COMPOSE_FILE}" exec -T wordpress-db sh -lc \
  'exec mariadb-dump -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE"' > "${backup_db}"

if [[ -d "${APP_DIR}/wp-content/uploads" ]]; then
  echo "[content-import] Creating safety uploads backup at ${backup_uploads}"
  tar -C "${APP_DIR}/wp-content" -czf "${backup_uploads}" uploads
fi

echo "[content-import] Restoring database from ${db_file}"
cat "${db_file}" | ${compose_cmd} --env-file .env -f "${COMPOSE_FILE}" exec -T wordpress-db sh -lc \
  'exec mariadb -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE"'

if [[ -f "${uploads_file}" ]]; then
  echo "[content-import] Restoring uploads from ${uploads_file}"
  rm -rf "${APP_DIR}/wp-content/uploads"
  tar -C "${APP_DIR}/wp-content" -xzf "${uploads_file}"
else
  echo "[content-import] No uploads archive found in bundle, skipping media restore"
fi

echo "[content-import] Completed"

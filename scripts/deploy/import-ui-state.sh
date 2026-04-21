#!/usr/bin/env bash
set -Eeuo pipefail

APP_DIR="${APP_DIR:-$(pwd)}"
COMPOSE_FILE="${COMPOSE_FILE:-docker-compose.yml}"
OPTIONS_FILE="${1:-}"
LIBRARY_FILE="${2:-}"
BACKUP_DIR="${BACKUP_DIR:-${APP_DIR}/backups/db}"

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
  echo "[ui-import] Missing .env in ${APP_DIR}" >&2
  exit 1
fi

if [[ -z "${OPTIONS_FILE}" || -z "${LIBRARY_FILE}" ]]; then
  echo "Usage: $0 <ui-options.sql> <ui-elementor-library.sql>" >&2
  exit 1
fi

if [[ ! -f "${OPTIONS_FILE}" ]]; then
  echo "[ui-import] Missing options file: ${OPTIONS_FILE}" >&2
  exit 1
fi

if [[ ! -f "${LIBRARY_FILE}" ]]; then
  echo "[ui-import] Missing Elementor library file: ${LIBRARY_FILE}" >&2
  exit 1
fi

compose_cmd="$(detect_compose_cmd)"
if [[ -z "${compose_cmd}" ]]; then
  echo "[ui-import] docker compose is not available" >&2
  exit 1
fi

mkdir -p "${BACKUP_DIR}"
timestamp="$(date +%Y-%m-%d-%H%M%S)"
backup_file="${BACKUP_DIR}/wordpress-before-ui-import-${timestamp}.sql"

echo "[ui-import] Creating safety backup at ${backup_file}"
${compose_cmd} --env-file .env -f "${COMPOSE_FILE}" exec -T wordpress-db sh -lc \
  'exec mariadb-dump -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE"' > "${backup_file}"

echo "[ui-import] Importing ${OPTIONS_FILE}"
cat "${OPTIONS_FILE}" | ${compose_cmd} --env-file .env -f "${COMPOSE_FILE}" exec -T wordpress-db sh -lc \
  'exec mariadb -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE"'

echo "[ui-import] Importing ${LIBRARY_FILE}"
cat "${LIBRARY_FILE}" | ${compose_cmd} --env-file .env -f "${COMPOSE_FILE}" exec -T wordpress-db sh -lc \
  'exec mariadb -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE"'

echo "[ui-import] Completed. Backup available at ${backup_file}"

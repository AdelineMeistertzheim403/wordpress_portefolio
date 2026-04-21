#!/usr/bin/env bash
set -Eeuo pipefail

APP_DIR="${APP_DIR:-$(pwd)}"
COMPOSE_FILE="${COMPOSE_FILE:-docker-compose.yml}"
OUTPUT_DIR="${OUTPUT_DIR:-${APP_DIR}/backups/ui-state}"

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
  echo "[ui-export] Missing .env in ${APP_DIR}" >&2
  exit 1
fi

if [[ ! -f "${APP_DIR}/config/wp-config.php" ]]; then
  echo "[ui-export] Missing config/wp-config.php in ${APP_DIR}" >&2
  exit 1
fi

compose_cmd="$(detect_compose_cmd)"
if [[ -z "${compose_cmd}" ]]; then
  echo "[ui-export] docker compose is not available" >&2
  exit 1
fi

TABLE_PREFIX="$(sed -n "s/^\$table_prefix\s*=\s*'\([^']\+\)'.*/\1/p" "${APP_DIR}/config/wp-config.php" | head -n1)"
if [[ -z "${TABLE_PREFIX}" ]]; then
  echo "[ui-export] Unable to detect WordPress table prefix from config/wp-config.php" >&2
  exit 1
fi

mkdir -p "${OUTPUT_DIR}"

timestamp="$(date +%Y-%m-%d-%H%M%S)"
options_file="${OUTPUT_DIR}/ui-options-${timestamp}.sql"
library_file="${OUTPUT_DIR}/ui-elementor-library-${timestamp}.sql"

echo "[ui-export] Exporting options to ${options_file}"
${compose_cmd} --env-file .env -f "${COMPOSE_FILE}" exec -T -e TABLE_PREFIX="${TABLE_PREFIX}" wordpress-db sh -lc '
  exec mariadb-dump -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" "${TABLE_PREFIX}options" \
    --no-tablespaces --skip-triggers --single-transaction \
    --where="option_name IN (\"template\",\"stylesheet\",\"current_theme\",\"elementor_active_kit\") OR option_name LIKE \"theme_mods_%\" OR option_name LIKE \"elementor_%\""
' > "${options_file}"

echo "[ui-export] Exporting Elementor library rows to ${library_file}"
${compose_cmd} --env-file .env -f "${COMPOSE_FILE}" exec -T -e TABLE_PREFIX="${TABLE_PREFIX}" wordpress-db sh -lc '
  exec mariadb-dump -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" \
    "${TABLE_PREFIX}posts" \
    --no-tablespaces --skip-triggers --single-transaction \
    --where="post_type = '\''elementor_library'\''"
' > "${library_file}"

${compose_cmd} --env-file .env -f "${COMPOSE_FILE}" exec -T -e TABLE_PREFIX="${TABLE_PREFIX}" wordpress-db sh -lc '
  exec mariadb-dump -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" \
    "${TABLE_PREFIX}postmeta" \
    --no-tablespaces --skip-triggers --single-transaction \
    --where="post_id IN (SELECT ID FROM ${TABLE_PREFIX}posts WHERE post_type = \"elementor_library\")"
' >> "${library_file}"

cat <<EOF
[ui-export] Completed
[ui-export] table prefix: ${TABLE_PREFIX}
[ui-export] files:
  - ${options_file}
  - ${library_file}
EOF

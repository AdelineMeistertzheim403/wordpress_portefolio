#!/usr/bin/env bash
set -Eeuo pipefail

APP_DIR="${APP_DIR:-$(pwd)}"
COMPOSE_FILE="${COMPOSE_FILE:-docker-compose.yml}"
OUTPUT_ROOT="${OUTPUT_ROOT:-${APP_DIR}/backups/content-bundles}"

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
  echo "[content-export] Missing .env in ${APP_DIR}" >&2
  exit 1
fi

compose_cmd="$(detect_compose_cmd)"
if [[ -z "${compose_cmd}" ]]; then
  echo "[content-export] docker compose is not available" >&2
  exit 1
fi

mkdir -p "${OUTPUT_ROOT}"
timestamp="$(date +%Y-%m-%d-%H%M%S)"
bundle_dir="${OUTPUT_ROOT}/bundle-${timestamp}"
mkdir -p "${bundle_dir}"

db_file="${bundle_dir}/db.sql"
uploads_file="${bundle_dir}/uploads.tar.gz"
manifest_file="${bundle_dir}/manifest.txt"

echo "[content-export] Exporting database to ${db_file}"
${compose_cmd} --env-file .env -f "${COMPOSE_FILE}" exec -T wordpress-db sh -lc \
  'exec mariadb-dump -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE"' > "${db_file}"

if [[ -d "${APP_DIR}/wp-content/uploads" ]]; then
  echo "[content-export] Archiving uploads to ${uploads_file}"
  tar -C "${APP_DIR}/wp-content" -czf "${uploads_file}" uploads
else
  echo "[content-export] uploads directory not found, skipping media archive"
fi

if [[ -f "${APP_DIR}/scripts/deploy/export-ui-state.sh" ]]; then
  OUTPUT_DIR="${bundle_dir}" APP_DIR="${APP_DIR}" COMPOSE_FILE="${COMPOSE_FILE}" bash "${APP_DIR}/scripts/deploy/export-ui-state.sh"
else
  echo "[content-export] scripts/deploy/export-ui-state.sh not found, skipping UI state export"
fi

cat > "${manifest_file}" <<EOF
bundle=${bundle_dir}
created_at=${timestamp}
database=${db_file}
uploads=${uploads_file}
EOF

echo "[content-export] Completed bundle at ${bundle_dir}"

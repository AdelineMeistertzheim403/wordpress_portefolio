#!/bin/sh
set -eu

latest_dump="$(ls -1 /seed/wordpress-prod-*.sql 2>/dev/null | sort | tail -n 1 || true)"

if [ -n "${latest_dump}" ]; then
  echo "[db-init] Importing dump: ${latest_dump}"
  mariadb -u"${MYSQL_USER}" -p"${MYSQL_PASSWORD}" "${MYSQL_DATABASE}" < "${latest_dump}"
  echo "[db-init] Import completed"
else
  echo "[db-init] No dump found at /seed/wordpress-prod-*.sql, skipping import"
fi

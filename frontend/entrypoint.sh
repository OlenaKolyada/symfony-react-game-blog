#!/bin/sh
set -e

HASH_FILE="/app/node_modules/.package-hash"

CURRENT_HASH="$(sha256sum package.json package-lock.json | sha256sum | cut -d ' ' -f 1)"

if [ ! -f "$HASH_FILE" ] || [ "$(cat "$HASH_FILE")" != "$CURRENT_HASH" ]; then
  echo "Frontend dependencies changed. Running npm install..."
  npm install
  echo "$CURRENT_HASH" > "$HASH_FILE"
else
  echo "Frontend dependencies are up to date."
fi

npm run dev
#!/bin/bash
set -e

# Change www-data's uid & guid to be the same as directory in host or the configured one
# Fixes cache problems
sed -ie "s/`id -u www-data`/`stat -c %u /var/www/html`/g" /etc/passwd

# Execute all commands with user www-data
if [ "$1" = "composer" ]; then
    su www-data -s /bin/bash -c "`which php` -d memory_limit=-1 `which composer` ${*:2}"
else
    su www-data -s /bin/bash -c "$*"
fi

#!/usr/bin/env bash

mysql --user=root --password="$MYSQL_ROOT_PASSWORD" <<-EOSQL
    CREATE DATABASE IF NOT EXISTS couleur3;
    GRANT ALL PRIVILEGES ON \`couleur3%\`.* TO '$MYSQL_USER'@'%';
EOSQL

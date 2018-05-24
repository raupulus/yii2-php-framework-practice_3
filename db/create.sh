#!/usr/bin/env bash
# -*- ENCODING: UTF-8 -*-

if [[ "$1" = "travis" ]]; then
    psql -U postgres -c "CREATE DATABASE practica3_yii2__test;"
    psql -U postgres -c "CREATE USER practica3_yii2_ PASSWORD 'practica3_yii2_' SUPERUSER;"
else
    if [[ "$1" != "test" ]]; then
        sudo -u postgres dropdb --if-exists practica3_yii2_
        sudo -u postgres dropdb --if-exists practica3_yii2__test
        sudo -u postgres dropuser --if-exists practica3_yii2_
    fi

    sudo -u postgres psql -c "CREATE USER practica3_yii2_ PASSWORD 'practica3_yii2_' SUPERUSER;"

    if [[ "$1" != "test" ]]; then
        sudo -u postgres createdb -O practica3_yii2_ practica3_yii2_
    fi

    sudo -u postgres createdb -O practica3_yii2_ practica3_yii2__test

    LINE="localhost:5432:*:practica3_yii2_:practica3_yii2_"
    FILE="$HOME/.pgpass"

    if [[ ! -f "$FILE" ]]; then
        touch "$FILE"
        chmod 600 "$FILE"
    fi

    if ! grep -qsF "$LINE" $FILE; then
        echo "$LINE" >> "$FILE"
    fi
fi

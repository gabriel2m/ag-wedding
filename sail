#!/usr/bin/env bash

export SAIL=${SAIL:-"./vendor/bin/sail"}
export APP_SERVICE=${APP_SERVICE:-"laravel.test"}

if [ "$1" == "exec" ]; then
    shift 1
    $SAIL exec $APP_SERVICE $@
else
    $SAIL $@
fi

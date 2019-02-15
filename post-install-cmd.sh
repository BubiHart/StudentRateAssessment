#!/bin/sh
if [ -n "$DYNO" ]
then
    php init --env=Heroku --overwrite=All
    ln -s /app/backend/web frontend/web/admin
    ln -s /app/vendor/bower-asset vendor/bower
fi

#!/bin/bash
# Copy custom Nginx config to /etc/nginx
cp /home/site/includes/default /etc/nginx/sites-available/default
# Restart Nginx service
service nginx restart

sed -i 's/\r//' startup.sh

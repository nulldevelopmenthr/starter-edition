sudo setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx  var/cache var/logs
sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx var/cache var/logs
sudo chmod 777 -R var/cache var/logs
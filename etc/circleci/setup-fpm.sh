sudo cp /opt/circleci/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.d/www.conf.default /opt/circleci/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.d/www.conf
sudo cp /opt/circleci/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.conf.default /opt/circleci/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.conf
/opt/circleci/.phpenv/versions/$(phpenv version-name)/sbin/php-fpm
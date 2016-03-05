#!/bin/sh
sed -i 's/^;//' ~/.phpenv/versions/$(phpenv global)/etc/conf.d/xdebug.ini
./bin/phpunit --coverage-clover build/logs/clover.xml
./bin/test-reporter --coverage-report=build/logs/clover.xml --stdout > codeclimate.json
curl -X POST -d @codeclimate.json -H 'Content-Type: application/json' -H "User-Agent: Code Climate (PHP Test Reporter v0.1.1)" https://codeclimate.com/test_reports

cp etc/circleci/app/config/parameters.yml app/config/parameters.yml
cp etc/circleci/web/app_test.php web/app_test.php
sed -i 's/test.project_name.loc/www.test.ci/' behat.yml
sed -i 's/FAKE-GITHUB-ID-TEST/'"$GITHUB_ID"'/' app/config/parameters.yml
sed -i 's/FAKE-GITHUB-SECRET-TEST/'"$GITHUB_SECRET"'/' app/config/parameters.yml

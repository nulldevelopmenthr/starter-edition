sudo apt-get install nginx
sudo mkdir /etc/nginx/ssl/
sudo cp etc/circleci/ssl/server.crt /etc/nginx/ssl/server.crt
sudo cp etc/circleci/ssl/server.key /etc/nginx/ssl/server.key
sed -i 's/PROJECT_NAME/'"$CIRCLE_PROJECT_REPONAME"'/' etc/circleci/symfony2-test-application.conf
sudo cp etc/circleci/symfony2-test-application.conf /etc/nginx/sites-enabled/
sudo service nginx restart
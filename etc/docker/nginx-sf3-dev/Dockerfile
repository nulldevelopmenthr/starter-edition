FROM msvrtan/sf3-nginx-dev:0.2.0

RUN sed -i.bak "s#DEV_DOMAIN_NAME#www.project_name.loc#g" /etc/nginx/sites-available/symfony-dev.conf
RUN sed -i.bak "s#WEBROOT_PATH#/var/www/web/#g" /etc/nginx/sites-available/symfony-dev.conf

RUN rm /etc/nginx/sites-available/symfony-dev.conf.bak

CMD ["nginx"]

EXPOSE 80 443

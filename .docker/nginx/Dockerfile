FROM nginx:1.23.1

ADD ./.docker/nginx/nginx.conf /etc/nginx/nginx.conf
ADD ./.docker/nginx/site.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www

USER nginx

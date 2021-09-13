FROM gaibz/ubuntu20-php7.4-nginx:latest

RUN apt update && apt install openjdk-8-jdk -y
RUN rm /etc/nginx/sites-enabled/default.conf
COPY etc/default.conf /etc/nginx/sites-enabled/default.conf

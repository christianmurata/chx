FROM mysql:5.7
LABEL maintainer 'Christian Murata <chris_murata@hotmail.com>'

ADD chx.sql /tmp/chx.sql

RUN /bin/bash -c "/usr/bin/mysqld_safe --skip-grant-tables &" && \
  sleep 5 && \
  mysql -u root -e "CREATE DATABASE chx" && \
  mysql -u root chx < /tmp/chx.sql
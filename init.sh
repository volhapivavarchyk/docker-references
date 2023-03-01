#!/bin/bash
#rm -rf docker/mysql
docker-compose up --build --force-recreate -d
docker exec -i ref-db sh -c 'exec mysql -udb -pdb proton_mail_global' < ./docker/mysql-conf/init/ProtonMailGlobal_4.sql
docker exec -i ref-db sh -c 'exec mysql -udb -pdb proton_mail_shard' < ./docker/mysql-conf/init/ProtonMailShard_4.sql
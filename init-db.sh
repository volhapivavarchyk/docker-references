#!/bin/bash
docker exec -i ref-db sh -c 'exec mysql -uroot  proton_mail_global' < ./docker/mysql-init/ProtonMailGlobal_4.sql
docker exec -i ref-db sh -c 'exec mysql -uroot  proton_mail_shard' < ./docker/mysql-init/ProtonMailShard_4.sql
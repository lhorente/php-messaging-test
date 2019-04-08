# PHP Messasing Test

Teste de serviço de filas e mensagens, utilizando PHP e RabbitMQ/AMQP baseado no cliente php-amqplib.

Envia uma mensagem de Hello World, um Identificador do micro-serviço, o timestamp que foi enviado, e um Id de requisição aleatório a cada 5 segunbdos.

## Requerimentos
  - Ubuntu 14^
  - PHP 7.0^
  - Extensões PHP: dom, curl e bcmath
  - RabbitMQ
  - Composer

## Instalação
- Baixar repositório: git clone git@github.com:lhorente/php-messaging-test.git
- Baixar dependências pelo comando: composer update

## Enviar mensagens
Para enviar mensagens utilize o comando:
```sh
$ php publisher.php
```

## Ler mensagens e imprimir no console
Utilizar o comando abaixo para imprimir as mensagens enviadas na tela:
```sh
$ php consumer.php
```

# O experimento
O experimento foi feito utilizando a máquina virtual ubuntu/trusty64 do Vagrant.

# Fontes
- https://monkeyhacks.com/installing-rabbitmq-on-ubuntu-14-04/
- https://github.com/php-amqplib/php-amqplib

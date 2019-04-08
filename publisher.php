<?php

include(__DIR__ . '/config.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;

$exchange = 'router';
$queue = 'msgs_queue';

$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS, VHOST);
$channel = $connection->channel();

/*
	Definir a fila em que as mensagens serão publicadas.
*/
$channel->queue_declare($queue, false, true, false, false);
$channel->exchange_declare($exchange, AMQPExchangeType::DIRECT, false, true, false);

// Adiciona fila ao canal da conexão atual
$channel->queue_bind($queue, $exchange);

/*
	Gera um loop para enviar mensagens a cada 5 segundos.
	Solução provivória com finalidade teste do funcionamento.
*/
while (true){
	$microservice_id = bin2hex(openssl_random_pseudo_bytes(16));
	$random_request_id = bin2hex(openssl_random_pseudo_bytes(16));
	
	$messageBody = "Hello World";
	
	$msgObj = [
		'microservice_id' => $microservice_id,
		'message' => $messageBody,
		'timestamp' => time(),
		'random_request_id' => $random_request_id
	];
	
	$message = new AMQPMessage(json_encode($msgObj), array('content_type' => 'application/json', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));
	$channel->basic_publish($message, $exchange);
	sleep(5);
}

$channel->close();
$connection->close();

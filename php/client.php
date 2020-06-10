<?php


use Greeter\GreeterClient;
use Greeter\HelloReply;
use Grpc\UnaryCall;

require dirname(__FILE__).'/vendor/autoload.php';

@include_once dirname(__FILE__).'/Greeter/GreeterClient.php';
@include_once dirname(__FILE__).'/Greeter/HelloReply.php';
@include_once dirname(__FILE__).'/Greeter/HelloRequest.php';
@include_once dirname(__FILE__).'/GPBMetadata/Sample.php';

function greet($name)
{
    $client  = new GreeterClient("localhost:50051", [
        "credentials" => Grpc\ChannelCredentials::createInsecure(),
    ]);
    $request = new \Greeter\HelloRequest();
    $request->setName($name);
    /**@var UnaryCall $call */
    $call = $client->SayHello($request);
    /**@var HelloReply $reply */
    list($reply, $status) = $call->wait();

    return $reply->getMessage();
}

$name = !empty($argv[1]) ? $argv[1] : 'PHP Client';
echo greet($name)."\n";


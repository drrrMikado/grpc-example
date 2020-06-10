<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Greeter;

/**
 * The greeting service definition.
 */
class GreeterClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Sends a greeting
     * @param \Greeter\HelloRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Greeter\UnaryCall
     */
    public function SayHello(\Greeter\HelloRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/greeter.Greeter/SayHello',
        $argument,
        ['\Greeter\HelloReply', 'decode'],
        $metadata, $options);
    }

}

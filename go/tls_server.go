package main

import (
	"greeter/pb"
	"log"
	"net"

	"google.golang.org/grpc"
	"google.golang.org/grpc/credentials"
)

func main() {
	listen, err := net.Listen("tcp", "127.0.0.1:50051")
	if err != nil {
		log.Fatalln(err)
	}
	c, err := credentials.NewServerTLSFromFile("../tls/server.pem", "../tls/server.key")
	if err != nil {
		log.Fatalf("credentials.NewServerTLSFromFile err: %v", err)
	}
	s := grpc.NewServer(grpc.Creds(c))
	pb.RegisterGreeterServer(s, &server{})
	if err := s.Serve(listen); err != nil {
		log.Fatalln(err)
	}
}

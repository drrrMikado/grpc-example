package main

import (
	"context"
	"greeter/pb"
	"log"

	"google.golang.org/grpc"
	"google.golang.org/grpc/credentials"
)

func main() {
	c, err := credentials.NewClientTLSFromFile("../tls/server.pem", "localhost")
	if err != nil {
		log.Fatalf("credentials.NewClientTLSFromFile err: %v", err)
	}

	conn, err := grpc.Dial(":50051", grpc.WithTransportCredentials(c))
	if err != nil {
		log.Fatalf("grpc.Dial err: %v", err)
	}
	defer func() { _ = conn.Close() }()

	client := pb.NewGreeterClient(conn)
	resp, err := client.SayHello(context.Background(), &pb.HelloRequest{
		Name: "gRPC",
	})
	if err != nil {
		log.Fatalf("client.SayHello err: %v", err)
	}

	log.Printf("resp: %s", resp.GetMessage())
}

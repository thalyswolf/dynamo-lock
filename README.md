# Description
This project is a DynamoDB performance test using optimistic/pessimistic lock.

## Objective
The objective of this POC is to understand how the AWS DynamoDB works with concurrencies and what is better way to apply it to a real project.
## Architecture
![Api Gateway, Lambda e dynamoDB](https://github.com/thalyswolf/dynamo-lock/blob/488ba912084721855d4ff55371dbaff7032d67f3/architecture.png?raw=true)

## Optimistic lock test results
For testing was used ApacheBench.

### 200 Requests with max concurrency 10 request
```console
$ ab -n 200 -c 10 https://urlmyapigateway/
```
![terminal result](https://github.com/thalyswolf/dynamo-lock/blob/main/results/opimistic_200_request_with_10_conccurencies.png?raw=true)

### 1000 requests with max concurrency 15 request 
```console
$ ab -n 1000 -c 15 https://urlmyapigateway/
```
![opimistic_1000_request_with_15_conccurencies.png](https://github.com/thalyswolf/dynamo-lock/blob/main/results/opimistic_1000_request_with_15_conccurencies.png?raw=true)

#### For more ... take a look in results folder 
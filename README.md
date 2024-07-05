# Loan Fee Calculation Project

## Overview
This project is a recruitment task aimed at calculating the fee for a granted loan. The application provides a simple yet effective way to determine the loan fee based on predefined criteria.

## Prerequisites

Make sure you have the following installed on your machine:
- Docker
- Docker Compose

## Setup

1. **Clone the repository**

```bash
   git clone https://github.com/malpka32/PragmaGoTask
   cd PragmaGoTask
```

2. Build and start the containers
```bash
   docker-compose up
```
This command will start all the containers at once that are configured in the `docker-compose.yaml`.

You can also start each container individually by running separate commands:
## Running the Application

To run the example application, use the following command:
```bash
docker-compose run --rm example
```
This will start the example application inside a Docker container.

## Running Tests

To run the tests, use the following command:
```bash
docker-compose run --rm tests
```

This will execute the test suite inside a Docker container.

## Running PHPStan

To check the code with PHPStan, use the following command:

```bash
docker-compose run --rm phpstan
```

This will run PHPStan for static code analysis inside a Docker container. 
Currently, I have two issues for which I haven't found a solution yet, but I will keep looking.
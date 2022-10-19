## Start docker

    make docker-build
    make docker-up

## Generate JWT
1. Connect to php container
   

    make docker-exec

2. Execute command


    bin/console lexik:jwt:generate-keypair --skip-if-exists
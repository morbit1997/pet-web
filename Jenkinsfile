pipeline {
    environment {
        nomad_addr = "http://192.168.1.12:4646"
    }
    agent any
    stages{
        stage("Build") {
            steps{
                script{
                    git "https://github.com/morbit1997/pet-web.git"
                    checkout scm
                    docker.withRegistry("","dockerehub_morbit1997") {
                        def dockerfileNginx = "./Dockerfiles/Dockerfile-nginx"
                        def dockerfilePhp = "./Dockerfiles/Dockerfile-php"
                        def nginxImage = docker.build("morbit1997/nginx:${env.BUILD_ID}","-f ${dockerfileNginx} ./Dockerfiles")
                        def phpImage = docker.build("morbit1997/nginx:${env.BUILD_ID}","-f ${dockerfilePhp} ./Dockerfiles")
                        nginxImage.push()
                        phpImage.push()
                    }
                }
            }
        }
        stage("Deploy to nomad"){
            steps{
                script{
                    checkout scm
                    docker.image('hashicorp/nomad').withRun('-e "NOMAD_ADDR=http://192.168.1.12:4646"') {c ->
                        sh 'status'
                    }
                }
            }
        }
    }
}
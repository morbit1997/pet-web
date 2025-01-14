pipeline {
    environment {
        nomad_addr = "http://192.168.1.12:4646"
    }
    agent any
    stages{
        stage("Clone git repo") {
            git "https://github.com/morbit1997/pet-web.git"
        }
        stage("Build") {
            script{
                checkout scm
                docker.withRegistry("","dockerehub_morbit1997") {
                    def dockerfileNginx = "Dockerfile-nginx"
                    def dockerfilePhp = "Dockerfile-php"
                    def nginxImage = docker.build("nginx:${env.BUILD_ID}","-f ${dockerfileNginx} ./Dockerfiles")
                    def phpImage = docker.build("php:${env.BUILD_ID}","-f ${dockerfilePhp} ./Dockerfiles")
                    nginxImage.push()
                    phpImage.push()
                }
            }
        }
        stage("Deploy to nomad"){
            agent{
                docker {
                    image 'hashicorp/nomad'
                    args '-e NOMAD_ADDR="${nomad_addr}"'
                }
            }
            steps{
                sh 'envsubst '${CI_COMMIT_SHORT_SHA}' < webapp.nomad.hcl > job.nomad'
                sh 'cat job.nomad'
                sh 'nomad validate job.nomad'
                sh 'nomad plan job.nomad || if [ $? -eq 255 ]; then exit 255; else echo "success"; fi'
                sh 'nomad run job.nomad'
            }
        }
    }
}
pipeline {
    environment {
        nomad_addr = "http://192.168.1.12:4646"
        tag = ${env.BUILD_ID}
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
                        def phpImage = docker.build("morbit1997/php:${env.BUILD_ID}","-f ${dockerfilePhp} ./Dockerfiles")
                        nginxImage.push()
                        phpImage.push()
                    }
                }
            }
        }
        stage("Deploy to nomad"){
            agent{
                docker {
                    image 'morbit1997/nomad_deployer'
                    args '-e NOMAD_ADDR="${nomad_addr}"'
                }
            }
            steps{
                checkout scm
                sh 'envsubst "$tag" < webapp.nomad.hcl > job.nomad'
                sh 'cat job.nomad'
                sh 'nomad validate job.nomad'
                sh 'nomad plan job.nomad || if [ $? -eq 255 ]; then exit 255; else echo "success"; fi'
                sh 'nomad run job.nomad'
            }
        }
    }
}
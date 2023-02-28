pipeline {
    agent any
    stages {
        stage("Verify tooling") {
            steps {
                sh '''
                    docker info
                    docker version
                    docker ps
                '''
            }
        }
             
        stage("Build new application") {
            steps {
                sh 'docker build -t appwise-pokemon-api .'
            }
        }

        stage("Stop and remove old application") {
            steps {
                script {
                    catchError(buildResult: 'SUCCESS', stageResult: 'FAILURE') {
                    sh '''
                        docker stop pokemon-api-appwise
                        docker rm pokemon-api-appwise
                        '''
                    }
                }
            }
        }
        stage("Start with new build") {
            steps {
                sh 'docker run --network="host" --name pokemon-api-appwise -d  appwise-pokemon-api'
            }
        }
    
        stage("Migrate and seed db") {
            steps {                
                    sh 'docker exec -i pokemon-api-appwise "php artisan migrate --force"'
                    catchError(buildResult: 'SUCCESS', stageResult: 'FAILURE') {sh 'docker exec -i pokemon-api-appwise "php artisan db:seed"'}
            }
        }
       
    }

}

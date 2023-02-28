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
                sh '''
                    catchError(buildResult: 'SUCCESS', stageResult: 'FAILURE') {docker exec -it pokemon-api-appwise sh -c "php artisan migrate --force"}
                    docker exec -it pokemon-api-appwise sh -c "php artisan db:seed"
                
                '''
            }
        }
       
    }

}

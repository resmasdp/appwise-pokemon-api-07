#clear everything
docker rm -f $(docker ps -a -q)

#run mysql server on host in container
docker run --network="host" --name mysql-appwise -e MYSQL_ROOT_PASSWORD=secret -d mysql:latest


#build application from application folder 
docker build -t appwise-pokemon-api .

#stop
docker stop pokemon-api-appwise
docker rm pokemon-api-appwise

#run 
docker run --network="host" --name pokemon-api-appwise -d  appwise-pokemon-api

#php artisan migrate and seed
docker exec -it pokemon-api-appwise sh -c "php artisan migrate --force"
docker exec -it pokemon-api-appwise sh -c "php artisan db:seed"
 
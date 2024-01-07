1) Міняємо назву .env.example на .env і там уже будуть необхідні налаштування
2) docker-compose up --build
3) Заходимо в контейнер php-fpm. Команда: docker exec -it chat-test-task-fpm-1 sh
4) Там виконуємо команду bash start.sh 
 
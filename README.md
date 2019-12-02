# tictactoe-lumen
Проект представляет собой реализацию rest api для игры Крестики-нолики
Каждая клетка имеет свой Id.
<table class="wikitable">
<tbody><tr>
<td>1
</td>
<td>2
</td>
<td>3
</td></tr>
<tr>
<td>4
</td>
<td>5
</td>
<td>6
</td></tr>
<tr>
<td>7
</td>
<td>8
</td>
<td>9
</td></tr></tbody></table>

<h2>Методы</h2>
<h3>Создание игры</h3>
<b>Метод POST</b></br>
  url: http://127.0.0.1:8080/api/v1/game/
  </br>
<b>Параметры:</b></br>
  uid_x - id пользователя, который играет крестиками</br>  
  uid_o - id пользователя, который играет ноликами</br>
<b>Результат</b>
{
    "uid_x": "1",
    "uid_o": "2",
    "updated_at": "2019-12-02 17:06:11",
    "created_at": "2019-12-02 17:06:11",
    "id": 160
}</br>

<h3>Информация об игре</h3>
<b>Метод GET</b></br>
  url: http://127.0.0.1:8080/api/v1/game/?id=1
  </br>
<b>Параметры:</b></br>
  id - id игры</br>    
<b>Результат</b>
{
    "id": 1,
    "uid_x": 1,
    "uid_o": 2,
    "field1": 0,
    "field2": -1,
    "field3": -1,
    "field4": -1,
    "field5": -1,
    "field6": -1,
    "field7": 1,
    "field8": -1,
    "field9": -1,
    "last_uid": 2,
    "result": "process",
    "created_at": "2019-12-01 13:08:38",
    "updated_at": "2019-12-01 14:14:20"
}</br>
Если result win, то смотрится last_uid, он является победителем
Если result draw, то ничья
</br>

<h3>Сделать ход</h3>
<b>Метод POST</b></br>
  url: http://127.0.0.1:8080/api/v1/game/move
  </br>
<b>Параметры:</b></br>
  uid - id пользователя</br>  
  step - номер клетки</br>
  id - id игры</br>
<b>Результат</b>
{
    "id": 2,
    "uid_x": 1,
    "uid_o": 2,
    "field1": -1,
    "field2": 1,
    "field3": -1,
    "field4": -1,
    "field5": -1,
    "field6": -1,
    "field7": -1,
    "field8": -1,
    "field9": -1,
    "last_uid": "1",
    "result": "process",
    "created_at": "2019-12-01 13:42:49",
    "updated_at": "2019-12-02 17:10:57"
}</br>

<h1>Запуск</h1>
Для запуска нужно</br>
скопировать .env.example  в .env</br>
и выполнить команды</br>
docker-compose up</br>
docker exec -it tic-php-fpm composer install</br>
docker exec -it tic-php-fpm php artisan mirgate</br>

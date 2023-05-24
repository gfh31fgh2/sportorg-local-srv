# sportorg-local-srv
Local server for live results from SportOrg programm

Для настройки:
1) для pc/mac/raspberry выберите подходящие параметры для контейнера БД в файлу ".env"
2) помяняйте параметр DB_ROOT_PASSWORD - на любой другой пароль
3) помяняйте параметр DB_PASSWORD - на любой другой пароль
4) запустите docker-compose up -d 
5) импортируйте структуру БД (файл local_sport.sql в папке data)
6) поменяйте значение MDB_PASS в config.php на тот пароль, который вы до этого поставили в DB_PASSWORD

Если тестируете сервер локально, то зайдите в папку for_local_deploy - и здесь уже запускайте docker-compose up -d


# sportorg-local-srv
Local server for live results from SportOrg program
Локальный сервер, для получения "живых" результатов из программы SportOrg (программы необходимой для считывания и подсчета результатов по спортировному ориентированию)

Для настройки:
1) для pc/mac/raspberry выберите подходящие параметры для контейнера БД в файлу ".env"
2) помяняйте параметр DB_ROOT_PASSWORD - на любой другой пароль (это пароль от пользователя root)
3) помяняйте параметр DB_PASSWORD - на любой другой пароль (это пароль от пользователя local_sport)
4) помяняйте параметр TRUNCATE_PW - на любой другой пароль (это пароль для использования стирания базы)
5) запустите docker-compose up -d 
6) импортируйте структуру БД (файл local_sport.sql в папке data)
7) поменяйте значение MDB_PASS в config.php на тот пароль, который вы до этого поставили в DB_PASSWORD

Если тестируете сервер локально, то зайдите в папку for_local_deploy - и здесь уже запускайте docker-compose up -d


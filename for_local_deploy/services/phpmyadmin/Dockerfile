FROM phpmyadmin/phpmyadmin:latest

RUN echo -e "\
file_uploads = On\n \
memory_limit = 888M\n \
upload_max_filesize = 888M\n \
post_max_size = 888M\n \
max_execution_time = 600\n \
" > /usr/local/etc/php/conf.d/uploads.ini

# Restart Apache and MySQL every 3 days.
0 4 3-31/3 * * service httpd restart
1 4 3-31/3 * * service mysqld restart

# Clear login request records(rows&QRfiles) everyday.
5 0 * * * /usr/local/php/bin/php /var/www/html/casarover_2.0/artisan ywd:loginclean

# Backup DB everyday.

# TODO on DEV machine Backup OSS images every week.

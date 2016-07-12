# crontab -e (for root) ###############################################################################################

# Restart Apache and MySQL every 3 days.
0 4 3-31/3 * * service httpd restart
1 4 3-31/3 * * service mysqld restart


# crontab -e -u wenda (for wenda) #####################################################################################
# Clear login request records(rows&QRfiles) everyday.
5 0 * * * /usr/local/php/bin/php /var/www/html/casarover_2.0/artisan ywd:loginclean

# Backup DB and send mail to  everyday.
5 4 3-31/3 * * /usr/local/php/bin/php /var/www/html/casarover_2.0/artisan ywd:backup

# TODO on DEV machine Backup OSS images manually.

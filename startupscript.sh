sudo apt-get purge wolfram-engine -y
sudo apt-get clean
sudo apt-get autoremove -y
sudo apt-get remove --purge libreoffice* -y
sudo apt-get clean
sudo apt-get autoremove -y
sudo apt-get remove --purge wolfram-engine penguinspuzzle scratch dillo squeak-vm squeak-plugins-scratch sonic-pi idle idle3 netsurf-gtk netsurf-common -y
sudo apt-get autoremove -y

//tightvnc server

sudo apt-get install mariadb-server mariadb-client -y
sudo apt-get install apache2 -y
sudo apt-get install php5 libapache2-mod-php5 -y

sudo apt-get install php5-mysqlnd php5-curl php5-gd php5-intl php-pear php5-imagick php5-imap php5-mcrypt php5-memcache php5-pspell php5-recode php5-snmp php5-sqlite php5-tidy php5-xmlrpc php5-xsl -y

sudo service apache2 restart
sudo apt-get install php5-apcu -y
sudo service apache2 restart
sudo apt-get install phpmyadmin -y 

sudo apt-get install libcups2-dev libcupsimage2-dev git build-essential cups system-config-printer -y
//some file copying

//install chrome
sudo apt-get update
wget -qO - http://bintray.com/user/downloadSubjectPublicKey?username=bintray | sudo apt-key add -
echo "deb http://dl.bintray.com/kusti8/chromium-rpi jessie main" | sudo tee -a /etc/apt/sources.list
sudo apt-get update
sudo apt-get install chromium-browser -y

 sudo usermod -a -G lp root
 sudo usermod -a -G lp rishi
 sudo usermod -a -G lp pi
 
 sudo usermod -a -G www-data rishi
 sudo usermod -a -G www-data pi
 sudo usermod -a -G www-data root
 chmod -Rv 755 cache* /var/www/html/test/test/mrp
 sudo chgrp -R www-data /var/www
 sudo chmod -R g+w /var/www
 sudo find /var/www -type d -exec chmod 2775 {} \;
 sudo find /var/www -type f -exec chmod ug+rw {} \;
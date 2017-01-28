#!/bin/bash
#rsync -avz ~/rpiBackup/mrp/ root@192.168.43.177:/var/www/html/rishi/mrp/
rsync -avz ~/rpiBackup/mrp/ root@192.168.1.103:/var/www/html/
#rsync -avz ~/rpiBackup/mrp/ root@52.11.167.216:/root/mrp/
exit

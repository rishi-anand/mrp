#!/bin/bash
rsync -avz ~/rpiBackup/mrp/ root@192.168.0.253:/var/www/html/rishi/mrp/
exit

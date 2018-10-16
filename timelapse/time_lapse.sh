#!/bin/bash

day=`date +%Y-%m-%d`
path=/home/pi/beward/penta/$day/beward_penta/1
cp rename $path/rename
cd $path/
./rename
avconv -y -r 10 -i %06d.jpg -r 10 -vcodec mjpeg -qscale 1  timelapse.avi


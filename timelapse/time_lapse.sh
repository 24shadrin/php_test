#!/bin/bash

day=`date +%Y-%m-%d`
path=/home/pi/beward/penta/$day/beward_penta/1

#pr=`ps auxww |grep "time_lapse.sh" | wc -l`
pr=`ps aux |grep "time_lapse.sh" |grep "/bin/bash" | wc -l`

#echo $pr
#echo $$

if [ $pr -gt 2 ]; then
    {
    echo "time lapse alredy running. Please wait and try again later"
    }
else
{
cp rename $path/rename
code_cp=$?
#echo $code_cp

cd $path/
code_cd=$?
#echo #code_cd

./rename > /dev/null
code_rename=$?
#echo $code_rename

#avconv -y -r 10 -i %06d.jpg -r 10 -vcodec mjpeg -qscale 1  timelapse.avi
code_avconv=$?
#echo $code_avconv

#echo "loading"
#sleep 10
#echo "OK exit"

    let "total = code_cp + code_cd + code_rename + code_avconv"
if [ $total -eq 0 ]; then
    echo "everything is OK"
else
    echo "something went wrong"
fi
echo $total
}

fi
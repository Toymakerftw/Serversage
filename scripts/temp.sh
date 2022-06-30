FILE=/sys/class/hwmon/hwmon4/temp1_input
if [[ -f "$FILE" ]]; then
cputemp="$(</sys/class/hwmon/hwmon4/temp1_input)"
temps=$(($cputemp/1000))
    echo "$temps "
else
    echo "No Data"
fi

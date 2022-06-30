let upSeconds="$(/usr/bin/cut -d. -f1 /proc/uptime)"
let mins=$((${upSeconds}/60%60))
let hours=$((${upSeconds}/3600%24))
let days=$((${upSeconds}/86400))
if [[ ${days} == 0 ]]; then
    UPTIME=`printf "%02d hrs %02d mins" "$hours" "$mins"`
else
    UPTIME=`printf "%d days %02d hrs %02d mins" "$days" "$hours" "$mins"`
fi
    echo -e "${UPTIME}"

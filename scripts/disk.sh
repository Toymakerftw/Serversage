used_disk=$(df /dev/sda1 | grep /dev/sda1 | awk '{printf "%d\n", $3 / 1000000 }')
total_disk=$(df /dev/sda1 | grep /dev/sda1 | awk '{printf "%d\n", $4 / 1000000 }')

echo -e "${used_disk} GB \n${total_disk} GB"

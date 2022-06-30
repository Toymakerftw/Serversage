cpu_usage=$(top -bn1 | grep load | awk '{printf "%.2f%%\t\t\n", $(NF-2)}')
echo -e "${cpu_usage}"

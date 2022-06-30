used_memory=$(free | grep Mem | awk '{printf "%d\n", $3 / 1024 }')
total_memory=$(free | grep Mem | awk '{printf "%d\n", $2 / 1024 }')
free_memory=$(free | grep Mem | awk '{printf "%d\n", $7 / 1024 }')
memory_usage_percent=$(free | grep Mem | awk '{printf "%d\n", $3/$2 * 100}')
memory_free_percent=$(free | grep Mem | awk '{printf "%d\n", $7/$2 * 100}')

    echo -e "${used_memory} MB \n${total_memory} MB \n(${memory_usage_percent}%) \n${free_memory} MB"

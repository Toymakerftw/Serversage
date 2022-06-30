lscpu | grep 'Model name' | cut -f 2 -d ":" | awk '{$1=$1}1'

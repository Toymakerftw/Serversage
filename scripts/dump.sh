array=("$@")
#echo $array;
rm -rf dump/dump.pcap
dump=($(tcpdump -i any host $array -c 5 -w dump/dump.pcap))
#len=${#dump[@]}
#for (( i=0; i<$len; i++)); do
#echo "${dump[$i]}"
#done


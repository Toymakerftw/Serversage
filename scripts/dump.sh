array=("$@")
dump=($(tcpdump -v -i wlo1 host 192.168.190.111 -c 5 -w dump.pcap))
len=${#arp[@]}
for (( i=0; i<$len; i++)); do
echo "${dump[$i]}"
done


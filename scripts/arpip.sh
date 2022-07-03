ip=$(ifconfig | grep 255.255 | awk '{print $2}')
nip=$(sed 's/.\{3\}$//' <<< "$ip")
arp=($(arp -a | grep $nip | awk '{print $2}' | sed 's/)//' | sed 's/(//'))
len=${#arp[@]}
for (( i=0; i<$len; i++)); do
echo "${arp[$i]}"
done


ip=$(ifconfig | grep 255.255 | awk '{print $2}')
nip=$(sed 's/.\{3\}$//' <<< "$ip")
echo "$nip""*"

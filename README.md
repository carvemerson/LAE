#usage

add this command to your crontab

curl -X GET "http://10.9.98.189:8000/ping?name=$(hostname)&uptime=$(uptime -s | sed 's/[-, ,:]//g')"

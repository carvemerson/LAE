(crontab -l 2>/dev/null; echo '*/1 * * * * curl -X GET "https://laemachine.000webhostapp.com/ping?name=$(hostname)&uptime=$(uptime -s | sed 's/[-, ,:]//g')"
') | crontab -
echo "Success!!"
# How to prepare the host computers
_____

## On Linux 
* Install **curl**
* Open terminal (ctrl+alt+t)
* Execute this command to open the crontab: (sudo is needed)
```terminal
crontab -e
```
* Goto the end of file and add this command:

```
*/1 * * * * curl -X GET "SITE_URL/ping?name=$(hostname)&uptime=$(uptime -s | sed 's/[-, ,:]//g')"
```
*
  * Replace SITE_URL by the site root URL.
  * Root is needed
* Save the file
* Close the Terminal
* Host machine configuration done!!

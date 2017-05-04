# How to prepare the host computers
_____

## On Linux 
* Open terminal (ctrl+alt+t)
* Install **curl** (if you don't have)
* Open the crontab in edit mode (sudo is required)
```terminal
sudo crontab -e
```
* Goto the end of file and add this command:

```
*/1 * * * * curl -X GET "PUT_URL_HERE?name=$(hostname)&uptime=$(uptime -s | sed 's/[-, ,:]//g')"
```
*
  * Replace PUT_URL_HERE by the site link.
* Save the file
* Close the Terminal
* Host machine configuration done!!



Murmur - Yammer feeds reimagined
================================

This is an experiment to see how [Yammer](https://web.yammer.com/) feeds could be grouped together to create more relevant streams of information.

Feeds
-----
The web frontend offers a variety of streams and possibilities of configuring them:

`[IMAGE]`

* **All** - corresponds the "All conversations" in the Yammer web interface
* **Discovery** - lets users discover people and groups that may be interesting to them, suggested by an undisclosed algorithm
* **Following** - shows news from groups and people the user is following on Yammer
* **Grouped** - shows all followed groups and merges select groups' streams together
* **Questions** - as above, but filtered to only include questions
* **Topics** - like *Grouped* view, but based on Yammer topics rather than groups

Integrating with your AAD
-------------------------
To run the software, you need to create an application in the [Azure Portal](https://portal.azure.com/).

First, add the redirect URI you'll be running the service at, e.g. `http://localhost/`:

`[IMAGE]`

Then, add a client secret and note that value:

`[IMAGE]`

Last but not least, be sure to add the Yammer impersonation permission:

`[IMAGE]`


Running the software
--------------------
The software is dockerized. The application (client) ID, directory (tenat) ID as well as the client secret need to be passed via environment variables as follows:

```bash
$ docker run -it -p 80:8080 \
  -e OAUTH_CLIENT='...' \
  -e OAUTH_SECRET='...' \
  -e OAUTH_TENANT='...' \
  -e SERVICE_URL='http://localhost/' \
  thekid/murmur:latest 
```
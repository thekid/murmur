Murmur - Yammer feeds reimagined
================================

This is an experiment to see how [Yammer](https://web.yammer.com/) feeds could be grouped together to create more relevant streams of information.

Feeds
-----
The web frontend offers a variety of streams and possibilities of configuring them:

![Screenshot Murmur/Home](https://user-images.githubusercontent.com/696742/103903450-310f5080-50fc-11eb-9adf-692c0cfe084f.png)

* **All** - corresponds the "All conversations" in the Yammer web interface
* **Discovery** - lets users discover people and groups that may be interesting to them, suggested by an undisclosed algorithm
* **Following** - shows news from groups and people the user is following on Yammer
* **Grouped** - shows all followed groups and merges select groups' streams together
* **Questions** - as above, but filtered to only include questions
* **Topics** - like *Grouped* view, but based on Yammer topics rather than groups

All feed items are shown in a card form, with an excerpt of the content. The following post types are highlighted:

* **Announcement** - with an orange icon
* **Praise** - with a pink heart icon showing the recipient(s)
* **Poll** - with a yellow chart icon showing the poll's options and current outcome
* **Questions** - with a range from blue until green: questions without answers, questions with answers, questions where a "best answer" has been selected

Posts in feed views may be grouped and sorted.

Live events
-----------
Currently running public live events are shown on the application's front page. When drilling down into a group, the software is able to show scheduled, running as well as past live events:

![Screenshot Murmur/Group](https://user-images.githubusercontent.com/696742/103905268-b136b580-50fe-11eb-94f7-418be227c185.png)


Integrating with your AAD
-------------------------
To run the software, you need to create an application in the [Azure Portal](https://portal.azure.com/). Go to "App registrations" and add a new application.

First, add the redirect URI you'll be running the service at, e.g. `http://localhost/`:

![Redirect URL](https://user-images.githubusercontent.com/696742/103903820-af6bf280-50fc-11eb-8324-268b97f11ab7.png)

Then, add a client secret and note that value:

![Client secret](https://user-images.githubusercontent.com/696742/103904067-112c5c80-50fd-11eb-8ed2-843967a9e369.png)

Last but not least, be sure to add the Yammer impersonation permission:

![API permissions](https://user-images.githubusercontent.com/696742/103903691-80558100-50fc-11eb-89ca-f9bb1bf6c923.png)


Running the software
--------------------
The software is dockerized. The application (client) ID, directory (tenant) ID as well as the client secret need to be passed via environment variables as follows:

```bash
$ docker run -it -p 80:8080 \
  -e OAUTH_CLIENT='...' \
  -e OAUTH_SECRET='...' \
  -e OAUTH_TENANT='...' \
  -e SERVICE_URL='http://localhost/' \
  thekid/murmur:latest 
```

Murmur - Yammer feeds reimagined
================================

[![Test status on GitHub](https://github.com/thekid/murmur/workflows/Tests/badge.svg)](https://github.com/thekid/murmur/actions)
[![Build status on GitHub](https://github.com/thekid/murmur/workflows/Build/badge.svg)](https://github.com/thekid/murmur/actions)
[![Built with PHP 8.0](https://raw.githubusercontent.com/xp-framework/web/master/static/php-8_0plus.svg)](http://php.net/)

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

Grouping
--------
Grouping messages is done to create a "cleaner" feed. There are two methods - **by adjacent** which groups adjacent messages in the same group by the same author and the more "greedy" **by author**, which simply groups all posts in a feed by a given person.

![Grouping](https://user-images.githubusercontent.com/696742/103909787-63bd4700-5104-11eb-9176-7e95a4080248.png)

Live events
-----------
Currently running public live events are shown on the application's front page. When drilling down into a group, the software is able to show scheduled, running as well as past live events:

![Screenshot Murmur/Group](https://user-images.githubusercontent.com/696742/103905268-b136b580-50fe-11eb-94f7-418be227c185.png)


A word on Yammer's API
----------------------
The official "v1" Yammer API is incomplete and horribly slow: Fetching the newest 20 or so messages from a feed comes in at somewhere between 2.5 and 6.5 seconds, depending on payload and whether we're aggregating replies or not. By reverse engineering the new Yammer frontend, I've been able to discover their new API based on GraphQL, which is undocumented but *much* faster - the same feed requests clock in at 1.2 to 1.8 seconds. The freedom you might suspect GraphQL could give us is (understandly) limited by using [persisted queries](https://www.apollographql.com/blog/persisted-graphql-queries-with-apollo-client-119fd7e6bba5/). This means `n` queries for `n` feeds, so when merging feeds, this work is done asynchronously via `fetch` in the frontend to not overstress users' patience.


Integrating with your AAD
-------------------------
To run the software, you need to create an application in the [Azure Portal](https://portal.azure.com/). Go to "App registrations" and add a new application.

1. Add the redirect URI you'll be running the service at, e.g. `http://localhost/`:
   ![Redirect URL](https://user-images.githubusercontent.com/696742/103903820-af6bf280-50fc-11eb-8324-268b97f11ab7.png)
2. Then, add a client secret and note that value:
   ![Client secret](https://user-images.githubusercontent.com/696742/103904067-112c5c80-50fd-11eb-8ed2-843967a9e369.png)
3. Last but not least, be sure to add the Yammer impersonation permission:
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

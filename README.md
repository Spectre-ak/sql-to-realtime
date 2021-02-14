# sql-to-realtime
adding event listeners on SQL database and providing real time updates  

[two way chatting using sql database](https://github.com/Spectre-ak/sql-to-realtime/tree/main/two%20way%20chatting%20using%20sql%20database) directory contains simple approach for chatting in real time using sql database, where the key concept is to use js setinterval and in each interval make a request to the server and retrieve the new data. In each request after retrieving message the table is truncated from where message is queried. For sending messages the two users/page uses two separate tables. Code for that [->](https://github.com/Spectre-ak/sql-to-realtime/blob/main/two%20way%20chatting%20using%20sql%20database/f1Script.php)

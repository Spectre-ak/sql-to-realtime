# sql-to-realtime
adding event listeners on SQL database and providing real time updates  

### 1. Using setInterval JavaScript and ajax(post request) (<i>client dependent</i>)
[two way chatting using sql database](https://github.com/Spectre-ak/sql-to-realtime/tree/main/two%20way%20chatting%20using%20sql%20database) directory contains simple approach for chatting in real time using sql database, where the key concept is to use js setinterval and in each interval make a request to the server and retrieve the new data. In each request after retrieving message the table is truncated from where message is queried. For sending messages the two users/page uses two separate tables. Code for that [->](https://github.com/Spectre-ak/sql-to-realtime/blob/main/two%20way%20chatting%20using%20sql%20database/f1Script.php)

How to use:

Clone [two way chatting using sql database](https://github.com/Spectre-ak/sql-to-realtime/tree/main/two%20way%20chatting%20using%20sql%20database) and create two table in the sql database dbo.f1 & dbo.f2. Then open the [front1](https://github.com/Spectre-ak/sql-to-realtime/blob/main/two%20way%20chatting%20using%20sql%20database/front1.html) and [front2](https://github.com/Spectre-ak/sql-to-realtime/blob/main/two%20way%20chatting%20using%20sql%20database/front1.html) pages and begin chat.
or you can use these cpanel hosted sites [front1](http://triton.byethost7.com/testing/front1) & [front2](http://triton.byethost7.com/testing/front2)


### 2. Using server sent events SSE (<i>server dependent</i>)
SSE can be used in sending real time updates form the server to the clients on some regular intervals.

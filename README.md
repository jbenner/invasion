=========================
    Pensive Invasion
=========================

Welcome to Pensive Invasion. This is a multiplayer web-based game
similar to many classic strategy board games.

The object of Invasion is simple: control all territories on the map.
Territories are currently 4 'Networks', each housing 6 'Servers'.
Network control is awarded by capturing all connected Servers.

In order to capture a Server a player must have one or more 'Nodes' on
that Server. Only one player may control a Server at any given time.


=========================
     Version History
=========================

v0.0.1: Symfony2 framework setup and database entities created. Basic
CSS for Networks, Servers, and Nodes. Route for game based on ID. Route
for initial game setup created - if the game board is empty, populates
the game board with Networks from the database according to Name, Size,
and Location information.
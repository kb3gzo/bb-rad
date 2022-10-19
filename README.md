# About

daloRADIUS (http://www.daloradius.com) is an advanced RADIUS web management application aimed at managing hotspots and
general-purpose ISP deployments.

daloRADIUS is written in PHP and JavaScript and utilizes a database abstraction
layer which means that it supports many database systems, among them the popular
MySQL, PostgreSQL, Sqlite, MsSQL, and many others.

It is based on a FreeRADIUS (http://www.freeradius.org) deployment with a database server serving as the backend.



# Features

## Management
### User Management

    * List Users
    * Create New User
    * Create New User - Quick add
      easy to use for POS or HotSpot shops
    * Edit User
    * Search User
    * Delete User


## NAS Management

    * List NAS
    * Create New NAS
    * Edit NAS
    * Delete NAS


## Groups Management

    * List, Create New, Edit and Delete User-Groups Mapping
      usergroup table in radius database
    * List, Create New, Edit and Delete Group-Reply and Group-Check Settings
      radgroupreply and radgroupcheck tables in radius database for managing group-wide attributes


## Accounting
### Users Accounting By

    * Username
    * IP Address
    * NAS IP Address
    * Date (From/To)
    * Display of All Accounting records
      the entire content of the radacct table in the radius database
    * Display of Active Accounting records
      performed by an algorithm implemented by daloRADIUS itself to calculate if
      an account has expired or not based on it's Max-All-Session attribute or Expiration attribute
	* Custom Accounting Query


## Reporting

### Basic Reporting

    * Online Users
      View Online users, users that are connected to the system from all NASes at a current
      point in time.
    * Last Connection Attempts
      View last connection attempts and their status - whether they were rejected or successful
    * Search Users
      Search for Users - similar to the functionality in User Management page
    * Top Users
      View a report of the Top Users based on their Bandwidth consumption or Time usage


### Logs Reporting

    * daloRADIUS Log
      daloRADIUS keeps a log file for all the actions it performs itself (viewing pages,
      form actions like deleting users, creating new hotspots, queries submission as in
      performing user accounting and more)
    * RADIUS Server Log
      Provides monitoring of the freeradius server logfile
    * System Log
      Provides monitoring of the system log, being syslog or messages, depends.
    * Boot Log
      Provides monitoring of the boot/kernel log (dmesg)


### Status Reporting

    * Server Status
      Provides detailed information on the server daloRADIUS is deployed.
      Information such as CPU utilization, uptime, memory, disks information, and more.
    * RADIUS Status
      Provides information whether the freeradius server is running along with the database
      server (mysql, postgresql, or others)


## Graphs

### Users Graphs
Provides visual graphs and statistical listing per user connection's attributes, being:

    * Logins/Hits
    * Download
    * Upload


### Server-Wide Graphs
Provides visual graphs and statistical listing for the entire server, all-time information on:

    * Logins/Hits
    * Traffic Comparison


## Configuration

### Global Configuration

    * Database Settings
      Database connection information (storage: mysql, postgresql and others),
      credentials (username and password), radius database tables names (radcheck, radacct, etc),
      and database password encryption type (none, md5, sha1)
    * Language Settings
      daloRADIUS is multi-lingual and supports currently English and Russian language packs
    * Logging Settings and Debugging
      Logging of different actions, queries and page visiting performed on different pages.
      Also supports debugging of SQL queries executed.
    * Interface Settings
      Support for displaying password text in either clear-text or as asterisks to hide it.
      Table listing spanning across multiple pages is configurable on number of rows per page
      and addition of numbers links for quick-access to different pages.


### Maintenance

    * Test User Connectivity
      Provides the ability to check if a user's credentials (username and password) are valid by
      executing a radius query to a radius server (configurable for radius port, shared secret, etc)
	* Disconnect User
	  Supply a username and send a PoD (Packet of Disconnect) or CoA (Change of Authority) packet
	  to the NAS to disconnect the user.

### Operators

daloRADIUS supports Operators for complete management of the entire platform.
Different Operators can be added with their contact information and ACLs settings to
grant or revoke them of permissions to access different pages.

    * List Operators
    * Create New Operator
    * Edit Operator
    * Delete Operator

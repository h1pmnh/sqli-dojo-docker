# sqli-dojo-docker

A demo PHP application by [@pmnh](https://www.pmnh.site) used to exercise SQL injection techniques in a safe, local Docker environment. The purpose of this application is to allow ethical security researchers to test their skills in a variety of real-world scenarios including different payload types and injection points, with the option to apply restrictions simulating WAF or server-side filtering. We've based many of these scenarios and suggested server-side filters on actual scenarios found in many hundreds of SQL injections found during bug bounty and penetration testing. We hope you find this helpful and encourage your feedback and/or praise, either privately or publicly.

# Obligatory WARNING

This application is intentionally vulnerable to SQL injection and possibly other vulnerabilities. **Do not deploy this application to an internet-facing server** or you face the very real risk that the container will be compromised. The author expressly disclaims any and all responsibility for misuse of this application and/or improper and insecure deployment on a public server.

Please note, this application is created for educational purposes only.

 * Do not use it to perform malicious or illegal activities.
 * Do not perform SQL injection or similar attacks on targets that you do not have explicit permission to attack, either through a vulnerability disclosure program or a penetration testing agreement.
 * Testing targets which you do not have permission to attack could be against the law and in many countries end up in severe legal or civil trouble.

# License

We are licensing this under GPL v3, specifically to disallow commercial use (i.e. someone taking this code and creating a paid service, which is not our intention for this project and is expressly forbidden without permission).

# Requirements

 * Docker
 * Docker Compose v2

Please note, we have tested this on Windows and Linux, if you encounter any platform-specific issues please open a GitHub issue with whatever information you have.

# Getting Up and Running

 * Clone this repository.
 * From the repository root, run `docker compose up` - after some time you will be able to access the application on [http://localhost:8081/](http://localhost:8081/). (Note we use port 8081 to not conflict with Burp Proxy's default of 8080 and make it easier for beginners).
  * Please note, the initial startup (building the MySQL database) will take some 1-2 minutes, even on a fast PC - subsequent startup will be faster.
 * Browse the application and start trying to perform SQL injection on the pages you find.

# Scenarios

The scenarios built into the dojo are generally grouped into the following categories:

 * Traditional Forms - form-based GET/POST type applications with a variety of injection points and injection types
 * Non-Traditional Forms - forms with payloads that are unusual or nested, usually requiring some tweaks or advanced sqlmap usage to get a simple injection working
 * APIs - API-like interactions which are intended to represent behavior that emulates typical APIs - note that the implementations may not exactly match a real API e.g. our "SOAP" example is not a full SOAP implementation

# Filters

Filters are the main purpose of this application! Running your tests against the default, very easy, settings, you are unlikely to learn much about SQL injection in the real world!

The application allows you to (optionally) configure a set of characters (such as `<>`) and/or words/phrases (such as `AND`) which will be "blocked" by the server. In reality we are simply stripping these from any user-supplied parameters. This can be used to simulate more challenging scenarios that are encountered in the real world. The "edit filters" pages provide some baked-in suggestions at various difficulty levels but we encourage the community to make and suggest other challenging combinations.

We encourage you to add filters that block certain techniques and force you to consider others, for example try to block `SLEEP` to prevent time-based SQL injection. Block `;` to prevent stacked queries! The options are limited only by your imagination and creativity, and desire to experience more challenging scenarios.

# Clearing Data

The database is built in the directory `mysql-data` - if you want to start over for whatever reason, just:

 * Stop the running docker compose project
 * Remove the directory
 * Start the docker compose project

# Other Resources

There are many resources to learn about SQL injection attacks, I have tried to add some here, please note I can't vouch for the content or quality of these resources:

Docker Containers:
 * [https://github.com/thomaslaurenson/startrek_payroll](https://github.com/thomaslaurenson/startrek_payroll): Simple application with several intentional vulnerabilities

Online Resources (most require registration):
 * [TryHackMe SQL Injection Lab](https://tryhackme.com/room/sqlilab)
 * [PortSwigger Web Academy](https://portswigger.net/web-security/sql-injection)

# Reporting Issues

Please use the Github issue tracker to report issues with the container, or make reasonable feature requests.

Please *do not* use the issue tracker to ask for help on exploiting SQL injections, such issues will be closed immediately without response. Instead, we would encourage asking your scenario in a community where you are more likely to get many eyeballs, either on Twitter/X or one of the many suitable Discord servers that cover this type of issue. Feel free to reference our project and any specific configurations when asking for help in these other forums.

# To-Do

These aren't done yet!

 * INSERT statement, middle parameter
 * injection in stored proc invocation
 * Real SOAP
 * Injection on error pages e.g. 500 or the like
 * Character limit e.g. 64 characters
 * 2nd order into PDF, into CSV, into ZIP?
 * case sensitive / insensitive
 * add a docker-compose configuration with mod_security
 * header-based injection
 * cookie-based injection

Other enhancements (meta)

* For the challenges, try to mention a goal, for example:
  - List all the users (maybe a flag as hidden user)
  - Discover other tables (maybe putting a kind of flag in another table)
  - Read system file (ex /etc/passwd or a flag)
  - Execute system commands and retrieve the flag
 * It is good that you put the sqlmap command, but it would be even better if you put some manual hints as well. Like this people will practice their manual skills instead of automated tools.
 * Maybe in some future version there could be a page like in DVWA to change the settings via a drop-down.

# Contributing

If you'd like to contribute, please fork the repository and create a pull request. If you're planning to put a lot of work in, please raise an issue first so we can talk about it. Thank you!

# Forking

Although you're welcome to fork the project I would prefer if this remains the canonical fork at [https://github.com/h1pmnh/sqli-dojo-docker](https://github.com/h1pmnh/sqli-dojo-docker) so that people can know where to get the most updated set of use cases and features!


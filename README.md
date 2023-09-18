# sqli-dojo-docker

A demo PHP application used to exercise SQL injection techniques in a safe, local Docker environment. The purpose of this application is to allow ethical security researchers to test their skills in a variety of real-world scenarios including different payload types and injection points, with the option to apply restrictions simulating WAF or server-side filtering.

# Requirements

 * Docker
 * Docker Compose v2

# Warning

This application is intentionally vulnerable to SQL injection and possibly other vulnerabilities. Do not deploy this application to an internet-facing server or you face the very real risk that the container will be compromised.

# Getting Started - Docker

 * Clone the repository
 * From the repository root, run `docker-compose up` - after some time you will be able to access the application on [http://localhost:8080/](http://localhost:8080/).
  * Please note, the initial startup (building the MySQL database) will take some 1-2 minutes, even on a fast PC - subsequent startup will be faster.

## To-Do


IN clause
INSERT statement, middle parameter
injection in stored proc invocation
SOAP?
multi-field injection e.g. WHERE (inj = inj2) with paren filter

keyword filtering (SELECT, FROM)
injection on error pages e.g. 500 or the like

character limit e.g. 64 characters

2nd order into PDF, into CSV, into ZIP?




#!/bin/sh
mysql < sql/1-create-tables.sql
mysql < sql/2-insert-sample-data.sql
 
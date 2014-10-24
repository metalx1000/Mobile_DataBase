#!/bin/bash

echo "This will delete current setup."
echo  -n "Are you sure you want to continue? (y):"
read con

clear
echo "create a list of items you want in your form"
sleep 2
vim item.lst

if [ $con = "y" ]
then
    rm submit.js.php
    rm post.js.php
    rm done.js.php
    rm get.js.php
    rm content.js.php
    rm post.esc.php
    rm sql.entry.php
    rm create.table.php

   
    echo "<?php" >> post.esc.php

    cat item.lst|while read line
    do
        echo "var $line=\$(\"#$line\").val();" >> submit.js.php
        echo "$line: $line," >> post.js.php
        echo "\$(\"$line\").val('');" >> done.js.php
        echo "var $line=data[i].$line;" >> get.js.php
        echo "<label>$line:</label>" >> content.js.php
        echo "<input type=\"text\" id=\"$line\" placeholder=\"$line\">" >> content.js.php
        echo "\$$line = mysqli_real_escape_string(\$con, \$_POST['$line']);" >> post.esc.php
    done


    echo "?>" >> post.esc.php

    echo "<?php" >> sql.entry.php
    echo -n "\$sql=\"INSERT INTO \$table (" >> sql.entry.php
    cat item.lst|while read line
    do
        echo -n "${line}, " >> sql.entry.php
    done

    echo -n ") VALUES (" >> sql.entry.php
    cat item.lst|while read line
    do
        echo -n "'\$$line', " >> sql.entry.php
    done
    echo ")\";">> sql.entry.php

    echo "?>" >> sql.entry.php

    sed -i 's/, )/ )/g' sql.entry.php


# Create table
    echo "<?php" >> create.table.php
    echo "\$sql = \"CREATE TABLE \$table(" >> create.table.php
    echo "PID INT NOT NULL AUTO_INCREMENT," >> create.table.php
    echo "PRIMARY KEY(PID)," >> create.table.php
    cat item.lst|while read line
    do
        echo "$line CHAR(100)," >> create.table.php
    done
    echo "key_id CHAR(30)" >> create.table.php
    echo ")\";">>create.table.php
    echo "?>" >> create.table.php

    echo -n "Table Name: "
    read table
    echo "<?php \$table=\"$table\";?>" > table.php
else
    echo "exiting..."
    exit 0
fi 

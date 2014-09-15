#!/bin/bash

echo "This will delete current setup."
echo  -n "Are you sure you want to continue? (y):"
read con

if [ $con = "y" ]
then
    rm submit.js.php
    rm post.js.php
    rm done.js.php
    rm get.js.php
    rm content.js.php
    rm post.esc.php
    rm sql.entry.php

    cat item.lst|while read line
    do
        echo "var $line=\$(\"#$line\").val();" >> submit.js.php
        echo "$line: $line," >> post.js.php
        echo "\$(\"$line\").val('');" >> done.js.php
        echo "var $line=data[i].$line;" >> get.js.php
        echo "<label>$line:</label>" >> content.js.php
        echo "<input type=\"text\" id=\"$line\" placeholder=\"$line\">" >> content.js.php
        echo "\$$line = mysqli_real_escape_string($con, $_POST['$line']);" >> post.esc.php
    done

    echo -n "\$sql=\"INSERT INTO \$table (" >> sql.entry.php
    cat item.lst|while read line
    do
        echo -n "${line}, " >> sql.entry.php
    done

    echo -n ") VALUES (" >> sql.entry.php
    cat item.lst|while read line
    do
        echo -n "'$line', " >> sql.entry.php
    done
    echo ")\";">> sql.entry.php

    sed -i 's/, )/ )/g' sql.entry.php
else
    echo "exiting..."
    exit 0
fi 

<?php

$output = shell_exec('ls');
echo "ls output:<pre>$output</pre>";

$output = shell_exec('ps');
echo "ps output:<pre>$output</pre>";

$output = shell_exec('whoami');
echo "whoami output:<pre>$output</pre>";

$output = shell_exec('id');
echo "id output:<pre>$output</pre>";

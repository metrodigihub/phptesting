$cats =~ s{[^a-z0-9]}{((ord($&)>=127)?"&#x".sprintf("%04X",ord($&)).";":"$&")}ige;

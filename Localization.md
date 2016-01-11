## Introduction ##

Here we can list issues related to localization.

## Language Files ##
These are stored in `application/language/english(etc)/<controllername>_lang.php`

An example language file:
```
<?php
$lang['sitetitle'] = "Bethel Translations";
?>
```

## Literals ##
So first to mention is don't use string literals, we use tokens (from the language file) instead
here's an example
```
example.php
<html>

    <head>
        <title>{title}</title>
    </head>
    
    <body>
        <h1>{title}</h1>
        <p>{description}</p>
        <a href="">{homepage}</a>
    </body>
    
</html>
```
## Loading language files ##
Call this in the constructor of the controller - first issue is how to control the actual language choice via country flags
```
        # Load language
        $sesslang = 'english';
        $this->lang->load('example', $sesslang);
```
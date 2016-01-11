# Database Model #
_Tank auth tables omitted for clarity_

## Tables ##

**Customer**
> -customerID: int(11) NOT NULL AUTO\_INCREMENT

> -fullName: text NOT NULL

> -title: enum('Mr','Mrs','Ms') NOT NULL

> -email: text NOT NULL

> -active: tinyint(1) NOT NULL default '0'

> -referenceStr` varchar(8) NOT NULL

> -PRIMARY KEY  (`customerID`)


**Jobs**
> -jobID` int(11) NOT NULL AUTO\_INCREMENT

> -customerID` int(11) NOT NULL

> -statusenum('QuoteReq','QuoteSent','QuoteAccept','QuoteDeclined','Paid','Translated','Complete') NOT NULL

> -quote int(10) NOT NULL

> -dateRequested` date NOT NULL

> -dateDue` date NOT NULL

> -fromLanguage` text NOT NULL

> -toLanguage` text NOT NULL

> -PRIMARY KEY  (`jobID`)

> -KEY `idx_jobs` (`customerID`)

**Translation**
> -translationID` int(11) NOT NULL AUTO\_INCREMENT

> -jobID` int(11) NOT NULL

> -origDoc` int(11) NOT NULL

> -translatedDoc` int(11) NOT NULL

> -PRIMARY KEY  (`translationID`)

> -KEY `idx_translation` (`jobID`)

> -KEY `idx_translation_1` (`origDoc`)

> -KEY `idx_translation_2` (`translatedDoc`)

**Document**
> -documentID` int(11) NOT NULL AUTO\_INCREMENT

> -filePath` varchar(256) NOT NULL

> -PRIMARY KEY  (`documentID`)


## First changes ##
-Removed **Notes** table since we have yet to think about how we are going to implement our Notification system. I think this is better done using SQL queries of the tables above, but let me know what you guys think.

-Removed **urgency** column in **Jobs** table. I think Joelle made clear at the last meeting that she didn't want the system to control any kind of priority jobs or discounts etc, and that she would negotiate it through email.

**Update 22/1** I've checked the most recent processes from user registration and job submission to job completion and can't fault the schema above. (although someone else should check this through, too)

## ER Diagram ##

_Created using [cacoo.com](https://cacoo.com/diagrams/QdXf2xFjGydDz7GH)_

![https://lh3.googleusercontent.com/-w1qwx2n8PU0/Tx38kgO3_QI/AAAAAAAAJnI/iUtoGnSQ0xg/s839/Andrei%252527s%252520attempt.png](https://lh3.googleusercontent.com/-w1qwx2n8PU0/Tx38kgO3_QI/AAAAAAAAJnI/iUtoGnSQ0xg/s839/Andrei%252527s%252520attempt.png)


### Models ###
#### Job ####
  * add\_new\_job()
  * set\_quote(JobID)
  * get\_all\_pending()
  * ...
  * get\_pending(customerID)
  * set\_status(JobID)

#### Translation ####
  * add\_source(JobID, origDoc)
  * add\_translation(JobID, sourceID)
  * get\_job\_translations(JobID)
  * get\_job\_sources(JobID)

#### Files ####
  * add\_file()
  * get\_file(fileID)
# Process #

### Job statuses ###
not sure if I got these right, so could someone check and update if necessary, please?
  * Quote pending
  * Quote sent
  * Quote accepted, wait to pay
  * Quote accepted, paid
  * Completed

[Flowchart](http://goo.gl/NwMVz)

![https://lh6.googleusercontent.com/-3CgKnc7-H2Q/TxrkvehuLtI/AAAAAAAAJmY/gWUzh2Xop8s/s1038/Flowchart%252520%2525281%252529.png](https://lh6.googleusercontent.com/-3CgKnc7-H2Q/TxrkvehuLtI/AAAAAAAAJmY/gWUzh2Xop8s/s1038/Flowchart%252520%2525281%252529.png)

### Process description ###
```


↓ 


1.Input Name & E-mail 

2.Upload Files 

3.Set requirements 


↓ 

◇ Exist?→ "Please Input Sign-in" (input reference) → ◇ OK → Dashboard 

↓ 


Generate user reference 

↓ 


Add job to the DB 

↓ 


E-mail client notification to activate the account 

↓ 


E-mail Joelle 

↓ 


Notification (Joelle): Update "XXX has sent you a new job", etc. 

  * Button.Wait 
  * Button.Open: Documents list + requrements + word count + estimated price + is urgent?  + client information  

+ [Input]: Joelle's price & ETA & notes 

↓ 


Send Quote 

↓ 


Change status in DB to "Quoted" 

↓ 


E-mail client: Details + Link to the quote 

↓ 


Client Dashboard: 

  * Button.Accept: Chang to "Quote Accepted" → "You have X days to pay" 
  * Button.hold: Hold 
  * Button.Deny: Change the status to "Client Declined" 

Pay: Change to "Awating translation" 

↓ 


Translations:  

  * List all the jobs 
  * Upload translated documents + notes 
{{{
|----------------------------------------------------------| 
| Job No. xxx                                         Done | 
|     > Doc 1  …...                         Upload  Delete |
|     > Doc 2  …...                         Upload  Delete | 
      …... 
}}}
↓ 



Change to "Completed" 

↓ 


E-mail client 

```
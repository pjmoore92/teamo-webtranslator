## Quick FIX / TODO ##
~~?? LaTeX Error: File `bt-erdiag' not found~~

## FEEDBACK from Karen to be implemented before handin ##
Anything in emailed .pdfs (most grammar/spelling fixed) + the following...

  * ~~Before you submit make sure you check for broken refs. There is one on page 14. No problem for now, but it doesn’t look good in the final version~~

  * ~~P17 – perhaps use advertisement rather than presentation. Or even landing zone~~

  * ~~the er diagram should be in chapter 2 - that reflects the design of the database. By the way, my previous feedback about this diagram has not been incorporated so the diagram is still faulty.~~

  * In the implementation chapter you can list the relations stored in your database.. also put a bunch of screen shots in this chapter

  * in chapter 3 you've simply said "we used these tools" but you don't really provide justifications. Good if you can say why you chose the technologies (apart from - they are really cool) for example - why did you use a web app and not a java app. I know it sounds obvious but including it shows you thought about the different options

  * in the evaluation chapter remember to include two sections
  1. for the translator's evaluation
  1. for the other people you asked to evaluate it


---

## Topics ##

  * **Security**: Encrypting the PayPal buttons
    * What was the problem?
    * How did the HTML look like unencrypted?
    * How did we fix it?

  * **Testing**: [Selenium](http://seleniumhq.org/) ?
  * **VC**: [SQL source control](http://www.red-gate.com/products/sql-development/sql-source-control/)

  * bash script to automatically upload changes from the SVN
    * Why? we had the code on the repo, but connecting to the DB remotely was not possible (or difficult).

  * Joelles Taxes

## Tools ##
  * **balsamiq mockups**
    * Why? - easy to use; exports to XML, so it can be VC'd

## Implementation? ##
  * **Version Control**
    * we chose SVN, because BLAHBLAH
    * problems with it? YES, INDEEDY - if we had used a **DCVS**, like Hg or git, we wouldn't have had problems in the eventuality of a server error (just like tonight - **FUN**)
  * **Twitter Bootstrap** - CSS framework
    * pre-built UI components; UI design patterns;
    * quick UI prototype set-up;
    * pre-built JS components that we used to give a close feel of the UX
    * uses the [LESS](http://lesscss.org/) preprocessor, which makes changing the CSS far easier by making us of concepts like **variables**, **mixins**, etc., that don't exist in CSS. _In short, CSS violates the living crap out of the DRY principle. You are constantly and unavoidably repeating yourself._ ([Jeff Atwood - What's Wrong with CSS](http://www.codinghorror.com/blog/2010/04/whats-wrong-with-css.html))

  * **CodeIgniter** - PHP Framework
    * Why? lightweight, easy to configure, well documented
    * started with the registration system - used TankAuth, an auth library for CI, because it had the required functionalities, open source, using other people's work is good SE practice

  * **Browser compatibility**
    * Discuss challenges involved with making the site fully work with                    Internet Explorer (version 7 and upwards) - since we developed the website mainly with Mozilla Firefox and Google Chrome


## Transistion from development to production ##

Couple potential pages here.. could talk about the processes involved in moving from a testing environment on Alasdairs server to Joelles own server and the changes we had to make etc. There is plenty of stuff from PSD textbook/lectures to provide ammo for this one.

## Others ##
  * One of the 4th year guys suggested that we could put a screenshot of our application on the main page. I'm not saying that we really _should_, but it doesn't sound like it would be _that_ bad, so I'll just leave this here.
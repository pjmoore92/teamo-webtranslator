_The document is intended for our client, so it should present her our solution. Also, it should be as non-technical as possible, since she is not a CS student (this was funnier in my head). We probably should have sent this a long time ago, but if we do, that should be ok for next week._

_It will also serve as a reference point for us further in the planning and the development process._

_Here be notes on the [wireframes](Wireframes#Notes.md)._

_**Disclaimer**: the document is **not complete**. It needs more content to be added in all the sections and revised before it is finalized._

_There is also a [Google Docs](http://goo.gl/k3fGk) version of this document._

# Specification requirements document #


## Introduction ##
This document is intended to describe the functionalities that the project “Website for a translator” should provide to its users.
It contains the **process** through which the users of the system will go when using the system, along with a **screen by screen** specification.

Algorithms or any other technical details are not discussed here.

The graphics of the pages are shown merely to illustrate the functionality. The actual design of the system will be developed over time.

## Functional Requirements ##

This section presents a use case analysis of the Translator website. The use cases presented here model the interaction between users and the website. These use cases will be used to guide usability, to provide a task-oriented documentation system.

### User classes ###

We have identified the need of two main user classes:

  * Client
  * Translator

The clients are the users of the service, the visitors of the website. However, as far as the system is concerned, not all visitors are clients, because, in order for a visitor to become a client, he must register with the service, so we decided to have a main **Visitor** category and **Registered client** as a subcategory.

#### Visitor ####
**Rationale**: The visitor is just visiting. An anonymous visitor of the website.

"_I need to get some documents translated. I came across this website and before I register or send any of my documents, I want to make sure that I’m dealing with a serious service._"

He is a potential client, therefore the steps which he must make in order to become one must be as clear as possible.

His goal is to inform himself about the service. In order for him to be converted, he must be convinced that the service provided is of great quality, so the system’s goal is to make itself trustworthy. Also, a clear privacy policy regarding e-mail addresses and the documents should be available, since they might contain sensitive data.

#### Client ####
**Rationale**: The client is a registered user of the system.

He has the same goals as the Visitor, but, now that he is registered, he trusts the service a bit more.
He has access to all the documents that he ever submitted for translation and can view each of the documents statuses (e.g.: Has it been reviewed/quoted by the translator? How much do I have to pay for the translation? etc. ).

#### Administrator/Translator ####
**Rationale**: The translator is the one answering all the translation requests.

"_As a translator, I must review the documents that my clients send me and quote them. After that, I must also translate them and let them know that I finished work._"

His goal is to answer to all of the client’s requests, i.e. to quote the documents that are received and then translate them and send them back to them.

#### Summary ####
A set of rough, but clear specifications for each user class:
  * The **visitor** must be able to register himself as a client of the service. It must be made clear to the visitor the exact terms of the service (e.g.: what service is provided, how it works, etc). Also, some form of contact should be provided, in case more information/details are needed.
  * The **client** must be able to submit documents for translating and see the stage that their document is in.
  * The **translator** must be able to quote all the incoming documents and submit them after the work is finished.


### System Boundary ###

#### ERD ####
![https://lh3.googleusercontent.com/-w1qwx2n8PU0/Tx38kgO3_QI/AAAAAAAAJnI/iUtoGnSQ0xg/s839/Andrei%2527s%2520attempt.png](https://lh3.googleusercontent.com/-w1qwx2n8PU0/Tx38kgO3_QI/AAAAAAAAJnI/iUtoGnSQ0xg/s839/Andrei%2527s%2520attempt.png)
[cacoo.com](https://cacoo.com/diagrams/QdXf2xFjGydDz7GH)

#### Job statuses ####
![https://lh6.googleusercontent.com/--1tcOfeLjY0/Tx3lELFgxoI/AAAAAAAAJms/9cElz1WqGKs/s1038/Flowchart.png](https://lh6.googleusercontent.com/--1tcOfeLjY0/Tx3lELFgxoI/AAAAAAAAJms/9cElz1WqGKs/s1038/Flowchart.png)
[cacoo.com](https://cacoo.com/diagrams/f8rK3UBttxbmp3Rq)

### Scenarios ###

### Process overview ###
#### Client ####
#### Administrator ####

### Non-functional requirements ###
This section of the document will list all of the web-site’s different screens and pages along with sketches and thorough descriptions for each.

**Note**: give clear labels to the important sections, in order for them to be referenced further in the document, e.g.: a walkthrough from both the client’s and the admin’s point of view.

By the nature of their content, the pages can be categorised into **static** and **dynamic**.
**Static** pages displays the same information for all users, regardless of their status (logged in or just visiting, client or administrator). **About**, **Testimonials** and **Contact** are such pages in the system described here.
On the other hand, **dynamic** pages draw some data from the database and display it accordingly. In this case, the dynamic pages are the ones in the dashboard (both client’s and administrator’s) since the information there is specific to every client.

#### Conventions used ####
  * **green background** and **yellow labels** (fig. x) - used to highlight and label specific groups of content that will be referenced/explained in the document
  * **links** (fig. x)
  * **button** (fig. x)
  * **dropdown** (fig. x)

#### Page layout ####
![https://lh4.googleusercontent.com/-weQEZsURee4/TwwZ1xVYsSI/AAAAAAAAJj8/OnGnAwbvjDU/s1054/myImage.png](https://lh4.googleusercontent.com/-weQEZsURee4/TwwZ1xVYsSI/AAAAAAAAJj8/OnGnAwbvjDU/s1054/myImage.png)

All the pages have this basic layout comprised of the following sections:
  * Header
  * Content area
  * Footer

The **header** and the **footer** sections will remain unchanged across all pages and the rest of the content goes in the **content area**. The rest of the sketches of the pages illustrated here will only show the **content area**.


**Header**

The header contains:
  * the **name** and/or **logo** of the website;
  * main navigation **menu**

The **menu** is a collection of links to the main areas of the website:
  * Home (Section X)
  * About (Section X)
  * Testimonials (Section X)
  * Contact (Section X)
  * Login (Section X) - this link must stand out, since it is of a higher importance and the page linked is of a different nature than the rest, so it is separated from the others. _(this was me trying to sound smart and stuff)_


**Footer**

Suggestions for content:
  * copyright notice, if needed
  * links to legal documents (e.g.: Privacy policy, terms of use, etc) - http://goo.gl/qZ8yU
  * awards or certifications (translation services related, PayPal certification)
  * contact information (actual information or just a link to the ‘Contact’ page)
  * link to the business’ facebook page

#### Home page ####
![https://lh4.googleusercontent.com/-mE14xHW0TdM/TwwhA2nssOI/AAAAAAAAJkI/C2f6pySP5gI/s960/myImage%252520%2525282%252529.png](https://lh4.googleusercontent.com/-mE14xHW0TdM/TwwhA2nssOI/AAAAAAAAJkI/C2f6pySP5gI/s960/myImage%252520%2525282%252529.png)

This is the front page of the website; it's what the users first see when they get there.

It is mainly composed of:
  1. **tagline** - a few words describing the service and how it works
  1. **quote** form -

#### About ####
This is the page the users would go to in order to find out more about the service. Contains a few paragraphs that detail goals and accomplishments.
The page needs to answer some possible questions that the users might have regarding the business:
  * **who** is behind it?
  * **what** are they doing?
  * **when** did they start doing it?
  * **where** are they?
  * **how** are they accomplishing what they claim to do?

Providing an image, or even a short video, would make the website seem more trustworthy.

References:
  * http://www.useit.com/alertbox/about-us-pages.html
  * http://sixrevisions.com/content-strategy/about-page-guidelines/

#### Testimonials ####
![https://lh6.googleusercontent.com/-kgwTuXqNZFw/Tw9E3H7uaTI/AAAAAAAAJlU/M8svc4rbSY8/s960/testimonials.png](https://lh6.googleusercontent.com/-kgwTuXqNZFw/Tw9E3H7uaTI/AAAAAAAAJlU/M8svc4rbSY8/s960/testimonials.png)
Having testimonials from happy clients also adds to the trust of the business. The business owner would ask her clients for feedback and permission to publish it on the website. Then she can pick which ones would suit her and post only a fragment on the website, along with some details of that client (name, company, occupation).

References:
  * http://robcubbon.com/client-testimonial-page-website/
  * http://www.noupe.com/how-tos/web-design-trends-testimonials-design.html

#### Contact ####
![https://lh4.googleusercontent.com/-zWp-kPfmzB4/Tw9AaVTL5bI/AAAAAAAAJk8/ix50Gt1C0yI/s960/contact.png](https://lh4.googleusercontent.com/-zWp-kPfmzB4/Tw9AaVTL5bI/AAAAAAAAJk8/ix50Gt1C0yI/s960/contact.png)
Having other contact methods (phone number, physical mailing address) also add to the credibility of the business. “A company with no address is not one you want to give money to.” [[Jakob Nielsen](http://www.useit.com/alertbox/designmistakes.html)]
  1. work telephone number
  1. physical address
  1. social media pages
  1. contact form (by e-mail)

#### Administrator Dashboard ####
##### Elements #####
  1. Sidebar menu
  1. main content area

**Sidebar menu**

One page for each document status.
  * **Pending**
> > "awaiting quote"


> Fields: Docnames, user e-mail and name, download doc, deadline

> Button: Send Quote

  * **Quotes**
> > "awaiting translations"


> Fields: Docnames, user e-mail and name, download doc, deadline

> Button: Send

  * **History**
> > "completed requests"
> > > Last 90 days
> > > > Fields: Docnames, user e-mail and name

> > > After
> > > > Fields: Docnames, user e-mail and name, download original, download translations

  * **Reports**

> > "Usage statistics"


> DB queries: completed jobs, quoted jobs, etc

> some nice pie charts

  * **Settings**
> > add more languages


> content edit for static pages

> change password
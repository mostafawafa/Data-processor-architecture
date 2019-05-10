# Data-processor-architecture
Data processor architecture

## Problem:

This system has different types of Data providers, the data coming from these data providers may (and will) be on different formats. integration with new data providers happens so often. So we need to furnish an architecture that is very flexible with these changes so we don't need to change in the whole system whenever adding a new data provider.

### -the solution here focuses on Backend with very naive UI.

## Solution 

-we had different types of data providers. the integration with each data provider will be in its own class. we need an interface that works as a contract for all these data providers classes. interface methods that need to be implemented for each data provider integration are: 
            
            1. get Method: to get the data from the source whatever the way. API request, scraping, reading from a file, etc. so we will have the original data from the source.
            2. getFormatedData Method: to get a format that we can work within our system. we don't care if that provider return data in any format (JSON,csv,XML,whatever). but we expect that class to prepare and format these data to format that we'll use on our system.

So to be clearer, the consumer class will never care about (the way to getting data from data providers or the format of these data). it only knows that these classes will return the data to it in a format that can be dealt with whenever he call method (->getFormatedData() ) on them. cause all of them implements the (DataProviderInterface). so it'll be very easy to add new data providers integration without changes on consumer class at all.we just need to add a class with its own implementation which implements the ((DataProviderInterface) and add a row for it in DB ( maybe using seeder in future). 

## Another problem:

-Also After getting these data, we can save them in different ways: Database, file,aws s3, or maybe in another way. we don't wanna make changes to our system whenever facing a new way. and maybe we wanna to have all these ways available and wanna the user to choose what he needed (as implemented).

## Solution:

here comes Factory design pattern. we have different savers classes. and all those savers implements an interface that introduces the (save) method. So what we do is 

1. getting the option from the user. 
2. call factory::create() with input to give us the correct object. 
3. call save on that object. 

(the consumer doesn't even need to know the name of the class ). whenever we need to add a new saver type, we add a class with its new implementation and add it to the factory. no change in our consumer class.



## Architecture:

    -this's MVC Application __(everything's implemented from scratch without framework)__ except using (twig template engine) and phpdotenv

    structure:

    -Src Folders: which contain:
        -Controllers Folder
        -Models Folder
            -Model parent class: (contain main methods for inserting/bulk inserting/getting all rows/ getting by primary key/ getting by where condition/)
            -other model child classes
        -Views Folder
        -Classes Folder
            -Dataproviders classes 
            -Savers classes
            -Consumer class
            -DB class 
        -Contracts (interfaces) Folder
            -DataProvider interface
            -Saver interface

    -Tests folder

    router.php  very simple router
    routes.php  to bind actions to controllers' methods
    

## Design Patterns/ architecture used:
    -MVC
    -Factory design patterns. (Savers classes)
    -Strategy design pattern. 
    -Singleton design pattern: used in the implementation of the Database. to only make one instance of DB class during the Request life cycle.


### -Trade-offs I made, Things left out, and what I might do differently if I were to spend additional time on the project.

I tried to focus on the structure itself and make things decoupled using interfaces, design patterns as (factory, strategy), dependency injection, etc. to make most of things interchangable without violate SOLID principles. but didn't focus on implementing or use real data providers like I didn't implement provider with CSV format, etc.

I would spend more time on making more unit testing cases and make it better.


I also would use migrations for creating the database's tables. and seeders to insert data like (data providers) in the database.

I also would make an interface and classes for the template engines so it can be changeable in the future. But I don't think it's important in this phase.



## How to run the project:

-Create new Database and dump sql.dump file on it.
-copy .env.example to .env and change Db credentials.
-run "composer install". you need to install composer first if it's not already installed.
-change permission for storage folder if you wanna file saver to work

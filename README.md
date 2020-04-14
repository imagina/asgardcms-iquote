# Asgardcms-iquote  v1.0.9

_Nota: Frontend version compatible [qquote 1.0.8](https://github.com/imagina/qquote/tree/1.0.8)_

## Installation
First, we require the installation of *laravel-dompdf* library (https://github.com/barryvdh/laravel-dompdf):

`composer require barryvdh/laravel-dompdf`

After updating composer, we proceed to configure it:

Add the ServiceProvider to the provides array in config/app.php

`Barryvdh\DomPDF\ServiceProvider::class,`

Then, use the facade for shorter code. Add this to your facades:

`'PDF' => Barryvdh\DomPDF\Facade::class`

After install and config laravel-dompdf we proceed to install iquote module:

`composer require imagina/iquote`

Important: the *storage/* base folder must be read/write permissions (755)

Optional: If the quote pdf file does not load successfully, we must create in the *storage/* base folder the *fonts/* subfolder

## End Points
Route Base: `https://yourhost/api/iquote/v1/`

* #### Packages

  * Attributes
  
    | NAME | TYPE | NULLABLE | TRANSLATABLE |
    | ------------- | ------------- |------------- | ------------- |
    | name | String | &#9744; | &#9745; | 
    | description | String | &#9744; | &#9745; | 
  
  * Create.
     * Method: `POST`  
     * Requires Authentication: &#9745;
     * Routes: 
        * `/packages`
     * Post params (Example): 
     
        ```
        {
           attributes:{
             name: 'name',
             description: 'description'
           }
        }
        ```
  
  * Read
    * Method: `GET`
    * Requires Authentication: &#9744;
    * Routes: 
      * `/packages`
      * `/packages/id`
   
    * Filters
    
        |  | 
        | ------------- |
        | search |  
        | date |  
        | order |  
    
    * Includes
    
        |  | 
        | ------------- |
        | products |  
    
  * Update
    * Method: `PUT`
    * Requires Authentication: &#9745;
    * Routes: 
      * `/packages/id`
  
  * Delete
    * Method: `DELETE`
    * Requires Authentication: &#9745;
    * Routes: 
      * `/packages/id`
  
* #### Products
  * Attributes
  
    | NAME | TYPE | NULLABLE | TRANSLATABLE |
    | ------------- | ------------- |------------- | ------------- |
    | name | String | &#9744; | &#9745; | 
    | description | String | &#9744; | &#9745; | 
    | active | Boolean | &#9744; | &#9744; | 
    | price | Number | &#9744; | &#9744; | 
    
  * Create.
     * Method: `POST`  
     * Requires Authentication: &#9745;
     * Routes: 
        * `/products`
     * Post params (Example): 
     
        ```
        {
           attributes:{
             name: 'name',
             description: 'description',
             active: true,
             price: 15000
           }
        }
        ```
  
  * Read
    * Method: `GET`
    * Requires Authentication: &#9744;
    * Routes: 
      * `/products`
      * `/products/id`
    
    * Filters
    
        |  | 
        | ------------- |
        | search |  
        | date |  
        | order |  
        | active |  
        | package | 
         
    * Includes
    
        |  | 
        | ------------- |
        | characteristics |  
        | packages |  
    
  * Update
    * Method: `PUT`
    * Requires Authentication: &#9745;
    * Routes: 
      * `/products/id`
  
  * Delete
    * Method: `DELETE`
    * Requires Authentication: &#9745;
    * Routes: 
      * `/products/id` 

* #### Characteristics
  * Attributes
  
    | NAME | TYPE | NULLABLE | TRANSLATABLE |
    | ------------- | ------------- |------------- | ------------- |
    | name | String | &#9744; | &#9745; | 
    | description | String | &#9744; | &#9745; | 
    | options | Text | &#9744; | &#9745; | 
    | product_id | Number | &#9744; | &#9744; | 
    | type | Number | &#9744; | &#9744; | 
    | parent_id | Number | &#9744; | &#9744; | 
    | price | Number | &#9744; | &#9744; | 
    | active | Boolean | &#9744; | &#9744; | 
    | position | Number | &#9744; | &#9744; | 
    | required | Boolean | &#9744; | &#9744; | 
        
  * Create:
     * Method: `POST`  
     * Requires Authentication: &#9745;
     * Routes: 
        * `/characteristics`
     * Post params (Example): 
     
        ```
        {
           attributes:{
               name: 'name',
               description: 'description',
               options: 'options',
               product_id: 1,
               type: 1,
               parent_id: 1,
               price: 1500,
               active: true,
               position: 1,
               required: true
           }
        }
        ```
  
  * Read:
    * Method: `GET`
    * Requires Authentication: &#9744;
    * Routes: 
      * `/characteristics`
      * `/characteristics/id`
    * Filters
    
      |  | 
      | ------------- |
      | search |  
      | date |  
      | active |  
      | product |  
      | type | 
      | parent | 
            
    * Includes
    
      |  | 
      | ------------- |
      | product |  
      | parent |  
      | childrens |  

  * Update
    * Method: `PUT`
    * Requires Authentication: &#9745;
    * Routes: 
      * `/characteristics/id`
  
  * Delete
    * Method: `DELETE`
    * Requires Authentication: &#9745;
    * Routes: 
      * `/characteristics/id` 
    
* #### Types (Static Entity)
  * Attributes
  
    | NAME | TYPE | NULLABLE | TRANSLATABLE |
    | ------------- | ------------- |------------- | ------------- |
    | name | String | &#9744; | &#9744; | 

  * Read:
    * Method: `GET`
    * Requires Authentication: &#9744;
    * Routes: 
      * `/types`
    
* #### Quotes
  * Attributes
  
    | NAME | TYPE | NULLABLE | TRANSLATABLE |
    | ------------- | ------------- |------------- | ------------- |
    | first_name | String | &#9744; | &#9744; | 
    | last_name | String | &#9744; | &#9744; | 
    | email | String | &#9744; | &#9744; | 
    | phone | String | &#9744; | &#9744; | 
    | notes | String | &#9744; | &#9744; | 
    | value | Text | &#9744; | &#9744; | 
    | user_id | Number | &#9744; | &#9744; | 
    | customer_id | Boolean | &#9744; | &#9744; | 

        
  * Create:
     * Method: `POST`  
     * Requires Authentication: &#9745;
     * Routes: 
        * `/quotes`
     * Post params (Example): 
     
        ```
        {
           attributes:{
              first_name: 'first_name',
              last_name: 'last_name',
              email: 'email',
              phone: 'phone',
              notes: 'notes',
              value: 'value',
              user_id: 1,
              customer_id: 1
           }
        }
        ```
  
  * Read:
    * Method: `GET`
    * Requires Authentication: &#9744;
    * Routes: 
      * `/quotes`
      * `/quotes/id`
    * Filters
    
      |  | 
      | ------------- |
      | search |  
      | date |  
      | order |  
      | user |  
      | customer | 
          
    * Includes
    
      |  | 
      | ------------- |
      | user |  
      | customer |  
    
  * Update
    * Method: `PUT`
    * Requires Authentication: &#9745;
    * Routes: 
      * `/characteristics/id`
  
  * Delete
    * Method: `DELETE`
    * Requires Authentication: &#9745;
    * Routes: 
      * `/quotes/id` 

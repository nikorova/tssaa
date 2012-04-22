# TSSAA Mobile App Project 
## Phase I
### Spec Sheet
- - -
* Mobile App Frontend
	* Written in jQuery Mobile 
	* RESTful
	* Components as Plugins allows for easy extension of application 
		* Login Component
			* Login Timeout
			* Forgot Password Link (email notification to athletic director)
		* Directory Manager (DM) Component 
			* Add, Update, Delete for
				* Schools
				* coaches
				* Administrators
		* Notification Manager (NM) Component
			* Create arbitrarily complex recipient lists for Twilio notifications
			* Utilize Twilio app to send mass notifications per user specification
* Backend
	* Written in MySQL 5 and PHP 5
	* Individual Backends for each Frontend Component
		* Login Backend
		* Directory Manager (DM) Backend
			* CRUD corresponding to needs of Frontend
* ETL Layer
	* Ensures backwards compatibility with MySQL 3


### Timeline
- - - 
* Week I 
	* Completed data model
* Week II 
	* Basic class wrappers for active record pattern
* Week III 
	* Basic DM Backend 
	* Basic DM Frontend 
* Week IV
	* Improved DM Backend
	* Improved DM Frontend 
* Week V
	* Finished DM Frontend
	* Finished DM Backend 
* Week VI
	* Basic Twilio integration
	* Basic ETL implementation 
* Week VII
	* Improved Twilio integration
	* Improved ETL implementation
* Week VIII
	* Finished twilio integration
	* Finished ETL implementation
* Week IX - Begin QA Phase
	* Unit Testing
	* Beta User Adoption 
* Week X
	* Security Testing
	* Load Testing 
* Week XI 
	* Platform Portability Testing
* Week XII
	* QA Flex 
	* Deployment Prep 

	
	
   

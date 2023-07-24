**<p align="center">Module-21 Todo App backend API with JWT Authentication</p>**
<hr><br>

**API end points: **
<hr>

- localhost:8000/api/user-registration  (POST) | <br> Test Data | <br> 
{
 "firstName":"John",
 "lastName":"Doe",
 "phone":"015985646",
 "email":"demo@email.com",
 "password":"123456"    
}
<br> <br> <hr>

- localhost:8000/api/user-login  (POST) | <br> Test Data | <br> 
{
 "email":"demo@email.com",
 "password":"123456"    
}
<br> <br> <hr>

- localhost:8000/api/dashboard  (GET)

<br><br><hr>

- localhost:8000/api/add-task  (POST) | <br> Test Data | <br> 
{
 "task":"do homework",
 "status":"ongoing"   
}
<br> <br> <hr>

- localhost:8000/api/tasks  (GET)

<br><br><hr>

- localhost:8000/api/show-task/{task-id}  (GET)

<br><br><hr>

- localhost:8000/api/update-task/{task-id}  (POST) | <br> Test Data | <br> 
{
 "task":"do homework",
 "status":"completed"   
}
<br> <br> <hr>

- localhost:8000/api/delete-task/{task-id} (POST) 

<br> <br> <hr>

- localhost:8000/api/user-logout (POST) 

<br> <br> <hr>


THIIO USER APP DOCUMENTATION

This app has a complete CRUD functionality, you need an email and password to access, and once inside, you can execute all crud operations, for the moment, the phone must be of 10 characters max, and the language can only be either English or Spanish.

You can start this this sample credentials making a post request to /api/users for the first time:

{
  "name": "thiio",
  "email": "thiio@thiio.com",
  "password": "thiio",
  "phone":"1234567891",
  "language":"English"
}

userController Class Documentation

The userController class is responsible for handling API requests related to user management, including user creation, retrieval, update, and deletion, as well as user authentication.

Methods
index()
Purpose: Retrieve a list of all users.

HTTP Method: GET

Endpoint: /api/users

Parameters: None

Return Value: A JSON response containing the list of users and their details, along with a status code.

Status Codes:

200: Success. Returns the list of users.
404: No users found.
store(Request $request)
Purpose: Create a new user.

HTTP Method: POST

Endpoint: /api/users

Parameters:

$request (Request): The HTTP request object containing user data.
Return Value: A JSON response containing the newly created user's details and a status code.

Status Codes:

201: Success. User created successfully.
400: Bad request. Error on data validation.
500: Internal server error. Error creating user.
show($id)
Purpose: Retrieve details of a specific user by ID.

HTTP Method: GET

Endpoint: /api/users/{id}

Parameters:

$id (integer): The ID of the user to retrieve.
Return Value: A JSON response containing the user's details and a status code.

Status Codes:

200: Success. Returns the user details.
404: User not found.
destroy($id)
Purpose: Delete a user by ID.

HTTP Method: DELETE

Endpoint: /api/users/{id}

Parameters:

$id (integer): The ID of the user to delete.
Return Value: A JSON response confirming the deletion of the user and a status code.

Status Codes:

200: Success. User deleted successfully.
404: User not found.
update(Request $request, $id)
Purpose: Update details of a specific user by ID.

HTTP Method: PUT

Endpoint: /api/users/{id}

Parameters:

$request (Request): The HTTP request object containing updated user data.
$id (integer): The ID of the user to update.
Return Value: A JSON response containing the updated user's details and a status code.

Status Codes:

200: Success. User updated successfully.
400: Bad request. Error validating data.
404: User not found.
updatePatch(Request $request, $id)
Purpose: Partially update details of a specific user by ID.

HTTP Method: PATCH

Endpoint: /api/users/{id}

Parameters:

$request (Request): The HTTP request object containing partially updated user data.
$id (integer): The ID of the user to update.
Return Value: A JSON response containing the partially updated user's details and a status code.

Status Codes:

200: Success. User updated successfully.
400: Bad request. Error validating data.
404: User not found.
login(Request $request)
Purpose: Authenticate a user based on provided credentials.

HTTP Method: POST

Endpoint: /api/login

Parameters:

$request (Request): The HTTP request object containing user credentials (email and password).
Return Value: A JSON response containing the authenticated user's details and a status code.

Status Codes:

200: Success. User authenticated successfully.
401: Unauthorized. Invalid credentials.



AuthController Class Documentation
The AuthController class is responsible for handling user authentication-related API requests, including user login and logout.

Methods
user()
Purpose: Retrieve the authenticated user.

HTTP Method: GET

Endpoint: /api/user

Parameters: None

Return Value: A JSON response containing the authenticated user's details and a status code.

Status Codes:

200: Success. Returns the authenticated user's details.
401: Unauthorized. No user authenticated.
login(Request $request)
Purpose: Authenticate a user based on provided credentials and generate an authentication token.

HTTP Method: POST

Endpoint: /api/login

Parameters:

$request (Request): The HTTP request object containing user credentials (email and password).
Return Value: A JSON response containing an authentication token and a status code. The authentication token is sent as a JWT (JSON Web Token) and stored as a cookie for subsequent requests.

Status Codes:

200: Success. User authenticated successfully. Returns an authentication token.
401: Unauthorized. Invalid credentials.
logout()
Purpose: Invalidate the current authentication token and log the user out.

HTTP Method: POST

Endpoint: /api/logout

Parameters: None

Return Value: A JSON response confirming the user's logout and a status code. The authentication token cookie is deleted from the client's browser.

Status Codes:

200: Success. User logged out successfully.


Routes Documentation
User Routes
List Users
HTTP Method: GET

Endpoint: /api/users

Controller Method: userController@index

Purpose: Retrieve a list of all users.

Show User Details
HTTP Method: GET

Endpoint: /api/users/{id}

Controller Method: userController@show

Purpose: Retrieve details of a specific user by ID.

Create User
HTTP Method: POST

Endpoint: /api/users

Controller Method: userController@store

Purpose: Create a new user.

Update User
HTTP Method: PUT

Endpoint: /api/users/{id}

Controller Method: userController@update

Purpose: Update details of a specific user by ID.

Partially Update User
HTTP Method: PATCH

Endpoint: /api/users/{id}

Controller Method: userController@updatePatch

Purpose: Partially update details of a specific user by ID.

Delete User
HTTP Method: DELETE

Endpoint: /api/users/{id}

Controller Method: userController@destroy

Purpose: Delete a user by ID.

Authentication Routes
User Authentication
HTTP Method: POST

Endpoint: /api/login

Controller Method: AuthController@login

Purpose: Authenticate a user based on provided credentials and generate an authentication token.

User Logout
HTTP Method: POST

Endpoint: /api/logout

Controller Method: AuthController@logout

Purpose: Invalidate the current authentication token and log the user out.

Retrieve Authenticated User
HTTP Method: GET

Endpoint: /api/user

Controller Method: AuthController@user

Purpose: Retrieve the authenticated user.

Dashboard Route
Dashboard
HTTP Method: GET

Endpoint: /api/dashboard

Controller Method: DashboardController@index

Purpose: Retrieve dashboard data. (Note: Authentication may be required)


FRONTEND

LOGIN COMPONENT
Description
This component represents a login form for users to authenticate themselves. It includes input fields for email and password, along with a submit button. Error messages are displayed if authentication fails.

Dependencies
Vue.js
Vuetify (Vuetify components are used for styling)
Data
email: Stores the user's email input.
password: Stores the user's password input.
errorMessage: Stores the error message to display in case of authentication failure.
Methods
login(): Handles the form submission, sends a POST request to the backend API for user authentication, and redirects the user to the dashboard upon successful login. Displays error messages if authentication fails.


DASHBOARD component

Description
This component represents the dashboard where users can view, create, edit, and delete other users. It provides a user-friendly interface for managing user data.

Dependencies
Vue.js
Vuetify (Vuetify components are used for styling)
Data
users: Stores the list of users fetched from the backend API.
editingUser: Stores the user object currently being edited.
creatingUser: Tracks whether the user creation dialog is open.
newUser: Stores the data for creating a new user.
editedUser: Stores the data for editing a user.
editingUserDialog: Tracks whether the user edit dialog is open.
changePassword: Tracks whether the password is being changed during user editing.
Methods
fetchUsers(): Fetches the list of users from the backend API.
editUser(user): Opens the user edit dialog and populates it with the user's data.
saveUser(): Saves the edited user data to the backend API.
deleteUser(userId): Deletes the user with the specified ID from the backend API.
createUser(): Creates a new user with the data provided in the newUser object.
logout(): Logs the user out and redirects them to the login page.
saveEditedUser(): Saves the edited user data to the backend API, considering whether the password is being changed.


Router Configuration Documentation
This documentation provides an overview of the router configuration for your Vue.js application.

Overview
The router is responsible for managing navigation within your Vue.js application. It maps URL paths to Vue components, allowing users to navigate between different pages or views.

Description
createRouter(): Creates a new router instance.
createWebHistory(): Creates a history instance based on HTML5 history API, which uses the browser's history.pushState() and history.replaceState() methods to update the URL without reloading the page.
routes: An array of route objects, each defining a URL path, a name, and the corresponding component to render when the path is matched.
path: The URL path for the route.
name: The name of the route, used for programmatic navigation and linking.
component: The Vue component to render when the path is matched.
router: The router instance that manages navigation within the application.
export default router: Exports the router instance to be used in other parts of the application.
Routes
Login Route:

Path: /
Name: Login
Component: Login.vue
This route renders the login page.
Dashboard Route:

Path: /dashboard
Name: Dashboard
Component: Dashboard.vue
This route renders the dashboard page, where users can view, create, edit, and delete users.
Usage
Import the router instance in the main Vue application file (e.g., main.js or App.vue).
Use the router instance to define the routes and manage navigation within the application.
Dependencies
Vue Router: Provides the routing functionality for the Vue.js application.
Notes
You can add additional routes to the routes array as needed for other pages or views in your application.
Ensure that the imported components (Login and Dashboard) correspond to the correct file paths.
## Project Overview: Model View Controller (MVC) Architecture and Controller-based Routing

The goal of this project is to implement the **Model View Controller (MVC)** architecture and a **Controller-based Routing** system. This allows users to access specific pages only if the corresponding controller and method exist.

For instance, when visiting www.phpmvc.com/users/login, the page will be rendered if the associated controller and method exist. However, if the URL is www.phpmvc.com/users/prune and the controller and/or method do not exist, a **"Page Not Found"** message will be displayed.

### Controller and Method Execution:

If a controller named **"user"** exists, the system will automatically execute the code inside the **"index"** method by default. In case the **"user"** controller does not exist, a 404 Page will be displayed. Similarly, if the **"user"** controller exists but an explicit method is specified in the URL and that method does not exist, a 404 Page will also be shown.

Here are a couple of examples to illustrate this behavior:

- Visiting www.phpmvc.com/users/index will execute the code within the **"index"** method of the Users.php controller.
- However, when accessing www.phpmvc.com/users/delete, although the Users.php controller exists, it does not have a **"delete"** method, resulting in a 404 page being displayed.

### Reserved Parameters in the URL:

When the URL contains more than two pathnames, these additional pathnames are considered reserved parameters. For example, in the URL www.phpmvc.com/users/index/apple/donut, the pathnames **"apple"** and **"donut"** following **"index"** are treated as reserved parameters.

During URL processing, these reserved parameters are extracted and stored in an array. In the given example, the resulting array would be:

```php
Array(
  [0] => users
  [1] => index
  [2] => apple
  [3] => donut
)
```

As the processing logic advances, certain parameters are removed or unset from the array. In this case, the parameters at index 0 and index 1 (**"users"** and **"index"**) are removed, leaving only the reserved parameters at index 2 and index 3 (**"apple"** and **"donut"**).

So, at the end of the processing, the array will look like this:

```php
Array(
  [0] => apple
  [1] => donut
)
```

These remaining parameters can be utilized for further processing or passed as arguments to methods or functions that require them.

### .htaccess Configuration

1. The root directory .htaccess configuration redirects all incoming requests to the index.php file located in the root directory. This is achieved by rewriting the URL and passing it as a query parameter. By doing so, the PHP application can effectively process and route the requested URL.

2. The .htaccess file located inside the **"app"** folder enables directory indexing. This enhances the security of your website by preventing unauthorized access to the directory structure and files. Disabling directory indexing ensures that if a directory doesn't have an index file, the server will deny access to the directory listing, thus protecting the contents from being exposed.

### Folder Structure of the Project:

```
app
├── controller      # Contains your own controllers
└── lib             # Holds base controller and route dispatcher logic
    ├── Controller.php
    └── RouteDispatcher.php
└── views
.htaccess
index.php
```

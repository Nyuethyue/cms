<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>
 
#

# My Project

### create Page model

```
php artisan maek:model Page --migration
```

### Creating Pages livewire component

```
php artisan make:livewire Pages
```

### Creating FrontPage livewire component

```
php artisan make:livewire FrontPage
```

https://github.com/amaelftah/laravel-trix

# User Role Access features from laravel Middleware

## steps to be followed

### 1. Firs Add Role filed in users table

```
php artisan make:migration add_role_to_users_table --table=users
```

### 2. create middleware file

```
php artisan make:middleware EnsureUserRoleIsAllowedToAccess
```

### 3. Then register in the Kernel.php file

```
'accessrole' => \App\Http\Middleware\EnEnsureUserRoleIsAllowedToAccess::class,
```

### 4. Don't forget to add role field in User Model in fillable

### 5. Add to routes to allow the access to routes

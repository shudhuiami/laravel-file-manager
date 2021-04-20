
# Laravel File Manager 
Laravel File Manager has complete file upload management system. 

## Requirements
* [Laravel](http://laravel.com/docs/) 6.x or upper

## Installation with composer

```bash
composer require zobayer/laravel-file-manager
```

## Initialization Package
```
php artisan FileManager:init
```


## Load Package
`Add this in providers [ config/app.php ]`
```
zobayer\LaravelFileManager\LaravelFileManagerServiceProvider::class
```


## Config the page `Config/filemanager.php`

| Name | Type | Description |
| --- | --- | --- |
| `APP_URL` | String | You Project root URL |
| `ROUTE_PREFIX` | String | Custom Prefix for the routes | |
| `IMAGE_EXT` | String | Extension to store in image directory | |
| `VIDEO_EXT` | String | Extension to store in cideo directory | |
| `STORAGE_DIR` | String | You can store you files in two directory (`1.storage` & `2.public`) default storage |


## Available Routes
```
[APP_URL]/[ROUTE_PREFIX]/add (name=[laravel.file.manager.add])

[APP_URL]/[ROUTE_PREFIX]/get (name=[laravel.file.manager.get.all])

[APP_URL]/[ROUTE_PREFIX]/get/single/{id} (name=[laravel.file.manager.get.single])

[APP_URL]/[ROUTE_PREFIX]/delete/single/{id} (name=[laravel.file.manager.get.delete])

[APP_URL]/[ROUTE_PREFIX]/hard/delete/single/{id} (name=[laravel.file.manager.get.delete.hard])
```

## Show your Support

To show your support for my work on this project:

* [Star this repository](https://github.com/shudhuiami/laravel-file-manager)

## Credits

Laravel File Manager was created by [Ahmed Zobayer](http://shudhuiami.github.io). Released under the MIT license.

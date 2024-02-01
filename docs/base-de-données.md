# base-de-données 
## les commandes

```
php artisan make:migration create_presentation_table
```

```
php artisan migrate

```

```
php artisan make:model Persentation
```

```
php artisan make:migration create_images_table
```

```
php artisan make:model Image
```


```
php artisan migrate:fresh

```

## de la base de données

- presentations (id,title,content,reference,created_at,updated_at)
- images (id,name,url,reference,presentation_id,created_at,updated_at)


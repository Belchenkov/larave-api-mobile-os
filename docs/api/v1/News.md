# Api методов получения новостей для МБ ГК Основа

#### GET /api/v1/news

Метод получения новостей 

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```

<b>RESPONSE</b>

+ 200 OK

```
{
    "data": {
        "id": {Int},
        "title": {String},
        "content": {String},
        "publish": {Boolean},
        "created_at": {String},
        "updated_at": {String},
        "images": {
            'id' => {Int},
            'ext' => {String},
            'name' => {String},
            'path' => {String},
            'thumb' => {String},
            'size' => {Int},
            'type' => {Int}
        },
    },
    "meta": {
        "current_page": {Int},
        "from": {Int},
        "path": {String},
        "per_page": {Int}
       }, 
   "links": {
        "first": {String},
        "last": {String},
        "prev": {String},
        "next": {String}
    }, 
    "result": {Boolean},
    "debug": {
        "queries": {Int},
        "queries_time": {String}
    }
}
```

<table>
    <thead>
        <tr>
            <td>Название</td>
            <td>Описание</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>data.id</td>
            <td>ID новости</td>
        </tr>
        <tr>
            <td>data.title</td>
            <td>Заголовок новости</td>
        </tr>
        <tr>
            <td>data.content</td>
            <td>Описание новости</td>
        </tr>
        <tr>
            <td>data.publish</td>
            <td>Новости - опубликована</td>
        </tr>
        <tr>
            <td>data.created_at</td>
            <td>Время создание новости - опубликована</td>
        </tr>
        <tr>
            <td>data.updated_at</td>
            <td>Время обновление новости - опубликована</td>
        </tr>
        <tr>
            <td>data.images.id</td>
            <td>ID картинки к новости</td>
        </tr>
        <tr>
            <td>data.images.ext</td>
            <td>Расширение картинки к новости</td>
        </tr>
        <tr>
            <td>data.images.name</td>
            <td>Название картинки к новости</td>
        </tr>
        <tr>
            <td>data.images.path</td>
            <td>Путь до картинки к новости</td>
        </tr>
        <tr>
            <td>data.images.thumb</td>
            <td>Путь до уменьшеной картинки к новости</td>
        </tr>
        <tr>
            <td>data.images.size</td>
            <td>Размер файла</td>
        </tr>
        <tr>
            <td>data.images.type</td>
            <td>Тип файла</td>
        </tr>
        <tr>
            <td>links.first</td>
            <td>Первая страница (Пагинация)</td>
        </tr>
        <tr>
            <td>links.next</td>
            <td>Следующая страница (Пагинация)</td>
        </tr>
        <tr>
            <td>meta.current_page</td>
            <td>Текущий номер страницы (Пагинация)</td>
        </tr>
        <tr>
            <td>meta.from</td>
            <td>Номер записи (Пагинация)</td>
        </tr>
        <tr>
            <td>meta.path</td>
            <td>Путь до ресурса (Пагинация)</td>
        </tr>
        <tr>
            <td>meta.per_page</td>
            <td>Кол-во записей на странице (Пагинация)</td>
        </tr>
    </tbody>
</table>

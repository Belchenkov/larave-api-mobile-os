# Api методов получения общей информации для МБ ГК Основа

#### GET /api/v1/information/offices

Метод получения офисов компаний

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```

<b>RESPONSE</b>

+ 200 OK

```
{
    "data": {
        "id": {uuid},
        "code": {String},
        "name": {String}
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
            <td>ID офиса</td>
        </tr>
        <tr>
            <td>data.code</td>
            <td>Код офиса</td>
        </tr>
        <tr>
            <td>data.name</td>
            <td>Название офиса</td>
        </tr>
    </tbody>
</table>

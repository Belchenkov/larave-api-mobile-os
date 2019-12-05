# Api методов получения отчетов (Табло) для МБ ГК Основа

#### GET /api/v1/tableau

Метод получения списка отчетов доступных текущему пользователю 

<b>HEADERS</b>

```
Content-Type: application/json
User-Agent: *
```

```
Authorization: Bearer <accessToken>
```

<b>RESPONSE</b>

+ 200 OK

```
{
    "data": [
        {
            "id": {Int},
            "title": {String},
            "tableau_url": {String},
            "users": [
                "id_phperson": {Uuid}
            ],
            "created_at": {Datetime}
            "updated_at": {Datetime}
        }
    ],
    "result": {Boolean},
    "debug": {
        "queries": {Int},
        "queries_time": {String}
    }
}
```

#### GET /api/v1/tableau/{tableau}

Метод получения отчета по ID 

<b>HEADERS</b>

```
Content-Type: application/json
User-Agent: *
```

```
Authorization: Bearer <accessToken>
```

<b>BODY</b>
 ```
{
    "tableau": {Int}
}
```

<table>
    <thead>
        <tr>
            <td>Название</td>
            <td>Описание</td>
            <td>Формат</td>
        </tr>
    </thead>
    <tbody>
         <tr>
            <td>tableau</td>
            <td>ID отчета</td>
            <td>Обязательно</td>
        </tr>
    </tbody>
</table> 

<b>RESPONSE</b>

+ 200 OK

```
{
    "data": {
        "id": {Int},
        "title": {String},
        "tableau_url": {String},
        "users": [
            "id_phperson": {Uuid}
        ],
        "created_at": {Datetime}
        "updated_at": {Datetime}
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
            <td>ID заявки</td>
        <tr>
            <td>data.title</td>
            <td>Заголовок отчета</td>
        </tr>
        <tr>
            <td>data.tableau_url</td>
            <td>Ссылка на ресурс в системе Tableau</td>
        </tr>
        <tr>
            <td>data.users.id_phperson</td>
            <td>Список id_phperson пользователей с доступом к ресурсы</td>
        </tr>
        <tr>
            <td>data.created_at</td>
            <td>Дата создание записи</td>
        </tr>
        <tr>
            <td>data.updated_at</td>
            <td>Дата обновления записи</td>
        </tr>
    </tbody>
</table>



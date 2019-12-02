# Методы Api для коммуникации с интранет-порталом ГК Основа

### Callbacks

#### POST /api/v1/callback/pin/update 

Метод для обновления пин-кода пользователя на сервеной части МБ Основа от интранет-портала при регистрации нового пользователя

<b>HEADERS</b>

```
Content-Type: application/json
User-Agent: *
X-Callback-Key: osnova_callback
```
 
<b>BODY</b>
 ```
{
    "id_phperson": {String},
    "tab_no": {String},
    "ad_login": {String},
    "pin_code": {Number|Size:4},
    "created_at": {Datetime}
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
            <td>id_phperson</td>
            <td>ID пользователя в таблице transit_1c_PhPerson</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>tab_no</td>
            <td>Табельный номер пользователя в таблице transit_1c_employee</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>ad_login</td>
            <td>Email пользователя</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>pin_code</td>
            <td>Пин-код сгенерированный порталом при регистрации пользователя</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>created_at</td>
            <td>Дата создания пинкода</td>
            <td>Обязательно</td>
        </tr>
    </tbody>
</table>

<b>RESPONSE</b>

+ 200 OK

```
{
    "result": {Boolean}
}
```

### Формат ответов с ошибкой

+ 422 Unprocessable Entity

При возникновении этой ошибки были нарушены правила валидации. 

```
{
    "result": {Boolean},
    "fieldName": [
        {String},
        ...
    ],
    ...
}
```
, где `fieldName` - название поля с ошибкой имеет массив ошибок с текстом, что нарушено.

# Уведомления о событиях

```
[POST] /api/v1/callback/portal/push/events

[REQUEST]

{
    "data": {
        "id": "5dd52390673cf700567e1d72",
        ...
    },
    "type": "push || kip_new || kip_comment || kip_update",
    "title": "Создана новая задача КИП",
    "message": "Стыковка с международной космической лунной станцией.",
    "users": [
        "381004a1-d925-11e8-9126-00155d640b22",
        ...
    ]
}

[RESPONSE]

{
    "result": true
}

[ERROR]

{
    "result": false,
     "error": {
        ...
    },
}
```


# Сессии авторизации


## Получение списка сессии поьзователя
```
[GET] /api/v1/callback/sessions/<id_phperson>

[RESPONSE]

{
    "result": true,
    "data": [
        {
            "id": 10036,
            "user_agent": "Android; 9; google; Android SDK built for x86_64; Handset; Is Emulator; App Version: 0.7.3;",
            "ip_address": "192.168.1.74",
            "access_expire_at": "2019-11-25 20:23:00",
            "refresh_expire_at": "2019-12-09 14:23:00",
            "created_at": "2019-11-25 11:43:22",
            "updated_at": "2019-11-25 14:23:29"
        }
    ]
}

[ERROR]

{
    "result": false,
    "error": "User not found.",
}
```

## Удаление сессии
```
[DELETE] /api/v1/callback/sessions/<id_phperson>?session_id=<session_id>
[DELETE] /api/v1/callback/sessions/<id_phperson>?all=1

для удаления всех сессий исп. query параметр "all=1"

[RESPONSE]

{
    "result": true,
}

[ERROR]

{
    "result": false,
    "error": "User not found.",
}
```

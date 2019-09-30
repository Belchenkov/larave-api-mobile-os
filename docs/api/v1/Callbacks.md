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


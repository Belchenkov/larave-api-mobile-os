# Api методов авторизации  для МБ ГК Основа

Авторизация пользователя ведется по 2 токенам `accessToken` и `refreshToken`, которые имеют ограниченное время жизни. 
При всех запросах, требующих авторизацию необходимо отправлять `accessToken` в HTTP заголовке 
`Authorization: Bearer <accessToken>`. Токен `refreshToken` используется для обновления `accessToken` и имеет большее 
время жизни. При обновлении токенов и повторной авторизации выдаются новые `accessToken` и `refreshToken` токены, при 
этом старые удаляются.

#### POST /api/v1/auth/login

Метод авторизации пользователя.

<b>HEADERS</b>

```
Content-Type: application/json
User-Agent: *
```
 
<b>BODY</b>
 ```
{
    "email": {String|email},
    "pin_code": {String|size:4}
    "id_device": {String|null}
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
            <td>email</td>
            <td>Email пользователя</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>pin_code</td>
            <td>Пин-код пользователя сгенерированный интранет-порталом</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>id_device</td>
            <td>ID устройства</td>
            <td>Обязательно</td>
        </tr>
    </tbody>
</table>

<b>RESPONSE</b>

+ 200 OK

```
{
    "data": {
        "access_token": {String},
        "refresh_token": {String},
        "access_token_expire_at": {Number},
        "refresh_token_expire_at": {Number}
    },
    "result": {Boolean}
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
            <td>data.access_token</td>
            <td>Access токен</td>
        </tr>
        <tr>
            <td>data.refresh_token</td>
            <td>Refresh токен</td>
        </tr>
        <tr>
            <td>data.access_token_expire_at</td>
            <td>Unix метка истечения access токена</td>
        </tr>
        <tr>
            <td>data.refresh_token_expire_at</td>
            <td>Unix метка истечения refresh токена</td>
        </tr>
    </tbody>
</table>

#### POST /api/v1/auth/refresh

Метод для обновления `accessToken` и `refreshToken` токенов.

<b>HEADERS</b>

```
Content-Type: application/json
User-Agent: *
```
 
<b>BODY</b>
 ```
{
    "refresh_token": {String}
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
            <td>refreshToken</td>
            <td>Токен для получения нового access/refresh токенов</td>
            <td>Обязательно</td>
        </tr>
    </tbody>
</table>

<b>RESPONSE</b>

+ 200 OK

```
{
    "data": {
        "access_token": {String},
        "refresh_token": {String},
        "access_token_expire_at": {Number},
        "refresh_token_expire_at": {Number}
    },
    "result": {Boolean}
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
            <td>data.access_token</td>
            <td>Access токен</td>
        </tr>
        <tr>
            <td>data.refresh_token</td>
            <td>Refresh токен</td>
        </tr>
        <tr>
            <td>data.access_token_expire_at</td>
            <td>Unix метка истечения access токена</td>
        </tr>
        <tr>
            <td>data.refresh_token_expire_at</td>
            <td>Unix метка истечения refresh токена</td>
        </tr>
    </tbody>
</table>

#### POST /api/v1/auth/logout

Метод для выхода из аккаунта.

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```

<b>RESPONSE</b>

+ 200 OK

#### POST /api/v1/auth/session/clear

Метод для удаления всех сессий кроме текущей.

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```

<b>RESPONSE</b>

+ 200 OK


#### GET /api/v1/auth/me

Получение информации об авторизованном пользователе.

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```

<b>RESPONSE</b>

+ 200 OK

```
{
    "data": {
        "id": {Number},
        "ad_login": {String},
        "tab_no": {String},
        "id_person": {String},
        "email": {String},
        "created_at": {datetime}
    },
    "result": {Boolean}
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
            <td>ID</td>
        </tr>
        <tr>
            <td>data.ad_login</td>
            <td>Логин</td>
        </tr>
        <tr>
            <td>data.tab_no</td>
            <td>Табельный номер</td>
        </tr>
        <tr>
            <td>data.id_person</td>
            <td>ID из таблицы PhPerson</td>
        </tr>
        <tr>
            <td>data.email</td>
            <td>Email</td>
        </tr>
        <tr>
            <td>data.created_at</td>
            <td>Дата обновления пин-кода</td>
        </tr>
    </tbody>
</table>

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



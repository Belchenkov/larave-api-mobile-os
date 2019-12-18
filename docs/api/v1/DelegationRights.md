# Api методов делегирования полномочий для МБ ГК Основа

#### GET /api/v1/delegations

Метод получения всех делегированных прав текущего пользователя

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
            "from_whom": {
                "ad_login": {String},
                "tab_no": {String},
                "full_name": {String},
                "organisation": {String},
                "avatar": {
                    "name": {String},
                    "background": {String},
                    "color": {String},
                    "image": {String}
                },
            },
            "on_whom": {
                "ad_login": {String},
                "tab_no": {String},
                "full_name": {String},
                "organisation": {String},
                "avatar": {
                    "name": {String},
                    "background": {String},
                    "color": {String},
                    "image": {String}
                },
            },
            "period_start": {Datetime},
            "period_end": {Datetime},
            "is_active": {Boolean},
            "created_at": {Datetime},
        }
    ],
    "result": {Boolean},
    "debug": {
        "queries": {Int},
        "queries_time": {String}
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
    } 
}
```

#### GET /api/v1/delegations/{delegation_id}

Метод получения делегированного правила по id

<b>HEADERS</b>

```
Content-Type: application/json
User-Agent: *
```

```
Authorization: Bearer <accessToken>
```

<b>PARAMS</b>
 ```
{
    "delegation_id": {Int}
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
            <td>delegation_id</td>
            <td>ID правила</td>
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
        "from_whom": {
            "ad_login": {String},
            "tab_no": {String},
            "full_name": {String},
            "organisation": {String},
            "avatar": {
                "name": {String},
                "background": {String},
                "color": {String},
                "image": {String}
            },
        },
        "on_whom": {
            "ad_login": {String},
            "tab_no": {String},
            "full_name": {String},
            "organisation": {String},
            "avatar": {
                "name": {String},
                "background": {String},
                "color": {String},
                "image": {String}
            },
        },
        "period_start": {Datetime},
        "period_end": {Datetime},
        "is_active": {Boolean},
        "created_at": {Datetime},
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
            <td>ID правила</td>
        </tr>
        <tr>
            <td>data.period_start</td>
            <td>Время начала действия делегированного правила</td>
        </tr>
        <tr>
            <td>data.period_end</td>
            <td>Время окончания действия делегированного правила</td>
        </tr>
        <tr>
            <td>data.is_active</td>
            <td>Статус делегированного правила</td>
        </tr>
        <tr>
            <td>data.from_whom.ad_login</td>
            <td>AD сотрудника делегировавщего свои права</td>
        </tr>
        <tr>
            <td>data.from_whom.tab_no</td>
            <td>Табельный номер сотрудника делегировавщего свои права</td>
        </tr>
        <tr>
            <td>data.from_whom.full_name</td>
            <td>ФИО сотрудника делегировавщего свои права</td>
        </tr>
        <tr>
            <td>data.from_whom.organisation</td>
            <td>Организация сотрудника делегировавщего свои права</td>
        </tr>
        <tr>
            <td>data.from_whom.avatar.name</td>
            <td>Первая буквы фамилии и имени сотрудника делегировавщего свои права</td>
        </tr>
        <tr>
            <td>data.from_whom.avatar.background</td>
            <td>Фон аватарки сотрудника делегировавщего свои права</td>
        </tr>
        <tr>
            <td>data.from_whom.avatar.color</td>
            <td>Цвет шрифта аватарки сотрудника делегировавщего свои права</td>
        </tr>
        <tr>
            <td>data.from_whom.avatar.image</td>
            <td>Аватар сотрудника делегировавщего свои права</td>
        </tr>  
        <tr>
            <td>data.on_whom.ad_login</td>
            <td>AD сотрудника, которому делегировали права</td>
        </tr>
        <tr>
            <td>data.on_whom.tab_no</td>
            <td>Табельный номер сотрудника, которому делегировали права</td>
        </tr>
        <tr>
            <td>data.on_whom.full_name</td>
            <td>ФИО сотрудника, которому делегировали права</td>
        </tr>
        <tr>
            <td>data.on_whom.organisation</td>
            <td>Организация сотрудника, которому делегировали права</td>
        </tr>
        <tr>
            <td>data.on_whom.avatar.name</td>
            <td>Первая буквы фамилии и имени сотрудника, которому делегировали права</td>
        </tr>
        <tr>
            <td>data.on_whom.avatar.background</td>
            <td>Фон аватарки сотрудника, которому делегировали права</td>
        </tr>
        <tr>
            <td>data.on_whom.avatar.color</td>
            <td>Цвет шрифта аватарки сотрудника, которому делегировали права</td>
        </tr>
        <tr>
            <td>data.on_whom.avatar.image</td>
            <td>Аватар сотрудника, которому делегировали права</td>
        </tr>
        <tr>
            <td>data.created_at</td>
            <td>Время добавления правила</td>
        </tr>
    </tbody>
</table>

#### POST /api/v1/delegations

Создание делегированного правила

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
    "on_whom": {uuid},
    "period_start": {Datetime [Y-m-d H:i:s] | before:period_end},
    "period_end": {Datetime [Y-m-d H:i:s] | after:period_start},
    "is_active": {Int}
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
            <td>on_whom</td>
            <td>AD сотрудника, которому делегировали полномочия</td>
        </tr>
        <tr>
            <td>period_start</td>
            <td>Время начала действия делегированного правила</td>
        </tr>
        <tr>
            <td>period_end</td>
            <td>Время окончания действия делегированного правила</td>
        </tr>
        <tr>
            <td>is_active</td>
            <td>Статус делегированного правила</td>
        </tr>
    </tbody>
</table> 

<b>RESPONSE</b>

+ 200 OK

```
{
    "result": {Boolean},
    "debug": {
        "queries": {Int},
        "queries_time": {String}
    }
}
```

#### POST /api/v1/delegations/{delegation_id}

Редактирование делегированного правила

<b>HEADERS</b>

```
Content-Type: application/json
User-Agent: *
```

```
Authorization: Bearer <accessToken>
```

<b>PARAMS</b>
 ```
{
    "delegation_id": {Int}
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
            <td>delegation_id</td>
            <td>ID правила</td>
            <td>Обязательно</td>
        </tr>
    </tbody>
</table> 

<b>BODY</b>
 ```
{
    "is_active": {Int}
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
            <td>is_active</td>
            <td>Статус делегированого правила (сделать активным === 1)</td>
            <td>Обязательно</td>
        </tr>
    </tbody>
</table> 

<b>RESPONSE</b>

+ 200 OK

```
{
    "result": {Boolean},
    "debug": {
        "queries": {Int},
        "queries_time": {String}
    }
}
```

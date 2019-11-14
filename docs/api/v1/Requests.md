# Api методов получения заявок для МБ ГК Основа

#### GET /api/v1/request/pass

Метод получения всех заявок на пропуск текущего пользователя

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
    "data": {
        "id": {Int},
        "id_doc": {Uuid},
        "name": {String},
        "description": {String},
        "pass_type": {String},
        "status": {String},
        "employee": {String},
        "error_message": {String},
        "office": {
            "id": {String},
            "code": {String},
            "name": {String}
        },
        "visitors": {
            "visitor": {String},
            "description": {String},
            "annotation": {String},
            "date_start": {Datetime}
            "date_end": {Datetime}
        },
        "created_at": {Datetime}
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
            <td>ID заявки</td>
        </tr>
        <tr>
            <td>data.id_doc</td>
            <td>ID документа</td>
        </tr> 
        <tr>
            <td>data.name</td>
            <td>Название заявки</td>
        </tr>
        <tr>
            <td>data.description</td>
            <td>Комментарий к заявки</td>
        </tr>
        <tr>
            <td>data.pass_type</td>
            <td>Тип заявки на пропуск</td>
        </tr>
        <tr>
            <td>data.status</td>
            <td>Статус заявки</td>
        </tr>
        <tr>
            <td>data.employee</td>
            <td>Сотрудник выдавший заявку на пропуск</td>
        </tr>
        <tr>
            <td>data.error_message</td>
            <td>Сообщение об ошибке</td>
        </tr>
        <tr>
            <td>data.office.id</td>
            <td>ID офиса</td>
        </tr>
        <tr>
            <td>data.office.code</td>
            <td>Код офиса</td>
        </tr>
        <tr>
            <td>data.office.name</td>
            <td>Название офиса</td>
        </tr>
        <tr>
            <td>data.visitors.visitor</td>
            <td>Посетители (на кого выписана заявка) - перечисление в строке через запятую</td>
        </tr>
        <tr>
            <td>data.visitors.description</td>
            <td>Цель визита</td>
        </tr>
        <tr>
            <td>data.visitors.annotation</td>
            <td>Телефон посетителя - перечисление в строке через ;</td>
        </tr>
        <tr>
            <td>data.visitors.date_start</td>
            <td>Время начала действия пропуска</td>
        </tr>
        <tr>
            <td>data.visitors.date_end</td>
            <td>Время окончания действия пропуска</td>
        </tr>
        <tr>
            <td>data.created_at</td>
            <td>Дата создание записи</td>
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


#### GET /api/v1/request/pass/{id}

Метод получения заявки на пропуск по id

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```
<b>BODY</b>
 ```
{
    "id": {Int}
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
            <td>id</td>
            <td>ID заявки на пропуск</td>
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
        "id_doc": {Uuid},
        "name": {String},
        "description": {String},
        "pass_type": {String},
        "status": {String},
        "employee": {String},
        "error_message": {String},
        "office": {
            "id": {String},
            "code": {String},
            "name": {String}
        },
        "visitors": {
            "visitor": {String},
            "description": {String},
            "annotation": {String},
            "date_start": {Datetime}
            "date_end": {Datetime}
        },
        "created_at": {Datetime}
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
        </tr>
        <tr>
            <td>data.id_doc</td>
            <td>ID документа</td>
        </tr> 
        <tr>
            <td>data.name</td>
            <td>Название заявки</td>
        </tr>
        <tr>
            <td>data.name</td>
            <td>Название заявки</td>
        </tr>
        <tr>
            <td>data.description</td>
            <td>Комментарий к заявки</td>
        </tr>
        <tr>
            <td>data.pass_type</td>
            <td>Тип заявки на пропуск</td>
        </tr>
        <tr>
            <td>data.status</td>
            <td>Статус заявки</td>
        </tr>
        <tr>
            <td>data.employee</td>
            <td>Сотрудник выдавший заявку на пропуск</td>
        </tr>
        <tr>
            <td>data.error_message</td>
            <td>Сообщение об ошибке</td>
        </tr>
        <tr>
            <td>data.office.id</td>
            <td>ID офиса</td>
        </tr>
        <tr>
            <td>data.office.code</td>
            <td>Код офиса</td>
        </tr>
        <tr>
            <td>data.office.name</td>
            <td>Название офиса</td>
        </tr>
        <tr>
            <td>data.visitors.visitor</td>
            <td>Посетители (на кого выписана заявка) - перечисление в строке через запятую</td>
        </tr>
        <tr>
            <td>data.visitors.description</td>
            <td>Цель визита</td>
        </tr>
        <tr>
            <td>data.visitors.annotation</td>
            <td>Телефон посетителя - перечисление в строке через ;</td>
        </tr>
        <tr>
            <td>data.visitors.date_start</td>
            <td>Время начала действия пропуска</td>
        </tr>
        <tr>
            <td>data.visitors.date_end</td>
            <td>Время окончания действия пропуска</td>
        </tr>
        <tr>
            <td>data.created_at</td>
            <td>Дата создание записи</td>
        </tr>
    </tbody>
</table>

#### POST /api/v1/request/pass/create

Метод создания заявки на пропуск

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```
<b>BODY</b>
 ```
{
    "visitors": {Array},
    "phones": {Array},
    "office_id": {Uuid},
    "type": {String},
    "comment": {String},
    "date": {Datetime}
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
            <td>visitors</td>
            <td>Список посетителей</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>phones</td>
            <td>Список телефонов посетителей</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>office_id</td>
            <td>Uuid офиса</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>type</td>
            <td>Тип заявки на пропуск</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>comment</td>
            <td>Комментарий заявки на пропуск</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>date</td>
            <td>Дата создания заявки на пропуск</td>
            <td>Обязательно</td>
        </tr>
    </tbody>
</table> 


<b>RESPONSE</b>

+ 200 OK

```
{
    "data": {
        "id": {Int}
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
            <td>ID созданной заявки</td>
        </tr>
    </tbody>
</table>

#### GET /api/v1/request/support

Метод получения всех заявок на поддержку (Заявка в Службу Технической поддержки = 1, Заявка в Службу АХО = 2, Заявка в Службу Эксплуатации = 3)

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
    "type_request": {Int|[1, 2, 3]}
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
            <td>id</td>
            <td>Тип заявки</td>
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
        "user_id": {Int},
        "type_request": {String},
        "comment": {String},
        "from": {String},
        "to": {String},
        "is_send": {Bool},
        "created_at": {Datetime}
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
            <td>ID заявки</td>
        </tr>
        <tr>
            <td>data.user_id</td>
            <td>ID заявителя</td>
        </tr> 
        <tr>
            <td>data.type_request</td>
            <td>Тип заявки</td>
        </tr>
        <tr>
            <td>data.comment</td>
            <td>Комментарий к заявки</td>
        </tr>
        <tr>
            <td>data.from</td>
            <td>Почта с которой поступила заявка</td>
        </tr>
        <tr>
            <td>data.to</td>
            <td>Почта на которой поступила заявка</td>
        </tr>
        <tr>
            <td>data.is_send</td>
            <td>Статус отправки заявки на почту поддержки</td>
        </tr>
        <tr>
            <td>data.created_at</td>
            <td>Дата создание заявки</td>
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

#### GET /api/v1/request/support/{id}

Метод получения заявоки на поддержку по id

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
    "id": {Int}
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
            <td>id</td>
            <td>ID заявки</td>
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
        "user_id": {Int},
        "type_request": {String},
        "comment": {String},
        "from": {String},
        "to": {String},
        "is_send": {Bool},
        "created_at": {Datetime}
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
        </tr>
        <tr>
            <td>data.user_id</td>
            <td>ID заявителя</td>
        </tr> 
        <tr>
            <td>data.type_request</td>
            <td>Тип заявки</td>
        </tr>
        <tr>
            <td>data.comment</td>
            <td>Комментарий к заявки</td>
        </tr>
        <tr>
            <td>data.from</td>
            <td>Почта с которой поступила заявка</td>
        </tr>
        <tr>
            <td>data.to</td>
            <td>Почта на которой поступила заявка</td>
        </tr>
        <tr>
            <td>data.is_send</td>
            <td>Статус отправки заявки на почту поддержки</td>
        </tr>
        <tr>
            <td>data.created_at</td>
            <td>Дата создание заявки</td>
        </tr>
    </tbody>
</table>

#### POST /api/v1/request/support

Метод отправки заявки на почту поддержку 

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```
<b>BODY</b>
 ```
{
    "comment": {String},
    "type_request": {Int | in [1, 2, 3]}
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
            <td>comment</td>
            <td>Комментарий к заявке</td>
            <td>Обязательно</td>
        </tr>
        <tr>
            <td>type_request</td>
            <td>Тип заявки на поддержку</td>
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

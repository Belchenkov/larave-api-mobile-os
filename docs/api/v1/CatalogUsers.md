# Api методов получения справочника сотрудников для МБ ГК Основа

#### GET /api/v1/users/catalog

Метод для получения справочника сотрудников. Поиск возможен по ФИО сотрудников, должностям и подразделениям.

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```

<b>BODY</b>
 ```
{
    "search": {String|null}
}
```

<b>RESPONSE</b>

+ 200 OK

```
{
    "data": {
        "in_office": {Boolean},
        "full_name": {String},
        "department_name": {String},
        "avatar": {
            "name": {String},
            "background": {String},
            "color": {String}
        },
        "position": {String},
        "tab_no": {String},
        "id_phperson": {String},
        "department_guid": {String}
    },
    "links": {
        "first": {String},
        "last": {String},
        "prev": {String},
        "next": {String}
    },
    "meta": {
        "current_page": {Int},
        "from": {Int},
        "path": {String},
        "per_page": {Int}
        "to": {Int}
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
            <td>data.in_office</td>
            <td>Статус сотрудника (на территории/вне)</td>
        </tr>
         <tr>
            <td>data.full_name</td>
            <td>ФИО</td>
        </tr>
        <tr>
            <td>data.department_name</td>
            <td>Подразделение</td>
        </tr>
        <tr>
            <td>data.position</td>
            <td>Должность</td>
        </tr>
        <tr>
            <td>data.tab_no</td>
            <td>Табельный номер</td>
        </tr>
        <tr>
            <td>data.id_phperson</td>
            <td>ID из таблицы PhPerson</td>
        </tr>
         <tr>
            <td>data.department_guid</td>
            <td>ID из таблицы Department</td>
        </tr>
        <tr>
            <td>data.avatar.name</td>
            <td>Первая буквы фамилии и имени</td>
        </tr>
        <tr>
            <td>data.avatar.background</td>
            <td>Фон</td>
        </tr>
        <tr>
            <td>data.avatar.color</td>
            <td>Цвет шрифта</td>
        </tr>
        <tr>
            <td>links.first</td>
            <td>Первая страница (Пагинация)</td>
         </tr>
         <tr>
            <td>links.last</td>
            <td>Последняя страница (Пагинация)</td>
         </tr>
         <tr>
            <td>links.prev</td>
            <td>Предыдущая страница (Пагинация)</td>
         </tr>
         <tr>
            <td>links.next</td>
            <td>Следующая страница (Пагинация)</td>
        </tr>
        <tr>
            <td>meta.current_page</td>
            <td>Номер текущей страницы (Пагинация)</td>
        </tr>
        <tr>
            <td>meta.from</td>
            <td>Номер первой записи на текущей странице</td>
        </tr>
        <tr>
            <td>meta.path</td>
            <td>URL</td>
        </tr>
        <tr>
            <td>meta.per_page</td>
            <td>Кол-во записей на страницы</td>
        </tr>
        <tr>
            <td>meta.to</td>
            <td>Номер последней записи на текущей странице</td>
        </tr>
    </tbody>
</table>

#### GET /api/v1/users/catalog/{tab_no}

Метод получения информации о сотруднике

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```

<b>BODY</b>
 ```
{
    "tab_no": {String}
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
            <td>tab_no</td>
            <td>Табельный номер сотрудника</td>
        </tr>
    </tbody>
</table> 


<b>RESPONSE</b>

+ 200 OK

```
{
    "data": {
        "in_office": {Boolean},
        "full_name": {String},
        "avatar": {
            "name": {String},
            "background": {String},
            "color": {String}
        },
        "position": {String},
        "unit": {String},
        "email": {String},
        "address_office": {String},
        "cabinet": {String},
        "work_phone": {String},
        "mobile_phone": {String},
        "amount_holiday_days": {Int},
        "schedule": {String},
        "status": {String},
        "chief": {String},
        "chief_main": {String}
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
            <td>data.in_office</td>
            <td>Статус сотрудника (на территории/вне)</td>
        </tr>
         <tr>
            <td>data.full_name</td>
            <td>ФИО</td>
        </tr>
        <tr>
            <td>data.avatar.name</td>
            <td>Первая буквы фамилии и имени</td>
        </tr>
        <tr>
            <td>data.avatar.background</td>
            <td>Фон</td>
        </tr>
        <tr>
            <td>data.avatar.color</td>
            <td>Цвет шрифта</td>
        </tr>
        <tr>
            <td>data.unit</td>
            <td>Подразделение</td>
        </tr>
        <tr>
            <td>data.position</td>
            <td>Должность</td>
        </tr>
        <tr>
            <td>data.email</td>
            <td>Почта</td>
        </tr>
        <tr>
            <td>data.address_office</td>
            <td>Адрес офиса</td>
        </tr>
        <tr>
            <td>data.cabinet</td>
            <td>Кабинет</td>
        </tr>
        <tr>
            <td>data.work_phone</td>
            <td>Рабочий телефон</td>
        </tr>
        <tr>
            <td>data.mobile_phone</td>
            <td>Мобильный телефон</td>
        </tr>
        <tr>
            <td>data.amount_holiday_days</td>
            <td>Кол-во отпускных дней</td>
        </tr>
        <tr>
            <td>data.schedule</td>
            <td>График</td>
        </tr>
        <tr>
            <td>data.status</td>
            <td>Статус работника</td>
        </tr>
        <tr>
            <td>data.chief</td>
            <td>Функциональный руководитель</td>
        </tr>
        <tr>
            <td>data.chief_main</td>
            <td>Основной руководитель</td>
        </tr>
    </tbody>
</table>


#### GET /api/v1/users/catalog/{tab_no}/visits

Метод получения статистики посещаемости сотрудника

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```

<b>BODY</b>
 ```
{
    "tab_no": {String},
    "previous": {Int|null}
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
            <td>tab_no</td>
            <td>Табельный номер сотрудника</td>
        </tr>
        <tr>
            <td>previous</td>
            <td>Метка времени(Следующие записи)</td>
        </tr>
    </tbody>
</table> 


<b>RESPONSE</b>

+ 200 OK

```

{
    "result": {Boolean},
    "data": {
        "date": {
            "enter_time": {String},
            "exit_time": {String},
            "work_time": {String},
            "idle_time": {String},
            "territory_time": {String},
            "is_late": {Boolean},
            "is_earlier": {Boolean},
            "empty": {Boolean},
            "holiday": {Boolean},
            "doc_num": {String},
            "status": {String},
            "day_of_week": {String}
        }, 
       }, 
       "meta": {
         "schedule": {
            "time_in": {String},
            "time_out": {String}
         },
        "previous": {Int}
       }, 
       "links": {
            "first": {String},
            "next": {String}
        } 
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
            <td>data.date.enter_time</td>
            <td>Время прибытия</td>
        </tr>
        <tr>
            <td>data.date.exit_time</td>
            <td>Время ухода</td>
        </tr>
         <tr>
            <td>data.date.work_time</td>
            <td>Рабочее время</td>
        </tr>
        <tr>
            <td>data.date.idle_time</td>
            <td>Вне территории (Перерывы)</td>
        </tr>
        <tr>
            <td>data.date.territory_time</td>
            <td>На территории (Включая перерывы)</td>
        </tr>
         <tr>
            <td>data.date.is_late</td>
            <td>Приход позже</td>
        </tr>
        <tr>
            <td>data.date.is_earlier</td>
            <td>Уход раньше</td>
        </tr>
        <tr>
            <td>data.date.empty</td>
            <td>Нерабочий день</td>
        </tr>
        <tr>
            <td>data.date.holiday</td>
            <td>Сотрудник в отпуске</td>
        </tr>
        <tr>
            <td>data.date.doc_num</td>
            <td>Номер документа</td>
        </tr>
        <tr>
            <td>data.date.status</td>
            <td>Статус</td>
        </tr>
        <tr>
            <td>data.date.day_of_week</td>
            <td>День недели</td>
        </tr>
        <tr>
            <td>meta.schedule.time_in</td>
            <td>Время прибытия по графику</td>
        </tr>
        <tr>
            <td>meta.schedule.time_out</td>
            <td>Время ухода по графику</td>
        </tr>
         <tr>
            <td>meta.previous</td>
            <td>Временная метка для получения следующих записей</td>
        </tr>
        <tr>
            <td>links.first</td>
            <td>Первая страница (Пагинация)</td>
        </tr>
        <tr>
            <td>links.next</td>
            <td>Следующая страница (Пагинация)</td>
        </tr>
    </tbody>
</table>

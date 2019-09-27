# Api методов получения информации о профиле сотрудника для МБ ГК Основа

#### GET /api/v1/profile

Метод получения личной кадровой информации пользователя

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```

<b>RESPONSE</b>

+ 200 OK

```
{
    "data": {
        "in_office": {Boolean},
        "fullName": {String},
        "position": {String},
        "unit": {String},
        "email": {String},
        "address_office": {String},
        "cabinet": {String},
        "work_phone": {String},
        "mobile_phone": {String},
        "amount_holiday_days": {String},
        "schedule": {String},
        "status": {String},
        "is_chief": {Boolean},
        "chief": {String},
        "chief_main": {String},
        "tab_no": {String},
        "id_phperson": {String},
        "department_guid": {String},
        "department_guid_real": {String},
        "avatar": {
            "name": {String},
            "background": {String},
            "color": {String}
        },
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
            <td>data.fullName</td>
            <td>ФИО</td>
        </tr>
        <tr>
            <td>data.position</td>
            <td>Должность</td>
        </tr>
        <tr>
            <td>data.unit</td>
            <td>Подразделение</td>
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
            <td>Статус</td>
        </tr>
        <tr>
            <td>data.is_chief</td>
            <td>Является руководителем подразделения</td>
         </tr>
         <tr>
            <td>data.chief</td>
            <td>Функциональный руководитель</td>
         </tr>
         <tr>
            <td>data.chief_main</td>
            <td>Основной руководитель</td>
         </tr>
         <tr>
            <td>data.tab_no</td>
            <td>Табельный номер</td>
        </tr>
        <tr>
           <td>data.id_phperson</td>
           <td>ID из таблицы transit_1c_PhPerson</td>
        </tr>
        <tr>
           <td>data.department_guid</td>
           <td>ID из таблицы ID из таблицы transit_1c_department</td>
        </tr>
        <tr>
           <td>data.department_guid_real</td>
           <td>ID из таблицы transit_1c_link_department</td>
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
    </tbody>
</table>

#### GET /api/v1/profile/statistic/visit

Метод получения статистики посещаемости пользователя

<b>HEADERS</b>

```
Authorization: Bearer <accessToken>
```

<b>BODY</b>
 ```
{
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
            <td>data.data.date.enter_time</td>
            <td>Время прибытия</td>
        </tr>
        <tr>
            <td>data.data.date.exit_time</td>
            <td>Время ухода</td>
        </tr>
         <tr>
            <td>data.data.date.work_time</td>
            <td>Рабочее время</td>
        </tr>
        <tr>
            <td>data.data.date.idle_time</td>
            <td>Вне территории (Перерывы)</td>
        </tr>
        <tr>
            <td>data.data.date.territory_time</td>
            <td>На территории (Включая перерывы)</td>
        </tr>
         <tr>
            <td>data.data.date.is_late</td>
            <td>Приход позже</td>
        </tr>
        <tr>
            <td>data.data.date.is_earlier</td>
            <td>Уход раньше</td>
        </tr>
        <tr>
            <td>data.data.date.empty</td>
            <td>Нерабочий день</td>
        </tr>
        <tr>
            <td>data.data.date.holiday</td>
            <td>Сотрудник в отпуске</td>
        </tr>
        <tr>
            <td>data.data.date.doc_num</td>
            <td>Номер документа</td>
        </tr>
        <tr>
            <td>data.data.date.status</td>
            <td>Статус</td>
        </tr>
        <tr>
            <td>data.data.date.day_of_week</td>
            <td>День недели</td>
        </tr>
        <tr>
            <td>data.meta.schedule.time_in</td>
            <td>Время прибытия по графику</td>
        </tr>
        <tr>
            <td>data.meta.schedule.time_out</td>
            <td>Время ухода по графику</td>
        </tr>
         <tr>
            <td>data.meta.previous</td>
            <td>Временная метка для получения следующих записей</td>
        </tr>
        <tr>
            <td>data.links.first</td>
            <td>Первая страница (Пагинация)</td>
        </tr>
        <tr>
            <td>data.links.next</td>
            <td>Следующая страница (Пагинация)</td>
        </tr>
    </tbody>
</table>

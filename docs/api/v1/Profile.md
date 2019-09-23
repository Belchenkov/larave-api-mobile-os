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
        "fullName": {String},
        "position": {String},
        "unit": {String},
        "address_office": {String},
        "cabinet": {String},
        "work_phone": {String},
        "mobile_phone": {String},
        "amount_holiday_days": {String},
        "schedule": {String},
        "status": {String},
        "chief": {String}
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
            <td>data.chief</td>
            <td>Руководитель</td>
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
    "data": {
       "schedule": {
           "name": {String}, 
           "schedule": {
                "date_in": {Datetime},
                "date_out": {Datetime}
            }, 
            "user_info": {
                "name": {String},
                "position": {String}
            }, 
            "days": {
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
                }
            }, 
            "previous": {Int}
        } 
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
            <td>data.schedule.name</td>
            <td>График работы</td>
        </tr
        > <tr>
            <td>data.schedule.schedule.date_in</td>
            <td>Время прибытия по графику</td>
        </tr>
         <tr>
            <td>data.schedule.schedule.date_out</td>
            <td>Время ухода по графику</td>
        </tr>
         <tr>
            <td>user_info.name</td>
            <td>ФИО сотрудника</td>
        </tr>
         <tr>
            <td>user_info.position</td>
            <td>Должность сотрудника</td>
        </tr>
        <tr>
            <td>days.date.enter_time</td>
            <td>Время прибытия</td>
        </tr>
        <tr>
            <td>days.date.exit_time</td>
            <td>Время ухода</td>
        </tr>
         <tr>
            <td>days.date.work_time</td>
            <td>Рабочее время</td>
        </tr>
        <tr>
            <td>days.date.idle_time</td>
            <td>Вне территории (Перерывы)</td>
        </tr>
        <tr>
            <td>days.date.territory_time</td>
            <td>На территории (Включая перерывы)</td>
        </tr>
         <tr>
            <td>days.date.is_late</td>
            <td>Приход позже</td>
        </tr>
        <tr>
            <td>days.date.is_earlier</td>
            <td>Уход раньше</td>
        </tr>
        <tr>
            <td>days.date.empty</td>
            <td>Нерабочий день</td>
        </tr>
        <tr>
            <td>days.date.holiday</td>
            <td>Сотрудник в отпуске</td>
        </tr>
        <tr>
            <td>days.date.doc_num</td>
            <td>Номер документа</td>
        </tr>
        <tr>
            <td>days.date.status</td>
            <td>Статус</td>
        </tr>
        <tr>
            <td>days.date.day_of_week</td>
            <td>День недели</td>
        </tr>
    </tbody>
</table>

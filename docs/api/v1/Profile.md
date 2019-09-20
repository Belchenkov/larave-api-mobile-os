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

<b>RESPONSE</b>

+ 200 OK

```
{
    "data": {
        
    },
    "result": {Boolean}
}
```

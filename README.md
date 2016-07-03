# Работа с данными от Центрального Банка России

[XML от cbr.ru](http://www.cbr.ru/scripts/Root.asp?PrtId=SXML)

## Установка через composer

```json
{
	"akiyatkin/cbr":"~1"
}
```

## Использование с [infrajs/controller](https://github.com/infrajs/controller)

Подключить слой

```json
{
	"external":"-cbr/today.layer.json"
}
```
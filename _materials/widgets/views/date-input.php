<?php

use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var string $inputName */
/** @var string $inputId */
/** @var int $monthsCount */

// Так как календарь будем строить начиная с текущего месяца, создаем экземпляр объекта DateTime
// на основе формата 'Y-m-d'. В качестве значения передаем текущую дату, которая будет состоять из:
// Y - текущего года
// m - текущего месяца
// 01 - и задаем константой первое число месяца, вместо текущего(d), для исключения коллизий при прибавлении месяца,
// которые могут возникнуть в случае отсутствия текущего дня в следующем месяца
$currentMonthDate = DateTime::createFromFormat('Y-m-d', date('Y-m-01'));
$monthsDropDownListValues = [];

// Далее в верхнеуровневом цикле(по $i) мы генерируем конкретные страницы для одного месяца в календаре
$calendarPages = [];
for ($i = 0, $monthDate = clone $currentMonthDate; $i < $monthsCount; $i++, $monthDate->modify('+1 month')) {
    // Формируем ассоциативный массив значений/тайтлов для дропдауна названия месяцев(пример: ['2020-11' => 'November', ....] )
    $monthsDropDownListValues[$monthDate->format('Y-m')] = $monthDate->format('F, Y');

    $calendarPage = [];
    $calendarPageDate = clone $monthDate;

    // "отматываем" дату $calendarPageDate до понедельника, так как дни календаря в хидере у нас начинаются именно с него,
    // даты мы так же должны начинать ставить именно с понедельника. Например если первое число($calendarPageDate), будет
    // являться четвергом, то операция $calendarPageDate->modify('monday this week')->format('Y-m-d') "отмотает" эту дату
    // до понедельника, при этом изменив месяц этой даты на предыдущий, и мы начнем проставлять числа с ~28 числа прошлого месяца
    $calendarPageDate->modify('monday this week');

    // построчно формируем страницу календаря
    do {
        $calendarPageRow = [];
        for ($weekDaysCount = 1; $weekDaysCount <= 7; $weekDaysCount++, $calendarPageDate->modify('+1 day')) {
            $calendarPageRow[] = [
                'label' => $calendarPageDate->format('j'),
                'date' => $calendarPageDate->format('Y-m-d'),
                'active' => $calendarPageDate->format('m') == $monthDate->format('m')
            ];
        }
        $calendarPage[] = $calendarPageRow;
    } while ($calendarPageDate->format('m') <= $monthDate->format('m') && $calendarPageDate->format('y') <= $monthDate->format('y'));

    // добавляем страницу календаря в общий массив страниц указывая при этом, к какому месяцу она относится
    $calendarPages[] = [
        'month' => $monthDate->format('Y-m'),
        'rows' => $calendarPage
    ];
}

$monthsDropDownListId = "{$inputId}-month-title";
$calendarPageIdPrefix = "{$inputId}-calendar-page-";

$jsChangeMonth = <<<JS
    $('#{$monthsDropDownListId}').on('change', function(e) {
        let selectedMonth = $('#{$monthsDropDownListId}').val();
        $('.select-date-table').hide();
        $('#{$calendarPageIdPrefix}' + selectedMonth).show();
    });
JS;
$jsSelectDate = <<<JS
    $('.date-select').on('click', function(e) {
        $('#{$inputId}').val($(e.target).data('date'));
    });
JS;

$this->registerJs($jsChangeMonth, View::POS_END);
$this->registerJs($jsSelectDate, View::POS_END);
?>

<div class="date-input-widget">
    <div class="event-date-wrapper">
        <div class="grid-view">
            <table class="event-date-table-header">
                <thead>
                <tr>
                    <th colspan="7">
                        <?= Html::dropDownList($monthsDropDownListId, null, $monthsDropDownListValues, [
                            'class' => 'form-control', 'id' => $monthsDropDownListId,
                            'prompt' => ['text' => 'none', 'options'=> ['disabled' => true]]]) ?>
                    </th>
                </tr>
                <tr>
                    <th>MON</th>
                    <th>TUE</th>
                    <th>WED</th>
                    <th>THU</th>
                    <th>FRI</th>
                    <th>SAT</th>
                    <th>SUN</th>
                </tr>
                </thead>
            </table>

            <?php foreach ($calendarPages as $index => $calendarPage) : ?>
                <table id="<?= $calendarPageIdPrefix . $calendarPage['month'] ?>"
                    class="select-date-table"
                    style="<?= $index === 0 ? 'display: table' : 'display: none' ?>">
                    <tbody>
                        <?php foreach ($calendarPage['rows'] as $calendarPageRow) : ?>
                            <tr>
                                <?php foreach ($calendarPageRow as $calendarPageDate) : ?>
                                    <td>
                                        <?= Html::tag(
                                            'div', $calendarPageDate['label'],
                                            [
                                                'class' => $calendarPageDate['active'] ? 'date-select' : 'date-select disabled',
                                                'data-date' => $calendarPageDate['date']
                                            ]
                                        ) ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
        </div>
    </div>

    <?= Html::hiddenInput($inputName, null, ['id' => $inputId, 'name' => $inputName]) ?>
</div>

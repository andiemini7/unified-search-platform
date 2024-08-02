<?php
$title = get_sub_field('title');

$currentMonth = date('F');
$currentYear = date('Y');

$daysInMonth = cal_days_in_month(CAL_GREGORIAN, date('n'), $currentYear);

$firstDayOfMonth = date('w', strtotime("$currentYear-$currentMonth-01"));

$currentDayOfWeek = date('w');

$currentDay = date('j');

$events = get_sub_field('events');
?>

<div class="calendar-module text-center mb-[30px]">
    <div class="calendar-header flex justify-around items-baseline font-bold m-[10px]">
        <h2 class="calendar-title text-[24px]"><?php echo esc_html($title); ?></h2>
        <div class="month-btn flex items-center">
            <span class="calendar-month-year items-center flex"><?php echo $currentMonth . ', ' . $currentYear; ?></span>
        </div>
    </div>
    <div class="calendar w-[80%] inline-block border border-[#ddd] rounded-[10px] overflow-hidden">
        <div class="calendar-body flex flex-col">
            <div class="calendar-row calendar-days flex">
                <div class="calendar-day <?php echo $currentDayOfWeek == 0 ? 'today' : ''; ?>">Sun</div>
                <div class="calendar-day <?php echo $currentDayOfWeek == 1 ? 'today' : ''; ?>">Mon</div>
                <div class="calendar-day <?php echo $currentDayOfWeek == 2 ? 'today' : ''; ?>">Tue</div>
                <div class="calendar-day <?php echo $currentDayOfWeek == 3 ? 'today' : ''; ?>">Wed</div>
                <div class="calendar-day <?php echo $currentDayOfWeek == 4 ? 'today' : ''; ?>">Thu</div>
                <div class="calendar-day <?php echo $currentDayOfWeek == 5 ? 'today' : ''; ?>">Fri</div>
                <div class="calendar-day <?php echo $currentDayOfWeek == 6 ? 'today' : ''; ?>">Sat</div>
            </div>
            <div class="calendar-row">
                <?php
                for ($i = 0; $i < $firstDayOfMonth; $i++) {
                    echo '<div class="calendar-cell empty"></div>';
                }

                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $class = $day == $currentDay ? 'calendar-cell daytoday ' : 'calendar-cell ';
                    echo '<div class="' . $class . '" data-day="' . $day . '">' . $day;

                    if (!empty($events)) {
                        foreach ($events as $event) {
                            $eventDay = date('j', strtotime($event['date']));
                            if ($eventDay == $day) {
                                echo '<div class="event-title bg-[#f900001c] text-[#ff4d00] rounded p-[0.40rem] font-bold mb-[3px] cursor-pointer" data-description="' . esc_attr($event['description']) . '" data-date="' . esc_attr($event['date']) . '" data-time-range="' . esc_attr($event['start_time'] . ' - ' . $event['end_time']) . '">' . esc_html($event['title']) . ' (' . esc_html($event['start_time'] . ' - ' . $event['end_time']) . ')</div>';
                            }
                        }
                    }

                    echo '</div>';

                    if (($firstDayOfMonth + $day) % 7 == 0) {
                        echo '</div><div class="calendar-row">';
                    }
                }

                $remainingCells = 7 - (($firstDayOfMonth + $daysInMonth) % 7);
                if ($remainingCells < 7) {
                    for ($i = 0; $i < $remainingCells; $i++) {
                        echo '<div class="calendar-cell empty"></div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div id="tooltips" class="tooltips hidden absolute bg-gray-700 text-white p-2 rounded z-10"></div>

<script>
document.addEventListener('mouseover', function(event) {
    if (event.target.classList.contains('event-title')) {
        const tooltips = document.getElementById('tooltips');
        tooltips.innerHTML = `<strong>${event.target.innerText}</strong><br>${event.target.dataset.description}<br>${event.target.dataset.date} - ${event.target.dataset.timeRange}`;
        tooltips.style.top = event.pageY + 10 + 'px';
        tooltips.style.left = event.pageX + 10 + 'px';
        tooltips.classList.remove('hidden');
    }
});

document.addEventListener('mouseout', function(event) {
    if (event.target.classList.contains('event-title')) {
        const tooltips = document.getElementById('tooltips');
        tooltips.classList.add('hidden');
    }
});
</script>

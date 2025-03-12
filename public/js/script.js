window.addEventListener("load", function() {

const { Mask, MaskInput, vMaska } = Maska;

    if(document.querySelector('#reg_tel')) {
        new MaskInput("#reg_tel");
    }

    if(document.querySelector('#personal_tel')) {
        new MaskInput("#personal_tel");
    }

    if(document.querySelector('.application')) {

        const date = document.querySelector('.input-date');
        const timeSelect = document.querySelector('select[name="time"]');

        const today = new Date().toISOString().split('T')[0];
        const currentTime = new Date().toLocaleTimeString('ru-RU', {
            hour12: false,
            hour: '2-digit',
            minute: '2-digit',
            timeZone: 'Asia/Yekaterinburg'
        });

        date.min = today;

        date.addEventListener('input', function () {
            // Если выбранная дата меньше минимального значения, устанавливаем значение на минимальное
            if (this.value < today) {
                this.value = today;
            } else if (this.value === today) {
                disableEarlierTimes(currentTime);
            } else {
                enableAllTimes();
            }
        });

        // блокировка времени
        function disableEarlierTimes(currentTime) {
            const options = timeSelect.options;
            for (let i = 0; i < options.length; i++) {
                const optionTime = options[i].value;
                if (optionTime < currentTime) {
                    options[i].disabled = true;
                } else {
                    options[i].disabled = false;
                }
            }
        }

        // разблокировка времени
        function enableAllTimes() {
            const options = timeSelect.options;
            for (let i = 0; i < options.length; i++) {
                options[i].disabled = false;
            }
        }

        // работа с интервалом
        const closingTime = "24";

        const intervalSelect = document.querySelector('select[name="time_interval"]');

        // событие изменения времени
        timeSelect.addEventListener('change', () => {
            const selectedTime = parseInt(timeSelect.value);
            const options = intervalSelect.options;

            for (let i = 0; i < options.length; i++) {
                const timeInterval = parseInt(options[i].value);
                if (!isNaN(timeInterval)) {
                    options[i].disabled = !isIntervalValid(selectedTime, timeInterval);
                }
            }
        });

        // проверка валидности времени
        function isIntervalValid(selectedTime, timeInterval) {
            const allTime = selectedTime + timeInterval;
            return allTime <= closingTime;
        }
    }

    if(document.querySelector('.admin_menu')) {
        const cost = document.querySelector('.input-cost');
        cost.addEventListener('input', function() {
            if (this.value < 0) {
                this.value = 0;
            }
        });

    }

    if(document.querySelector('.menu')) {

        const views = document.querySelector('.menu__header_views');

        const header = views.querySelector('.menu__header_views_title');
        const content = views.querySelector('.menu__header_views_ul');

        header.addEventListener('click', () => {
            views.classList.toggle('menu__header_views_active');

            if (views.classList.contains('menu__header_views_active')) {
                const contentHeight = content.scrollHeight;
                views.style.height = `${contentHeight}px`;
            } else {
                views.style.height = '62px';
            }
        });
    }
});

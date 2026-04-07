(function() {

    var MOIS = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
    var JOURS = ['Lun','Mar','Mer','Jeu','Ven','Sam','Dim'];

    function pad(n) { return n < 10 ? '0' + n : '' + n; }
    function formatDisplay(y, m, d) { return pad(d) + ' ' + MOIS[m] + ' ' + y; }
    function formatValue(y, m, d) { return y + '-' + pad(m + 1) + '-' + pad(d); }

    /* ═══ DATE PICKER ═══ */
    function initDatePicker(input) {
        var wrapper = document.createElement('div');
        wrapper.className = 'relative';
        input.parentNode.insertBefore(wrapper, input);
        wrapper.appendChild(input);

        input.type = 'text';
        input.readOnly = true;
        input.style.cursor = 'pointer';

        var hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = input.name;
        input.name = '';
        wrapper.appendChild(hidden);

        var today = new Date();
        var currentYear = today.getFullYear();
        var currentMonth = today.getMonth();
        var selectedDate = null;

        if (input.dataset.value) {
            var parts = input.dataset.value.split('-');
            currentYear = parseInt(parts[0]);
            currentMonth = parseInt(parts[1]) - 1;
            selectedDate = { y: currentYear, m: currentMonth, d: parseInt(parts[2]) };
            input.value = formatDisplay(currentYear, currentMonth, parseInt(parts[2]));
            hidden.value = input.dataset.value;
        }

        /* Popup calendrier */
        var popup = document.createElement('div');
        popup.className = 'absolute top-full left-0 mt-2 z-[100] bg-white rounded-2xl border border-beige-200/60 shadow-2xl shadow-dark/10 p-4 w-[310px] hidden';

        /* Header navigation */
        var header = document.createElement('div');
        header.className = 'flex items-center justify-between mb-3';

        var prevBtn = document.createElement('button');
        prevBtn.type = 'button';
        prevBtn.className = 'w-8 h-8 rounded-lg border border-beige-200 bg-white flex items-center justify-center text-beige-500 hover:bg-beige-50 hover:text-dark transition-all duration-150';
        prevBtn.innerHTML = '<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>';

        var titleBtn = document.createElement('button');
        titleBtn.type = 'button';
        titleBtn.className = 'text-[15px] font-bold text-dark px-3 py-1 rounded-lg hover:bg-beige-50 transition-colors duration-150';

        var nextBtn = document.createElement('button');
        nextBtn.type = 'button';
        nextBtn.className = 'w-8 h-8 rounded-lg border border-beige-200 bg-white flex items-center justify-center text-beige-500 hover:bg-beige-50 hover:text-dark transition-all duration-150';
        nextBtn.innerHTML = '<svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>';

        header.appendChild(prevBtn);
        header.appendChild(titleBtn);
        header.appendChild(nextBtn);
        popup.appendChild(header);

        /* Jours de la semaine */
        var weekRow = document.createElement('div');
        weekRow.className = 'grid grid-cols-7 text-center mb-1';
        JOURS.forEach(function(j) {
            var span = document.createElement('span');
            span.className = 'text-[10px] font-bold uppercase tracking-wider text-beige-400 py-1';
            span.textContent = j;
            weekRow.appendChild(span);
        });
        popup.appendChild(weekRow);

        /* Grille des jours */
        var daysGrid = document.createElement('div');
        daysGrid.className = 'grid grid-cols-7 gap-0.5';
        popup.appendChild(daysGrid);

        wrapper.appendChild(popup);

        /* Navigation mois */
        prevBtn.addEventListener('click', function(e) {
            e.preventDefault();
            currentMonth--;
            if (currentMonth < 0) { currentMonth = 11; currentYear--; }
            renderCalendar();
        });

        nextBtn.addEventListener('click', function(e) {
            e.preventDefault();
            currentMonth++;
            if (currentMonth > 11) { currentMonth = 0; currentYear++; }
            renderCalendar();
        });

        function renderCalendar() {
            titleBtn.textContent = MOIS[currentMonth] + ' ' + currentYear;
            daysGrid.innerHTML = '';

            var firstDay = new Date(currentYear, currentMonth, 1).getDay();
            firstDay = firstDay === 0 ? 6 : firstDay - 1;
            var daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            var todayStr = today.getFullYear() + '-' + pad(today.getMonth() + 1) + '-' + pad(today.getDate());

            for (var e = 0; e < firstDay; e++) {
                var empty = document.createElement('span');
                empty.className = 'h-9';
                daysGrid.appendChild(empty);
            }

            for (var d = 1; d <= daysInMonth; d++) {
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.textContent = d;
                var dateStr = formatValue(currentYear, currentMonth, d);
                var isToday = dateStr === todayStr;
                var isSelected = selectedDate && selectedDate.y === currentYear && selectedDate.m === currentMonth && selectedDate.d === d;
                var minDate = input.dataset.min;
                var isPast = minDate && dateStr < minDate;

                if (isSelected) {
                    btn.className = 'h-9 rounded-xl bg-brand-500 text-white text-[13px] font-bold flex items-center justify-center transition-all duration-150';
                } else if (isToday) {
                    btn.className = 'h-9 rounded-xl border-[1.5px] border-brand-500 text-brand-600 text-[13px] font-bold flex items-center justify-center hover:bg-brand-50 transition-all duration-150 cursor-pointer';
                } else if (isPast) {
                    btn.className = 'h-9 rounded-xl text-beige-300 text-[13px] flex items-center justify-center cursor-not-allowed';
                } else {
                    btn.className = 'h-9 rounded-xl text-dark text-[13px] font-medium flex items-center justify-center hover:bg-beige-100 transition-all duration-150 cursor-pointer';
                }

                if (!isPast) {
                    btn.dataset.date = dateStr;
                    btn.dataset.day = d;
                    btn.addEventListener('click', function(ev) {
                        ev.preventDefault();
                        var dd = parseInt(this.dataset.day);
                        selectedDate = { y: currentYear, m: currentMonth, d: dd };
                        input.value = formatDisplay(currentYear, currentMonth, dd);
                        hidden.value = this.dataset.date;
                        popup.classList.add('hidden');
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    });
                }

                daysGrid.appendChild(btn);
            }
        }

        input.addEventListener('click', function(e) {
            e.stopPropagation();
            if (popup.classList.contains('hidden')) {
                renderCalendar();
                popup.classList.remove('hidden');
            } else {
                popup.classList.add('hidden');
            }
        });

        document.addEventListener('click', function(e) {
            if (!wrapper.contains(e.target)) popup.classList.add('hidden');
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') popup.classList.add('hidden');
        });
    }

    /* ═══ TIME PICKER — Roulette iOS ═══ */
    function initTimePicker(input) {
        var wrapper = document.createElement('div');
        wrapper.className = 'relative';
        input.parentNode.insertBefore(wrapper, input);
        wrapper.appendChild(input);

        input.type = 'text';
        input.readOnly = true;
        input.style.cursor = 'pointer';

        var hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = input.name;
        input.name = '';
        wrapper.appendChild(hidden);

        var selHour = 10;
        var selMin = 0;

        if (input.dataset.value) {
            var parts = input.dataset.value.split(':');
            selHour = parseInt(parts[0]);
            selMin = parseInt(parts[1]);
            input.value = pad(selHour) + ':' + pad(selMin);
            hidden.value = input.dataset.value;
        }

        /* Popup */
        var popup = document.createElement('div');
        popup.className = 'absolute top-full left-0 mt-2 z-[100] bg-white rounded-2xl border border-beige-200/60 shadow-2xl shadow-dark/10 w-[250px] hidden overflow-hidden';

        /* Header */
        var headerDiv = document.createElement('div');
        headerDiv.className = 'px-4 py-3 border-b border-beige-100';
        headerDiv.innerHTML = '<span class="text-[13px] font-bold text-dark">Sélectionner l\'heure</span>';
        popup.appendChild(headerDiv);

        /* Body avec colonnes */
        var bodyDiv = document.createElement('div');
        bodyDiv.className = 'flex items-stretch py-2';

        /* Colonne heures */
        var hourCol = document.createElement('div');
        hourCol.className = 'flex-1 text-center';
        hourCol.innerHTML = '<div class="text-[10px] font-bold uppercase tracking-widest text-beige-400 pb-2">Heures</div>';
        var hourList = document.createElement('div');
        hourList.className = 'h-[180px] overflow-y-auto';
        hourList.style.scrollbarWidth = 'none';

        for (var h = 0; h < 24; h++) {
            var hItem = document.createElement('div');
            hItem.dataset.val = h;
            hItem.textContent = pad(h);
            if (h === selHour) {
                hItem.className = 'py-2 mx-2 rounded-lg text-[20px] font-bold text-brand-600 bg-brand-50 cursor-pointer transition-all duration-150';
            } else {
                hItem.className = 'py-2 mx-2 rounded-lg text-[16px] text-beige-400 hover:bg-beige-50 hover:text-dark cursor-pointer transition-all duration-150';
            }
            hItem.addEventListener('click', (function(val, item) {
                return function() {
                    selHour = val;
                    hourList.querySelectorAll('div').forEach(function(i) {
                        i.className = 'py-2 mx-2 rounded-lg text-[16px] text-beige-400 hover:bg-beige-50 hover:text-dark cursor-pointer transition-all duration-150';
                    });
                    item.className = 'py-2 mx-2 rounded-lg text-[20px] font-bold text-brand-600 bg-brand-50 cursor-pointer transition-all duration-150';
                    updateDisplay();
                    item.scrollIntoView({ block: 'center', behavior: 'smooth' });
                };
            })(h, hItem));
            hourList.appendChild(hItem);
        }
        hourCol.appendChild(hourList);

        /* Séparateur */
        var sepDiv = document.createElement('div');
        sepDiv.className = 'flex items-center justify-center text-[28px] font-bold text-beige-300 w-[30px] pt-8';
        sepDiv.textContent = ':';

        /* Colonne minutes */
        var minCol = document.createElement('div');
        minCol.className = 'flex-1 text-center';
        minCol.innerHTML = '<div class="text-[10px] font-bold uppercase tracking-widest text-beige-400 pb-2">Minutes</div>';
        var minList = document.createElement('div');
        minList.className = 'h-[180px] overflow-y-auto';
        minList.style.scrollbarWidth = 'none';

        for (var m = 0; m < 60; m += 5) {
            var mItem = document.createElement('div');
            mItem.dataset.val = m;
            mItem.textContent = pad(m);
            if (m === selMin) {
                mItem.className = 'py-2 mx-2 rounded-lg text-[20px] font-bold text-brand-600 bg-brand-50 cursor-pointer transition-all duration-150';
            } else {
                mItem.className = 'py-2 mx-2 rounded-lg text-[16px] text-beige-400 hover:bg-beige-50 hover:text-dark cursor-pointer transition-all duration-150';
            }
            mItem.addEventListener('click', (function(val, item) {
                return function() {
                    selMin = val;
                    minList.querySelectorAll('div').forEach(function(i) {
                        i.className = 'py-2 mx-2 rounded-lg text-[16px] text-beige-400 hover:bg-beige-50 hover:text-dark cursor-pointer transition-all duration-150';
                    });
                    item.className = 'py-2 mx-2 rounded-lg text-[20px] font-bold text-brand-600 bg-brand-50 cursor-pointer transition-all duration-150';
                    updateDisplay();
                    item.scrollIntoView({ block: 'center', behavior: 'smooth' });
                };
            })(m, mItem));
            minList.appendChild(mItem);
        }
        minCol.appendChild(minList);

        bodyDiv.appendChild(hourCol);
        bodyDiv.appendChild(sepDiv);
        bodyDiv.appendChild(minCol);
        popup.appendChild(bodyDiv);

        /* Bouton confirmer */
        var footerDiv = document.createElement('div');
        footerDiv.className = 'px-3 pb-3 pt-1 border-t border-beige-100';
        var confirmBtn = document.createElement('button');
        confirmBtn.type = 'button';
        confirmBtn.className = 'w-full py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-[13px] font-bold rounded-xl transition-all duration-200 mt-2';
        confirmBtn.textContent = 'Confirmer';
        confirmBtn.addEventListener('click', function() {
            popup.classList.add('hidden');
            input.dispatchEvent(new Event('change', { bubbles: true }));
        });
        footerDiv.appendChild(confirmBtn);
        popup.appendChild(footerDiv);

        wrapper.appendChild(popup);

        function updateDisplay() {
            var val = pad(selHour) + ':' + pad(selMin);
            input.value = val;
            hidden.value = val;
        }

        function openPopup() {
            popup.classList.remove('hidden');
            setTimeout(function() {
                var activeH = hourList.querySelector('.text-brand-600');
                var activeM = minList.querySelector('.text-brand-600');
                if (activeH) activeH.scrollIntoView({ block: 'center', behavior: 'smooth' });
                if (activeM) activeM.scrollIntoView({ block: 'center', behavior: 'smooth' });
            }, 50);
        }

        input.addEventListener('click', function(e) {
            e.stopPropagation();
            popup.classList.contains('hidden') ? openPopup() : popup.classList.add('hidden');
        });

        document.addEventListener('click', function(e) {
            if (!wrapper.contains(e.target)) popup.classList.add('hidden');
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') popup.classList.add('hidden');
        });
    }

    /* ═══ INITIALISATION ═══ */
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-datepicker]').forEach(initDatePicker);
        document.querySelectorAll('[data-timepicker]').forEach(initTimePicker);
    });

})();


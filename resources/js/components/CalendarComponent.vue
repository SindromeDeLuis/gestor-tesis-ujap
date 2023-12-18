<template>
    <div id="calendar"></div>

    <Teleport to="body">
        <!-- use the modal component, pass in the prop -->
        <modal :show="showModal" @close="showModal = false">
            <template #header>
                <h3></h3>
            </template>
            <template #body>
                <p><b>Autor:</b> {{ autor }}</p>
                <p><b>Titulo:</b> {{ title }}</p>
                <p><b>Tutor:</b> {{ tutor }}</p>
                <p><b>Jurado 1:</b> {{ jury1 }}</p>
                <p><b>Jurado 2:</b> {{ jury2 }}</p>
            </template>
            <template #footer>
                <h3></h3>
            </template>
        </modal>
    </Teleport>

</template>

<script>
    import { Calendar } from '@fullcalendar/core';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import timeGridPlugin from '@fullcalendar/timegrid';
    import listPlugin from '@fullcalendar/list';

    import Modal from './Modal.vue';

    export default {
        components: {
            Modal
        },
        data() {
            return {
                showModal: false,
                autor: null,
                title: null,
                tutor: null,
                jury1: null,
                jury2: null
            }
        },
        props: ['teses', 'students'],
        methods: {

        },
        mounted() {
            const dateEvent = []
            this.teses.forEach(tesis => {
                dateEvent.push(
                    {
                        title: tesis.title,
                        start: tesis.date,
                        id: this.students.find(student => student.id === tesis.user_id).name,
                        tutor: tesis.tutor,
                        jury1: tesis.jury1,
                        jury2: tesis.jury2,
                    },
                )
            })           
            //console.log(this.teses)
            //console.log(this.students)
            //console.log(dateEvent)
            
            let view = this;
            var calendarEl = document.getElementById('calendar');
            let calendar = new Calendar(calendarEl, {
                plugins: [ dayGridPlugin, timeGridPlugin, listPlugin ],
                initialView: 'dayGridMonth',
                locale: 'es',
                buttonText: {
                    today:    'hoy',
                    month:    'mes',
                    week:     'semana',
                    day:      'dia',
                    list:     'lista'
                },
                headerToolbar: {
                    left: 'prev today',
                    center: 'title',
                    right: 'next'//'dayGridMonth,timeGridWeek,listWeek'
                },
                events: dateEvent,
                eventClick: function(info) {
                    view.showModal = true;
                    view.autor = info.event.id;
                    view.title = info.event.title;
                    view.tutor = dateEvent.find(dEvent => dEvent.id === info.event.id).tutor;
                    view.jury1 = dateEvent.find(dEvent => dEvent.id === info.event.id).jury1;
                    view.jury2 = dateEvent.find(dEvent => dEvent.id === info.event.id).jury2;
                }
            });
            calendar.render();
            
            console.log('Calendar mounted.')
        },
    };
    
</script>

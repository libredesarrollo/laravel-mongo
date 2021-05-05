const bootstrap = require('bootstrap');
const moment = require('moment')
window.axios = require('axios');

import {
    Calendar
} from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

const addEventModal = new bootstrap.Modal(document.querySelector("#saveEventModal"))
let infoEvent;

const title = document.querySelector("#title")
const content = document.querySelector("#content")
const allDay = document.querySelector("#allDay")
const time = document.querySelector("#time")
const colorText = document.querySelector("#colorText")
const colorBg = document.querySelector("#colorBg")
const boxFiles = document.querySelector("#boxFiles")

//window.onload = function () {

// referencia al div para el calendario
var calendarEl = document.getElementById('calender')


var calendar = new Calendar(calendarEl, {
    selectable: true,
    editable: true,
    locale: 'es',
    plugins: [dayGridPlugin, interactionPlugin],
    events: '/api/event',
    select: function (event) {
        /*
         ***** Seleccion de rango del evento
         */

        // guardamos la informacion del evento de manera global
        infoEvent = event

        // habilitamos por defecto la seleccion por rango
        allDay.checked = true
        showTime()

        // limpiamos los valores del input
        title.value = ""
        content.value = ""
        time.value = ""

        // estamos en creacion, ocultamos la eliminacion
        document.querySelector("#removeEvent").classList.add('d-none')
        document.querySelector("#FormField").classList.add('d-none')

        // abrimos el modal
        document.querySelector("label#ltitle span").innerText = ""
        document.querySelector("label#lcontent span").innerText = ""
        addEventModal.show()

    },
    eventClick: function (info) {
        /*
         ***** Edicion de eventos al pegarle un click
         */
        infoEvent = info.event


        // establecemos los valores del evento en los inputs
        title.value = infoEvent.title
        content.value = infoEvent.extendedProps.content
        time.value = moment(infoEvent.start).format('HH:mm')

        // en caso de que tenga eventos por hora fija
        allDay.checked = infoEvent.allDay
        showTime()

        // colores
        colorText.value = infoEvent.textColor
        colorBg.value = infoEvent.backgroundColor

        // edicion de evento, habilitar la eliminacion
        document.querySelector("#removeEvent").classList.remove('d-none')

        // inicio box files
        boxFiles.innerHTML = "";
        if (info.event.extendedProps.files)
            info.event.extendedProps.files.forEach((f) => addFileHtml(f))
        //boxFiles.innerHTML += "</ul>";
        // fin box files

        // inicio FORM FIELD
        const FormField = document.querySelector("#FormField")
        const action = FormField.getAttribute("data-action").substr(0, FormField.getAttribute("data-action").length - 1)

        FormField.classList.remove('d-none')

        FormField.setAttribute("action", action + infoEvent.id)
        // final FORM FIELD

        // abrimos el modal
        addEventModal.show()

        //info.el.style.backgroundColor = 'blue'
        //info.el.style.borderColor = '#FF0000'
    },
    /*eventDragStart: function (info) {
        console.log("eventDragStart " + info)
        console.log("eventDragStart " + info.event.title)
        console.log("eventDragStart " + info.event.start)
        info.el.style.backgroundColor = 'red'
    },
    eventDragStop: function (info) {
        console.log("eventDragStop " + info)
        console.log("eventDragStop " + info.event.title)
        console.log("eventDragStop " + info.event.start)
    },*/
    eventDrop: function (info) {
        /*
         ***** Edicion de evento por rango en Drop
         */
        // actualizamos el evento por rango de fecha
        axios.put('api/event/update_range/' + info.event.id, {
                start: moment(info.event.start).format('YYYY-MM-DD'),
                end: moment(info.event.end).format('YYYY-MM-DD'),
            })
            .then(res => {})
            .catch(res => {
                console.log("Error!")
                console.log(res)
            })
    },
    eventResize: function (info) {
        /*
         ***** Edicion de evento al rescalar el mismo
         */

        if (!confirm("Esta ok?")) {
            // ventana de confirmacion
            info.revert()
        } else {
            // actualizamos el evento por rango de fecha
            axios.put('api/event/update_range/' + info.event.id, {
                    start: moment(info.event.start).format('YYYY-MM-DD'),
                    end: moment(info.event.end).format('YYYY-MM-DD'),
                })
                .then(res => {})
                .catch(res => {
                    console.log("Error!")
                    console.log(res)
                })
        }
    },

})

// pintamos el calendario
calendar.render()
//calendar.setOption('locale','es')// cambiar opciones de manera dinanica

/*
 *************** Eventos del modal y los eventos 
 */

//*** Creacion o actualizacion del evento
document.getElementById("addEvent").addEventListener('click', () => {

    if (infoEvent.id != undefined) {
        updateEvent()
    } else {
        createEvent()
    }
})

//*** Eliminacion del evento
document.getElementById("removeEvent").addEventListener('click', () => {
    axios.delete('api/event/' + infoEvent.id)
        .then(res => {
            infoEvent.remove()

        })
        .catch(res => {
            console.log("Error!")
            console.log(res)
        })

    addEventModal.hide()
    calendar.unselect()
})

//*** Seleccion de modo por hora o por rango del evento
allDay.addEventListener('change', (e) => {
    showTime()
})

//*** Funcion para ocultar o mostrar la seleccion de la hora del evento
function showTime() {
    let state = allDay.checked

    if (state) {
        time.classList.add('d-none')
    } else {
        time.classList.remove('d-none')
    }
}

//*** Creacion del evento
function createEvent() {

    let uri = '/api/event'
    let hour = ''
    if (!allDay.checked) {
        // evento por hora
        uri = '/api/event/store_by_hour'
        hour = "T" + time.value
    } else {
        // evento por rango
        time.value = ''
    }

    axios.post(uri, {
            title: title.value,
            content: content.value,
            start: moment(infoEvent.start).format('YYYY-MM-DD') + hour,
            end: moment(infoEvent.end).format('YYYY-MM-DD') + hour,
            text_color: colorText.value,
            color_bg: colorBg.value,
            allday: allDay.checked
        })
        .then(res => {
            let event = {
                id: res.data.id,
                title: title.value,
                start: moment(infoEvent.start).format('YYYY-MM-DD') + hour, //.add(10, 'days')
                textColor: colorText.value,
                color: colorBg.value,
                allDay: res.data.allDay,
                extendedProps: {
                    content: content.value
                }
            }

            if (res.data.allDay) {
                // si es un evento por rango
                event.end = moment(infoEvent.end).format('YYYY-MM-DD')
            }
            // creamos el evento en fullcalendar
            calendar.addEvent(event)

            addEventModal.hide()
            calendar.unselect()
        })
        .catch(res => {

            console.log("Error!")

            if (res.response.data.content) {
                document.querySelector("label#lcontent span").innerText = res.response.data.content[0]
            }

            if (res.response.data.title) {
                document.querySelector("label#ltitle span").innerText = res.response.data.title[0]
            }

        })
}

//*** Actualizacion del evento
function updateEvent() {

    let uri = '/api/event/' + infoEvent.id
    let hour = ''
    if (!allDay.checked) {
        // evento por hora
        uri = '/api/event/update_by_hour/' + infoEvent.id
        hour = "T" + time.value
    } else {
        // evento por rango
        time.value = ''
    }

    axios.put(uri, {
            title: title.value,
            content: content.value,
            start: moment(infoEvent.start).format('YYYY-MM-DD') + hour,
            end: moment(infoEvent.end).format('YYYY-MM-DD') + hour,
            text_color: colorText.value,
            color_bg: colorBg.value,
            allday: allDay.checked
        })
        .then(res => {

            let event = {
                id: res.data.id,
                title: title.value,
                start: moment(infoEvent.start).format('YYYY-MM-DD') + hour, //.add(10, 'days')
                textColor: colorText.value,
                color: colorBg.value,
                allDay: res.data.allDay,
                extendedProps: {
                    content: content.value
                }
            }

            if (res.data.allDay) {
                // si es un evento por rango
                event.end = moment(infoEvent.end).format('YYYY-MM-DD')
            }

            // actualizacion del evento en FullCalendar
            infoEvent.remove()
            calendar.addEvent(event)

            addEventModal.hide()
            calendar.unselect()
        })
        .catch(res => {
            console.log("Error!")
            console.log(res)
        })
}

function addFileHtml(file) {
    boxFiles.innerHTML += `
            <li><a target="_blank" href="/events/${file.file}">${file.file}</a></li>
        `;
}


document.querySelector("#buttonFormField").addEventListener('click',
    () => {

        const file = document.querySelector("#FormField [type=file]").files[0]

        if (file == undefined) {
            return alert("Debe de seleccionar un archivo")
        }

        const formData = new FormData()

        formData.append('image', file)
        formData.append('_token', document.querySelector("#FormField [name=_token]").value)

        fetch(document.querySelector("#FormField").getAttribute("action"), {
                method: 'post',
                body: formData
            })
            .then((res) => res.json())
            .then((res) => {
                if (res.file) {
                    addFileHtml(res)
                } else if(res.errors){
                    console.log(res.errors)
                }
            })

    });

//}

// evento escuchador de cuando se muestra el modal
document.querySelector("#saveEventModal").addEventListener('shown.bs.modal', function () {

    console.log(document.querySelector("#eventContainer").offsetHeight)

    document.querySelector("#boxFiles").style.maxHeight = (document.querySelector("#eventContainer").offsetHeight - 40) +"px"


})

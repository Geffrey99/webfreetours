Proyecto final webb free tours 
-------------------------------------------------------------------
Requerimientos:
Existirán 3 roles distintos sobre el logueo:
• Administrador.
• Guía turístico.
• Cliente.
Todos los nuevos registros serán de tipo “Cliente”.
Sólo el admin podrá designar nuevos “Guías”.
La página principal será la vista para usuarios no registrados, que será la misma que la propia 
de “Clientes” solo que a la hora de reservar una Ruta no se podrá hacer hasta loguearse.
Funcionalidades del rol de Administrador:
Un administrador podrá:
• Crear rutas.
• Asignar rutas creadas a los guías disponibles. Habría que controlar si los guías están 
disponibles ese día a esa hora (sólo se ha de comprobar que ese guía no está en otra 
visita ese día a esa hora, la mejor forma de comprobarlo es no mostrarlo en la tabla de 
guías una vez se vaya a realizar la asignación de guía a una ruta)
• Cancelar una ruta existente.
Definimos en detalle las funcionalidades:
• CREAR RUTAS:
Para crear una ruta se podrá insertar los campos básicos:
✓ Título de la ruta.
✓ Localidad de la ruta.
✓ Descripción de la ruta.
✓ Foto general de la ruta.
Además, una ruta se cómo de Items a visitar, los cuales se podrán definir, cada item se 
compondrá a su vez de:
✓ Título del item.
✓ Descripción del item.
✓ Foto del item.
✓ Geolocalización del item.
A su vez, habría que introducir en qué periodo se va a realizar la ruta y las fechas y 
horarios en los que está disponible para poder reservarse.
• ASIGNAR RUTA A UN GUÍA:
Una vez que una ruta sea solicitada por al menos 1 persona se creará una instancia de 
la misma a la cual habrá que asignar a 1 guía. La asignación de ruta a un guía se hará 
de forma manual, para poder decidir sobre los guías disponibles quién lo podría hacer 
mejor.
Para ello, se mostrará un listado solamente de los guías disponibles en esa fecha y a 
esa hora, reservando esa fecha para ese guía y quitándolo de su disponibilidad.
(NOTA: Aunque la ruta se cree a partir de la primera persona, si no hay un mínimo de 
10 personas puede que la ruta no se realice. Un guía como máximo acompañará a 20 
personas, con lo que, si a una ruta se inscriben 21 personas, se crearían 2 instancias, 
siempre ordenando a los clientes en función de su fecha de reserva)
• CANCELAR UNA RUTA:
Si una ruta no llega al mínimo de 10 personas puede que no se realice, pero eso 
dependerá del administrador, que será el único en última instancia que podrá 
decidirlo.
Si el administrador decide cancelar una ruta, se le enviará un correo a todos los 
clientes inscritos para informarles y al guía, dejando esa fecha y hora libre para poder 
realizar otras visitas.
(NOTA: Siempre que una ruta esté en peligro de no poder realizarse por su número 
de participantes, se les enviará correos a los clientes para indicarles que su ruta 
“peligra” debido a la falta de participantes)
Funcionalidades del rol de Guía Turístico:
Un guía podrá:
• Ver sus rutas asignadas.
• Pasar lista en las rutas a las que se le asignen.
• Hacer un informe de una ruta, una vez se termine.
Definimos en detalle las funcionalidades:
• VER RUTAS ASIGNADAS:
Aparecerá un listado con las rutas que se vayan asignando ordenadas por fecha (arriba 
la más próxima a ocurrir.
A las nuevas rutas asignadas se les pondrá un distintivo para informar de que es una 
nueva ruta asignada.
(NOTA: Hay que llevar el control de que a un guía no se le pueden asignar 2 rutas en 
una misma fecha y hora)
• PASAR LISTA EN UNA RUTA:
Cuando se asocia una ruta a un guía, el guía ya puede entrar a ella y ver las personas 
inscritas.
(NOTA: Cuidado, porque un mismo cliente podría inscribir hasta un máximo de 8
personas, bajo su misma identidad)
Una vez se produzca la visita, el guía podrá pasar lista y marcar qué personas acuden y 
cuales no, para llevar un control de asistencia real.
• INFORME DE LA RUTA:
Dentro de cada ruta asignada, además de la funcionalidad de pasar lista, también 
existirá la opción de realizar un informe, el cual permanecerá deshabilitado hasta la 
hora prevista de finalización de la ruta.
El informe contendrá los campos de:
✓ Insertar una imagen de grupo.
✓ Añadir un texto de observaciones.
✓ Añadir el dinero recaudado en la ruta.
Mientras el guía no rellene el informe, la ruta aparecerá marcada en un color que la 
distinga del resto como realizada, pero sin informe enviado.
Una vez se haya enviado el informe, la ruta se habrá finalizado completamente y 
desaparecerá de la lista del guía.
Funcionalidades del rol de Cliente:
Un cliente podrá:
• Ver las rutas disponibles.
• Reservar una ruta.
• Valorar una ruta realizada.
• Cancelar una reserva existente.
Definimos en detalle las funcionalidades:
• VER RUTAS DISPONIBLES:
Esta será nuestra página principal, donde por defecto aparecerán las rutas más 
visitadas o las mejor valoradas, en función de un pequeño filtro que deberá existir.
En la web habrá un buscador de rutas por localidad y/o fecha.
Si buscamos sólo por localidad, se deberá introducir la localidad y aparecerán todas las 
rutas previstas en cualquier fecha para esa localidad.
Si además de la localidad agregamos el filtro de la fecha, se mostrarán todas las rutas 
de esa localidad en esa fecha.
No se podrá buscar sólo por fecha.
Una vez se produzca una búsqueda, los resultados se podrán seguir filtrando por 
primero las rutas más visitadas o primero las mejor valoradas.
Se mostrará un listado de rutas coincidentes con la búsqueda mostrando:
✓ Carrusel de fotos de la ruta.
✓ Título de la ruta.
✓ Descripción de la ruta.
✓ Fecha y hora de la ruta.
✓ Valoración media de la ruta y número de visitas realizadas.
Una vez que pulsemos sobre una ruta, se ampliará la información de la misma 
mostrando los ítems de la ruta, ordenados desde el punto de encuentro, al de fin, con 
información de cada uno, además de toda la anterior información mostrada en la vista 
previa.
Por supuesto, aparecerá un pequeño formulario para reservar ruta, indicando el 
número total de asistentes (máximo 8).
Este formulario no se mostrará para los usuarios no registrados, pero se mostrará un 
mensaje que indique que se registre para poder hacer una reserva.
• RESERVAR RUTA:
Cuando entramos sobre una ruta, podremos hacer una reserva tal cual se ha descrito 
antes, indicando el número de participantes y dando al botón de reservar.
En ese momento, se le enviará un email de confirmación al usuario recordando la ruta, 
fecha y hora de la reserva, además de dando la posibilidad de que se guarde la cita en 
su Google Calendar.
Una vez realizada una reserva de ruta, se guardará en el apartado de “Mis Reservas”, 
desde donde se podrá modificar en todo momento la reserva, en cuanto al número de 
plazas reservadas o la cancelación de la misma.
• VALORAR RUTA REALIZADA:
Una vez finalice una ruta que se haya realizado, la ruta pasará a la sección del cliente 
“Mis rutas”, donde el cliente tendrá un histórico de todas las rutas realizadas con toda 
la información de la misma, la cual a su término podrá valorar de 1 a 5 estrellas según 
su agrado, además de poder dejar un comentario escrito.
• CANCELAR RUTA:
Tal y como se ha visto antes, en la sección del cliente registrado “Mis reservas”, se 
podrá gestionar la modificación del número de usuarios a reservar y la cancelación de 
la ruta.
(NOTA: cada vez que exista una modificación en la reserva, se notificará por email

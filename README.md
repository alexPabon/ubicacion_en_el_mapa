<h1>Aplicación para crear marcas en el mapa</h1>
<h2>Creada con Modelo Vista Controlador (MVC) con controlador frontal</h2>
<p>
	Esta aplicación se realizó con la arquitectura de <b>Modelo Vista Controlador (MVC)</b> con 	<b>Controlador frontal</b>, que consiste en separar los datos de una aplicación, la interfaz de 	usuario, y la lógica de control en tres componentes distintos.<br><br>
	Se trata de un modelo muy maduro y que ha demostrado su validez a lo largo de los años en todo 	tipo de aplicaciones, y sobre multitud de lenguajes y plataformas de desarrollo.
</p>

<h3>Como funciona la aplicacion</h3>
<p>
	Al tomar distintos numeros ip desde la base de datos, realiza una consulta a http://ip-api.com que me retorna un JSON con las cordenadas que posteriormente usaré en Leaflet(https://leafletjs.com/index.html), que es la biblioteca JavaScript de código abierto para mapas interactivos, donde se creará marcas en el mapa con la ubicacion dependiendo el numero ip.
</p>
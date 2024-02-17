# RESTAURANT WEB FOODRUS

Aquest projecte consisteix en un **aplicatiu web** basat en un restaurant de l'empresa toysrus. 
Es poden realitzar **comandes**, hi ha un sistema de **login**, una pagina de la **carta** i te funcions amb javascript implementades.
Per realitzar aquest proyecte s'ha utilizat *html, css, bootstrap 5, php y javascript*. L'**usuari administrador** ademes, podra editar, crear y eliminar productes.
També podra gestionar les comandes dels clients. 
Al projecte s'han utilizat 3 **controladors**, un controlador principal (*productoController*), un per les funcions de l'usuari (*usuarioController*) 
Y un altre controlador que es fa servir per fer una *API* que s'utilitzará en archius javascript per utiltzar funcions de la api mitjançant el fetch. 
El archiu index.php s'ha configurat de manera que es puguin utilizat els 3 controladors. Sempre que es vulguin utilitzar funcions, es fara una trucada al controlador corresponent.

## Resenyes

Per fer el sistema de resenyes s'ha creat la pagina *reseñas.php* on es podran afegir i veure les resenyes dels usuaris. Si no s'ha iniciat sesió 
no es podran insertar resenyes. Utilitzant la API s'han fet **2 fetchs** a un arxiu js anomenat *reseñas.js*. Un fetch mostrara les resenyes que estiguin
inserides a la base de dades y l'altre fetch agafara les dades enviades del formulari y les insertara a la base de dades per despres mostrarles a la pagina.

## Programa de fidelitat

El programa de fidelitat s'ha realitzat a la pagina de panellCompra, afegint un nou formulari on l'usuari pot utilitzar els punts corresponents per realitzar
una comanda. S'utilitzará l'arxiu *programaFidelidad.js*. De la mateixa manera que en les resenyes, es faran **2 fetchs** al API, un per mostrar els punts disponibles
fent un select a la base de dades y l'altre per poder utilitzar i actualitzar els punts pertinents. Aquest segon fetch, agafara les dades del formulari, els **punts
disponibles**, els de l'**usuari** i el **preu total** de la compra y utilitzant una condicio, especifiquem que si no hi han suficients punts disponibles o els punts utilitzats 
siguin inferiors als punts requerits depenent del preu total, es mostrara un missatge d'error amb **notie.js**.
Si la condicio es cumpleix, es realitzara la accio corresponent, s'actualitzaran els punts a la base de dades i es realitzara la compra correctament.

## QR

En el cas del QR, utilizare l'arxiu *qr.js* on es fara **1 fetch** a una *api externa d'internet* per generar qrs. A aquesta API li pasare la pagina de *misPedidos.php* 
de manera que al escanejar el codi qr em mostrara un link que es dirigirà a la pagina de les comandes fetes per l'usuari. Per fer les altres funcions amb js el metode 
que s'ha utilitzat per enviar les dades es el POST, en aquest cas utilitzarem el **GET** i despres mostrarem el codi amb una funcio js, on insertarem al imatge qr a un modal.
Per **activar el qr** al finalitzar la compra al controlador s'ha insertat el codi **$_SESSION['mostrarModalQR'] = true** que s'utilitzara per indicar al js si es pot mostrar
el modal o no es pot mostrar. A la pagina de *panelCompra* especificarem que si la sesio es true, la funcio que generara el qr s'activara i el modal s'obrira. Al tancar el modal
es redirigira al usuari a la pagina de la carta i es buidara la cistella. 

## Propines

Per les propines, el que s'ha fet es crear un altre __modal__ que s'obrira quant l'usuari premi un boto abans de finalitzar la compra, al modal hi haurà una opció per poder indicar 
quina propina es vol guardar, per defecte, estara marcat un **3%** pero l'usuari el pot cambiar. També podra **ometre i sortir del modal** prement un boto, si no vol pagar propines, 
l'usuari podra ometre aquest modal i realitzar una compra de manera normal, sense propines. Al javascript *propinas.js* s'agafan els valors corresponents i si l'usuari **guarda 
una propina** prenent el boto de guardar, el percentatge de propina que ha especificat es sumara automaticamente al preu total de la compra.

## Filtre productes

De la mateixa manera que s'ha fet el filtre de las **resenyes** agafan els valors dels *select* per poder especificar dins d'una condició quines resenyes volem mostrar i guardarles
en un array per poder ordenarlas segons indiqui l'usuari en el filtre, en el cas dels **productes de la carta**  el que s'ha fet es utilitzant els metodes d'array __.map__ y 
__.filter__ s'han emmagatzemat totes les tarjetes dels productes a un array amb el metode __Array.from()__ i depenent dels *checkboxs* marcats, s'ocultaran o 
es mostraran els productes utilizant el *display: none* o *display: block*. Cada tarjeta tindra una **clase** per poder idenfiticarlos com a pizza, postre o beguda i d'aquesta manera podrem espeficiar en el js quines categories em de mostrar i quines no. S'han utilizat *3 funcions* per implementar el funcionament del filtre, una per obtindre les categories dels productes, una altre per obtindre les categories seleccionades als checkboxs i una altre que s'encarregara de filtrar els productes.

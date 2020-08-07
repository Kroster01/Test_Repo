
https://www.youtube.com/watch?v=lxYB79ANJM8

Comandos

1.- 
    cd server
    npm init --yes

2.- 
    para crear el serviodor
    npm i express@4.16.4

    para validar desde consola de servidor las peticiones (get post put delete , etc)
    npm i morgan@1.9.1

    el modulo de conección del a la BD (con el soprte de promesas)
    npm i promise-mysql@3.3.1
    //"promise-mysql": "^4.1.3"

    permite la comunicación de do servidores (angular 4200 vs el restapi 3200)
    npm i cors@2.8.5

    vigilante de los cambios en ls archivos de javascript
    npm i nodemon@1.18.9 -D

    para poder interpretar express
    npm i @types/express@4.16.0 -D

    para poder interpretar morgan
    npm i @types/morgan@1.9.1 -D

    para poder interpretar cors
    npm i @types/cors@2.8.4 -D

3.- 
    Se crea el archivo server/src/index.ts

4.- descargar type script
    npm i -g typescript
    * Cuando se termine de isntalar queda disponible el comando "tsc"

4.1.- Crear archivo de configuración para typescript
    tsc --init

4.2 automatizar comando "tsc" 
    * Crear "build": "tsc -w" -> packge.json
    * luego ejecutar -> npm run build

4.2 automatizar comando "node build/index.js" 
    * Crear "dev": "nodemon cuild/index.js" -> packge.json
    * luego ejecutar -> npm run dev


/************************** Fin con el Servidor **********************************/


/******************* Init con el Cliente Front Angular ***************************/
1.- crear el proyecto angular.
    * ng new client --routing

2.- Creación de componentes
    * ng g c components/naviation
    * ng g c components/game-form
    * ng g c components/game-list
    * ng g c components/genericError/page404

3.- Creación de servicios
    * ng g s services/games

4.- buscar bootstrap en https://getbootstrap.com/
* Get Started

5.- buscar en https://bootswatch.com/
* para buscar temas de bootstrap


node.js
angula cli
type script
my sql 

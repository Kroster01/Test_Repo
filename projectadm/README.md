# Projectadm

This project was generated with [Angular CLI](https://github.com/angular/angular-cli) version 9.1.5.

## Development server

Run `ng serve` for a dev server. Navigate to `http://localhost:4200/`. The app will automatically reload if you change any of the source files.

## Code scaffolding

Run `ng generate component component-name` to generate a new component. You can also use `ng generate directive|pipe|service|class|guard|interface|enum|module`.

## Build

Run `ng build` to build the project. The build artifacts will be stored in the `dist/` directory. Use the `--prod` flag for a production build.

## Running unit tests

Run `ng test` to execute the unit tests via [Karma](https://karma-runner.github.io).

## Running end-to-end tests

Run `ng e2e` to execute the end-to-end tests via [Protractor](http://www.protractortest.org/).

## Further help

To get more help on the Angular CLI use `ng help` or go check out the [Angular CLI README](https://github.com/angular/angular-cli/blob/master/README.md).

## Dependencias Intaladaes

Versión ddel video vs la instalada por defecto sin el @ de versión
npm i bootstrap@4.4.1        - 4.5.2
npm i jquery@3.5.0           - 3.5.1
npm i @popperjs/core@2.3.3   - 2.4.4

npm i firebase@7.17.2

ng add @angular/fire


## creación de componentes

ng g m home -m=app --route home
ng g c shared/navbar
ng g m auth/login -m=app --route login
ng g m auth/register -m=app --route register

ng g s auth/services/auth

ng g m auth/forgot-password --m=app --route forgot-password


## step firebase

npm install -g firebase-tools
firebase login
firebase init


# videos para completar proyecto

#Angular #Firebase #Bootstrap Login Angular 9, Firebase y Bootstrap 4 - Email & Contraseña
https://www.youtube.com/watch?v=rwIOw7f0RHk

#Firebase Enviar email de verificación Firebase #Angular
https://www.youtube.com/watch?v=Y3ojE5SASFg

#Angular9 Login Firebase Angular 9 recuperar contraseña
https://www.youtube.com/watch?v=UExx6Cl4xRQ

Cómo implementar un login de Google con Firebase en Angular
https://www.youtube.com/watch?v=9zxH6EeJeIo
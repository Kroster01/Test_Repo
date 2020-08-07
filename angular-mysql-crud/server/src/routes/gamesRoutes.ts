import { Router } from 'express';
import gameController from '../controllers/gameController';


class GamesRouter {
    router: Router = Router();;
    constructor() {
        this.config();
        this.routes();
    }


    config(): void {
        // listar juegos.
        this.router.get('/', gameController.list);
        // listar juegos.
        this.router.get('/:id', gameController.getOne);
        // Crear juegos.
        this.router.post('/', gameController.create);
        // Eliminar juegos.
        this.router.delete('/:id', gameController.delete);
        // actualziar juegos.
        this.router.put('/:id', gameController.update);

    }

    routes(): void {

    }

    start(): void {

    }
}

const gmesRoutes = new GamesRouter();
export default gmesRoutes.router;
import { Router} from 'express';
import indexController from "../controllers/indexController";


class IndexRouter {
    router: Router = Router();;
    constructor() {
        this.config();
        this.routes();
    }


    config(): void {
        this.router.get('/', indexController.index);
    }

    routes(): void {

    }

    start(): void {

    }
}

const indexRoutes = new IndexRouter();
export default indexRoutes.router;
import { Request, Response } from 'express';


class IndexController {
    index(req: Request, res: Response) {
        //res.send('Hello ! index controller!');
        res.json({text: "API Is /api/games"});
    }
}

const indexController = new IndexController();
export default indexController;
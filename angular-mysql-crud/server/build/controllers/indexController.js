"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
class IndexController {
    index(req, res) {
        //res.send('Hello ! index controller!');
        res.json({ text: "API Is /api/games" });
    }
}
const indexController = new IndexController();
exports.default = indexController;
